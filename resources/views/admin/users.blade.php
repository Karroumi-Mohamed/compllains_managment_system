<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Repeat Support</title>
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
                        Users
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Manage user accounts and roles.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Users List -->
            <div class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-display font-bold text-repeatyellow">User Accounts</h2>
                    </div>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @forelse($users as $user)
                        <div class="group px-8 py-6 hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <!-- User Info -->
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700">
                                        <span class="text-lg font-medium text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-medium mb-1">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                                        <div class="flex items-center gap-4 mt-2">
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                Joined {{ $user->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="flex items-center text-xs {{ $user->tickets_count > 0 ? 'text-blue-400' : 'text-gray-500' }}">
                                                <i class="fa-solid fa-ticket mr-1"></i>
                                                {{ $user->tickets_count }} tickets submitted
                                            </div>
                                            @if($user->role->name === 'agent')
                                                <div class="flex items-center text-xs {{ $user->assigned_tickets_count > 0 ? 'text-green-400' : 'text-gray-500' }}">
                                                    <i class="fa-solid fa-clipboard-check mr-1"></i>
                                                    {{ $user->assigned_tickets_count }} tickets handled
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Role Badge and Actions -->
                                <div class="flex items-center space-x-4">
                                    @if($user->role->name !== 'admin')
                                        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            @method('PUT')
                                            <select name="role_id" 
                                                    class="mr-2 bg-black/40 border border-gray-700 rounded-lg text-xs text-gray-300 py-1 px-2"
                                                    onchange="this.form.submit()">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>

                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1 rounded-lg text-gray-400 hover:text-red-500 hover:bg-white/5 transition-all duration-200"
                                                    title="Delete User">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-500 ring-1 ring-red-500/30">
                                            Administrator
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center">
                            <div class="mb-4">
                                <i class="fa-solid fa-users text-4xl text-gray-600"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-400 mb-2">No Users Found</h3>
                            <p class="text-gray-500">There are no users registered in the system yet</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="px-8 py-4 border-t border-gray-800/50">
                        {{ $users->links() }}
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

    @if(session('error'))
        <div id="error-notification" 
            class="fixed bottom-4 right-4 bg-red-500/10 text-red-500 border border-red-500/20 px-6 py-4 rounded-lg shadow-lg">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-circle-exclamation text-xl"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('error-notification').style.display = 'none';
            }, 3000);
        </script>
    @endif
</body>
</html>