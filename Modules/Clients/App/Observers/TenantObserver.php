<?php

namespace Modules\Clients\App\Observers;

use Modules\Clients\App\Jobs\SendClientCredentialsJob;
use Modules\Clients\App\Models\Tenant;

class TenantObserver
{
    public function created(Tenant $tenant)
    {
        // Dispatch job to create admin user and send email
        SendClientCredentialsJob::dispatch($tenant);
    }
}
    