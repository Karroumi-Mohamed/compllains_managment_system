<aside class="w-72 bg-repeatblack p-8 border-r border-gray-800/50">
    <!-- Logo and Navigation -->
    <div class="mb-14">
        <a href="{{ route('admin') }}" class="block">
            <h1 class="font-display text-2xl font-bold text-repeatyellow inline-flex items-center">
                Repeat <span class="text-white font-normal ml-2">Admin</span>
            </h1>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="space-y-1">
        <a href="{{ route('admin') }}" 
           class="flex items-center px-4 py-3 text-gray-400 rounded-lg {{ request()->routeIs('admin') ? 'bg-black/40 text-white font-medium border border-gray-800/50' : 'hover:bg-black/20 hover:text-white' }}">
            <i class="fa-solid fa-chart-pie w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <a href="{{ route('admin.tickets') }}" 
           class="flex items-center px-4 py-3 text-gray-400 rounded-lg {{ request()->routeIs('admin.tickets*') ? 'bg-black/40 text-white font-medium border border-gray-800/50' : 'hover:bg-black/20 hover:text-white' }}">
            <i class="fa-solid fa-ticket w-5"></i>
            <span class="ml-3">Tickets</span>
        </a>

        <a href="{{ route('admin.categories') }}" 
           class="flex items-center px-4 py-3 text-gray-400 rounded-lg {{ request()->routeIs('admin.categories') ? 'bg-black/40 text-white font-medium border border-gray-800/50' : 'hover:bg-black/20 hover:text-white' }}">
            <i class="fa-solid fa-folder w-5"></i>
            <span class="ml-3">Categories</span>
        </a>

        <a href="{{ route('admin.agent-requests') }}" 
           class="flex items-center px-4 py-3 text-gray-400 rounded-lg {{ request()->routeIs('admin.agent-requests') ? 'bg-black/40 text-white font-medium border border-gray-800/50' : 'hover:bg-black/20 hover:text-white' }}">
            <i class="fa-solid fa-user-shield w-5"></i>
            <span class="ml-3">Agent Requests</span>
        </a>

        <a href="{{ route('admin.users') }}" 
           class="flex items-center px-4 py-3 text-gray-400 rounded-lg {{ request()->routeIs('admin.users') ? 'bg-black/40 text-white font-medium border border-gray-800/50' : 'hover:bg-black/20 hover:text-white' }}">
            <i class="fa-solid fa-users w-5"></i>
            <span class="ml-3">Users</span>
        </a>
    </nav>

    <!-- Footer -->
    <div class="mt-auto pt-8">
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center px-4 py-3 text-gray-400 rounded-lg hover:bg-black/20 hover:text-white">
                <i class="fa-solid fa-right-from-bracket w-5"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</aside>
