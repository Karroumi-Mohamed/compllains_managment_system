<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\AgentRequest;
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
}
