<?php

namespace App\Http\Controllers;

use App\Enums\StatusClients;
use App\Http\Requests\CreateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Client/Index', [
            'clients' => ClientResource::collection(Client::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Client/Create', [
            'statusOptions' => StatusClients::options()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClientRequest $request)
    {
        Client::create($request->validated()); // Create a new client
        return to_route('clients.index'); // Redirect to client list
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): Response
    {
        return Inertia::render('Admin/Client/Edit', [
            'client' => new ClientResource($client),
            'statusOptions' => StatusClients::options()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return to_route('clients.index'); // Redirect to client list
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back();
    }
}
