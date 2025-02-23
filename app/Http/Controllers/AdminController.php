<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\AgentRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'adminUsers' => User::whereHas('role', function($q) {
                $q->where('name', 'admin');
            })->count(),
            'regularUsers' => User::whereHas('role', function($q) {
                $q->where('name', 'user');
            })->count(),
            'agentUsers' => User::whereHas('role', function($q) {
                $q->where('name', 'agent');
            })->count(),
            'pendingAgentRequests' => AgentRequest::where('status', 'pending')->count(),
            'recentUsers' => User::with('role')
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', $data);
    }

    public function agentRequests()
    {
        $agentRequests = AgentRequest::with('user')
            ->latest()
            ->paginate(10);
        return view('admin.agent-requests', compact('agentRequests'));
    }

    public function approveAgentRequest(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'approved']);
        
        $agentRole = Role::where('name', 'agent')->first();
        $agentRequest->user->update(['role_id' => $agentRole->id]);

        return redirect()->route('admin.agent-requests')->with('success', 'Agent request approved successfully.');
    }
    public function rejectAgentRequest(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'rejected']);
        return redirect()->route('admin.agent-requests')->with('success', 'Agent request rejected successfully.');
    }

    public function tickets()
    {
        $tickets = Ticket::with(['user', 'agent', 'category', 'response'])
            ->latest()
            ->paginate(10);
            
        return view('admin.tickets', compact('tickets'));
    }

    public function ticket(Ticket $ticket)
    {
        return view('admin.ticket-details', compact('ticket'));
    }

    public function assignAgent(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:users,id'
        ]);

        $ticket->update([
            'agent_id' => $validated['agent_id'],
            'status' => Ticket::STATUS_IN_PROGRESS
        ]);

        return redirect()->back()->with('success', 'Agent assigned successfully.');
    }

    public function editTicket(Ticket $ticket)
    {
        return view('admin.ticket-edit', compact('ticket'));
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'response' => 'nullable|string|min:10'
        ]);

        $ticket->update(['status' => $validated['status']]);

        if (!empty($validated['response'])) {
            // Update or create the response
            if ($ticket->response) {
                $ticket->response->update([
                    'message' => $validated['response'],
                    'agent_id' => auth()->id()
                ]);
            } else {
                $ticket->response()->create([
                    'message' => $validated['response'],
                    'agent_id' => auth()->id()
                ]);
            }
        }

        return redirect()->route('admin.ticket', $ticket)->with('success', 'Ticket updated successfully');
    }

    public function categories()
    {
        $categories = Category::withCount('tickets')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        Category::create($validated);
        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update($validated);
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }

    public function users()
    {
        $users = User::with('role')
            ->withCount(['tickets', 'assignedTickets'])
            ->latest()
            ->paginate(10);
            
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    }

    public function deleteUser(User $user)
    {
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.users')->with('error', 'Cannot delete admin users.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
