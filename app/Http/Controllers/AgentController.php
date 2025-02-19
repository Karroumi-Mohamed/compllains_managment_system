<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        return view('agent.dashboard');
    }

    public function tickets()
    {
        $tickets = Ticket::with(['user', 'category'])
            ->where('status', '!=', 'closed')
            ->latest()
            ->paginate(10);
        return view('agent.tickets', compact('tickets'));
    }

    public function ticket(Ticket $ticket)
    {
        return view('agent.ticket-details', compact('ticket'));
    }

    public function editTicket(Ticket $ticket)
    {
        return view('agent.edit-ticket', compact('ticket'));
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'description' => 'sometimes|string'
        ]);
 
        $ticket->update($validated);
        return redirect()->route('agent.ticket', $ticket)->with('success', 'Ticket updated successfully');
    }
}
