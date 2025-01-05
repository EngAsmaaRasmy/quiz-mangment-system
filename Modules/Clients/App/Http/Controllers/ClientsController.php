<?php

namespace Modules\Clients\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Modules\Clients\App\Http\Requests\ClientRequest;
use Modules\Clients\App\Jobs\SendClientCredentialsJob;
use Modules\Clients\App\Services\ClientService;

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
    public function store(ClientRequest $request, ClientService $clientService): RedirectResponse
    {
        try {
            $plainPassword = $request->password;

            $tenant = $clientService->createTenant($request->validated());

            SendClientCredentialsJob::dispatch($tenant, $plainPassword);

            return redirect()->route('clients.create')->with('success', 'Client created successfully!');
        } catch (ValidationException $e) {
            return redirect()->route('clients.create')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('clients.create')
                ->with('error', 'An error occurred while creating the client.');
        }
    }
}
