<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
