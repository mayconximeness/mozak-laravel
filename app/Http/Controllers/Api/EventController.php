<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return EventResource::collection($events);
    }

    public function showByUuid($uuid)
    {
        // Encontra o evento pelo UUID
        $event = Event::where('uuid_code', $uuid)->firstOrFail();

        // Verifica se o evento pertence ao usuário autenticado
        if ($event->owner_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para acessar este evento.');
        }

        // Retorna o evento como um recurso JSON
        return new EventResource($event);
    }

    public function myEvents()
    {
        // Recupera todos os eventos do usuário autenticado
        $events = Event::where('owner_id', auth()->id())->get();
    
        return EventResource::collection($events); // Retorna os eventos como uma coleção de recursos JSON
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response(null, 204); // Retorna uma resposta vazia com o status 204 (No Content)
    }
}
