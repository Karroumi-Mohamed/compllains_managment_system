<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function index()
    {
        $agent = Auth::user();
        $data = [
            'totalAssignedTickets' => $agent->assignedTickets()->count(),
            'openTickets' => $agent->assignedTickets()->where('status', 'open')->count(),
            'inProgressTickets' => $agent->assignedTickets()->where('status', 'in_progress')->count(),
            'closedTickets' => $agent->assignedTickets()->where('status', 'closed')->count(),
            'recentTickets' => $agent->assignedTickets()
                ->with(['user', 'category'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('agent.dashboard', $data);
    }

    public function tickets()
    {
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
