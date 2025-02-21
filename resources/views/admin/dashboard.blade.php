<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Repeat Support</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-repeatblack font-body antialiased text-gray-300">
    <div class="min-h-screen flex">
        <x-admin.sidebar />

        <!-- Main Content Area -->
        <main class="flex-1 px-12 py-10">
            <!-- Header Section with enhanced styling -->
            <header class="mb-16 relative">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-display font-bold text-repeatyellow mb-4 leading-tight">
                        Welcome Back, Admin
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed">
                        Here's what's happening with your support system today.
                    </p>
                </div>
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-repeatyellow/5 rounded-full blur-3xl -z-10"></div>
            </header>

            <!-- Stats Overview with enhanced cards -->
            <section class="grid grid-cols-4 gap-8 mb-16">
                <!-- Total Users Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-repeatyellow/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-repeatyellow/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-repeatyellow/10 rounded-lg">
                                <i class="fa-solid fa-users text-2xl text-repeatyellow"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Total Users</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $totalUsers }}</h3>
                            <p class="text-gray-400">Registered accounts</p>
                        </div>
                    </div>
                </div>

                <!-- Regular Users Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-blue-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-blue-500/10 rounded-lg">
                                <i class="fa-solid fa-user text-2xl text-blue-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Regular Users</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $regularUsers }}</h3>
                            <p class="text-gray-400">Active members</p>
                        </div>
                    </div>
                </div>

                <!-- Agents Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-green-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-green-500/10 rounded-lg">
                                <i class="fa-solid fa-user-tie text-2xl text-green-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Agents</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $agentUsers }}</h3>
                            <p class="text-gray-400">Support team</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card -->
                <div class="group relative bg-black/40 rounded-xl p-8 border border-gray-800/50 hover:border-purple-500/50 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="flex justify-between items-start mb-8">
                            <div class="p-3 bg-purple-500/10 rounded-lg">
                                <i class="fa-solid fa-user-clock text-2xl text-purple-500"></i>
                            </div>
                            <span class="text-xs font-medium tracking-wider text-gray-400 uppercase">Pending</span>
                        </div>
                        <div>
                            <h3 class="text-4xl font-display font-bold text-white mb-2">{{ $pendingAgentRequests }}</h3>
                            <p class="text-gray-400">Agent requests</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recent Users Section with enhanced styling -->
            <section class="bg-black/40 rounded-xl border border-gray-800/50 overflow-hidden backdrop-blur-sm">
                <div class="px-8 py-6 border-b border-gray-800/50 flex items-center justify-between">
                    <h2 class="text-2xl font-display font-bold text-repeatyellow">Recent Users</h2>
                    <a href="{{ route('admin.users') }}" 
                        class="inline-flex items-center px-4 py-2 bg-repeatyellow/10 text-repeatyellow rounded-lg hover:bg-repeatyellow/20 transition-all duration-200 group">
                        View All
                        <i class="fa-solid fa-arrow-right ml-2 text-sm transition-transform duration-200 group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="divide-y divide-gray-800/50">
                    @foreach ($recentUsers as $user)
                        <div class="px-8 py-5 flex items-center justify-between hover:bg-white/5 transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center ring-2 ring-gray-700">
                                    <span class="text-lg font-medium text-gray-300">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="text-white font-medium mb-1">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium ring-1 
                                    {{ $user->role->name === 'admin' ? 'bg-repeatyellow/20 text-repeatyellow ring-repeatyellow/30' : '' }}
                                    {{ $user->role->name === 'agent' ? 'bg-green-500/20 text-green-500 ring-green-500/30' : '' }}
                                    {{ $user->role->name === 'user' ? 'bg-blue-500/20 text-blue-500 ring-blue-500/30' : '' }}">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                                <button class="text-gray-400 hover:text-white transition-colors duration-200">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</body>

</html>
