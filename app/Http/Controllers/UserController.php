<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\AgentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function tickets()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->with(['category', 'agent'])
            ->latest()
            ->paginate(10);
        return view('user.tickets.index', compact('tickets'));
    }

    public function createTicket()
    {
        $categories = Category::all();
        return view('user.create-ticket', compact('categories'));
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $ticket = Ticket::create([
            ...$validated,
            'user_id' => auth()->id(),
            'status' => 'open'
        ]);

        return redirect()->route('user.ticket', $ticket)->with('success', 'Ticket created successfully');
    }

    public function ticket(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('user.ticket-details', compact('ticket'));
    }

    public function editTicket(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $categories = Category::all();
        return view('user.edit-ticket', compact('ticket', 'categories'));
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $ticket->update($validated);
        return redirect()->route('user.ticket', $ticket)->with('success', 'Ticket updated successfully');
    }

    public function deleteTicket(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return redirect()->route('user.tickets')->with('success', 'Ticket deleted successfully');
    }

    public function submitAgentRequest(Request $request)
    {
        // Check if the user already has a pending request
        $existingRequest = AgentRequest::where('user_id', Auth::id())->where('status', 'pending')->first();

        if ($existingRequest) {
            return redirect()->route('user')->with('error', 'You already have a pending agent request.');
        }

        AgentRequest::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->route('user')->with('success', 'Agent request submitted successfully.');
    }

    public function getAgentRequestStatus()
    {
        $agentRequest = AgentRequest::where('user_id', Auth::id())->latest()->first();

        if ($agentRequest) {
            return view('user.dashboard', ['agentRequestStatus' => $agentRequest->status]);
        }

        return view('user.dashboard', ['agentRequestStatus' => null]);
    }
}
