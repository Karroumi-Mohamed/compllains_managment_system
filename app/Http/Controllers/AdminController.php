<?php

namespace App\Http\Controllers;

use App\Models\AgentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show() {
        return view('admin.show');
    }

    public function agentRequests()
    {
        $agentRequests = AgentRequest::with('user')->paginate(10);
        return view('admin.agent-requests', compact('agentRequests'));
    }

    public function approveAgentRequest(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'approved']);
        $user = User::find($agentRequest->user_id);
        $user->update(['role' => 'agent']);

        return redirect()->route('admin.agent-requests')->with('success', 'Agent request approved successfully.');
    }

    public function rejectAgentRequest(AgentRequest $agentRequest)
    {
        $agentRequest->update(['status' => 'rejected']);
        return redirect()->route('admin.agent-requests')->with('success', 'Agent request rejected successfully.');
    }
}
