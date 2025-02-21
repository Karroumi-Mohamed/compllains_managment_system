<aside class="w-1/5 bg-[#FFC700] p-8 shadow-yellow-glow flex flex-col justify-between relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/5 to-transparent pointer-events-none"></div>
    <div class="absolute -top-32 -right-32 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>

    <div class="relative">
        <div class="mb-14">
            <a href="{{ route('admin') }}" class="block">
                <h1 class="font-display text-2xl font-bold text-[#171717] inline-flex items-center">
                    Repeat <span class="font-normal ml-2">Admin</span>
                </h1>
            </a>
        </div>

        <nav class="space-y-3">
            <a href="{{ route('admin') }}"
                class="flex items-center text-[#171717] hover:text-[#171717] font-medium group transition-all duration-200 {{ request()->routeIs('admin') ? 'bg-black/10 -mx-4 px-4 py-3 rounded-lg' : 'py-2' }}">
                <div class="w-8 h-8 bg-black/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-black/20 transition-colors duration-200">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                </div>
                Dashboard
            </a>

            <a href="{{ route('admin.categories') }}"
                class="flex items-center text-[#171717] hover:text-[#171717] font-medium group transition-all duration-200 {{ request()->routeIs('admin.categories') ? 'bg-black/10 -mx-4 px-4 py-3 rounded-lg' : 'py-2' }}">
                <div class="w-8 h-8 bg-black/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-black/20 transition-colors duration-200">
                    <i class="fa-solid fa-tags text-lg"></i>
                </div>
                Categories
            </a>

            <a href="{{ route('admin.tickets') }}"
                class="flex items-center text-[#171717] hover:text-[#171717] font-medium group transition-all duration-200 {{ request()->routeIs('admin.tickets') ? 'bg-black/10 -mx-4 px-4 py-3 rounded-lg' : 'py-2' }}">
                <div class="w-8 h-8 bg-black/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-black/20 transition-colors duration-200">
                    <i class="fa-solid fa-ticket-alt text-lg"></i>
                </div>
                Tickets
            </a>

            <a href="{{ route('admin.agent-requests') }}"
                class="flex items-center text-[#171717] hover:text-[#171717] font-medium group transition-all duration-200 {{ request()->routeIs('admin.agent-requests') ? 'bg-black/10 -mx-4 px-4 py-3 rounded-lg' : 'py-2' }}">
                <div class="w-8 h-8 bg-black/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-black/20 transition-colors duration-200">
                    <i class="fa-solid fa-user-shield text-lg"></i>
                </div>
                Agent Requests
            </a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center text-[#171717] hover:text-[#171717] font-medium group transition-all duration-200 py-2">
                <div class="w-8 h-8 bg-black/10 rounded-lg flex items-center justify-center mr-3 group-hover:bg-black/20 transition-colors duration-200">
                    <i class="fa-solid fa-sign-out-alt text-lg"></i>
                </div>
                Logout
            </a>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="hidden">
            @csrf
        </form>
    </div>

    <div class="relative">
        <div class="text-sm text-[#171717]">
            © 2025 Repeat Inc.
        </div>
    </div>
</aside>
