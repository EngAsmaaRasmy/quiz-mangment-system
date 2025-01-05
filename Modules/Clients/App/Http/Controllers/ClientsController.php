<?php

namespace Modules\Clients\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Clients\App\Http\Requests\ClientRequest;
use Modules\Clients\App\Models\Tenant;

class ClientsController extends Controller
{
    /**
     * @return [type]
     */
    public function create()
    {
        return view('clients::index');
    }

    /**
     * @param ClientRequest $request
     * 
     * @return [type]
     */
    public function store(ClientRequest $request)
    {
        $tenant = Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        $tenant->domains()->create([
            'domain' => "{$request->subdomain}." . env('CENTRAL_DOMAIN'),
        ]);

        return redirect()->route('clients.create')->with('success', 'Client created successfully!');
    }
}
