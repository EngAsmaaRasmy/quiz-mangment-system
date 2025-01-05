<?php

namespace Modules\Clients\App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Stancl\Tenancy\Database\Models\Domain as ParentOfDomains;

class Domain extends ParentOfDomains
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'domain',
        'tenant_id',
    ];
}
