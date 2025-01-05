<?php

namespace Modules\Clients\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Clients\App\Emails\AdminCredentialsMail;
use Modules\Clients\App\Models\Tenant;
use Modules\Members\App\Models\User;
use Spatie\Permission\Models\Role;

class SendClientCredentialsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Tenant $tenant, public string $plainPassword)
    {
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        tenancy()->initialize($this->tenant->id);

        // Create admin user
        $user = User::create([
            'name' => $this->tenant->name,
            'email' => $this->tenant->email,
            'mobile' => $this->tenant->mobile,
            'password' => $this->tenant->password,
            'type' => 'admin',
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $user->assignRole($adminRole);

        // Send email with login credentials
        Mail::to($user->email)->send(new AdminCredentialsMail($user, $this->tenant->domains()->first()->domain, $this->plainPassword));
    }
}
