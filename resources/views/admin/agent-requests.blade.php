<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Requests - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-admin.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Agent Requests
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Review and manage user applications to join the support team.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Requests List -->
            <div class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Pending Applications</h2>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($agentRequests as $request)
                        <div class="px-8 py-6 flex items-center justify-between hover:bg-white/5 transition-all duration-200">
                            <!-- User Info -->
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700">
                                    <span class="text-lg font-medium text-gray-300">{{ substr($request->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium mb-1">{{ $request->user->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $request->user->email }}</p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <div class="flex items-center text-xs text-gray-500">
                                            <i class="fa-regular fa-clock mr-1"></i>
                                            Requested {{ $request->created_at->diffForHumans() }}
                                        </div>
                                        <div class="flex items-center text-xs {{ $request->user->submitted_tickets > 0 ? 'text-blue-400' : 'text-gray-500' }}">
                                            <i class="fa-solid fa-ticket mr-1"></i>
                                            {{ $request->user->submitted_tickets }} active tickets
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-3">
                                @if($request->isPending())
                                    <form action="{{ route('admin.agent-requests.approve', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-2 rounded-lg inline-flex items-center bg-green-500/10 text-green-500 border border-green-500/20
                                            hover:bg-green-500/20 transition-all duration-200 cursor-pointer">
                                            <i class="fa-solid fa-check mr-2"></i>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.agent-requests.reject', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" onclick="return confirm('Are you sure you want to reject this request?')"
                                            class="px-4 py-2 rounded-lg inline-flex items-center bg-red-500/10 text-red-500 border border-red-500/20
                                            hover:bg-red-500/20 transition-all duration-200 cursor-pointer">
                                            <i class="fa-solid fa-times mr-2"></i>
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ring-1
                                        {{ $request->isApproved() ? 'bg-green-500/20 text-green-500 ring-green-500/30' : '' }}
                                        {{ $request->isRejected() ? 'bg-red-500/20 text-red-500 ring-red-500/30' : '' }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-user-shield text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Pending Requests</h3>
                            <p class="text-gray-500">There are no agent applications to review at the moment</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($agentRequests->hasPages())
                    <div class="px-8 py-4 border-t border-gray-800/50">
                        {{ $agentRequests->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    @if(session('success'))
        <div id="notification" 
            class="fixed bottom-4 right-4 bg-green-500/10 text-green-500 border border-green-500/20 px-6 py-4 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-check-circle text-xl"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('notification').style.display = 'none';
            }, 3000);
        </script>
    @endif
</body>
</html>