<?php

namespace Modules\Clients\App\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Clients\App\Models\Tenant;

class ClientService
{
    /**
     * Create a new tenant with a domain and an admin user.
     *
     * @param array $data
     * @return Tenant
     */
    public function createTenant(array $data): Tenant
    {
        // Create tenant
        $tenant = Tenant::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'mobile'   => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign domain to tenant
        $tenant->domains()->create([
            'domain' => "{$data['subdomain']}." . env('CENTRAL_DOMAIN'),
        ]);

        return $tenant;
    }
}
