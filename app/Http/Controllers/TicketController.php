<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $tickets = Ticket::all();

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
            
        ]);

        if($request->file('attachment')) {
            $path = $this->storeAttachment($request, $ticket);

            $ticket->update(['attachment' => $path]);
        }

        return redirect(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update(['title' => $request->title, 'description' => $request->description]);

        if($request->file('attachment')) {
            // delete previous attachment
            Storage::disk('public')->delete($ticket->attachment);

            $path = $this->storeAttachment($request, $ticket);

            $ticket->update(['attachment' => $path]);
        }

        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        $ticket->delete($ticket->id);

        return redirect(route('ticket.index'));
    }

    protected function storeAttachment($request, $ticket)
    {
        $contents = file_get_contents($request->file('attachment'));
        $filename = Str::random(25);
        $extension = $request->file('attachment')->extension();
        $path = "attachments/$filename.$extension";
        Storage::disk('public')->put($path, $contents);

        return $path;
    }
}
