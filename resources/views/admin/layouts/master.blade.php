<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @if(isset($settings->favicon) && $settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div>
    
    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex">
        <!-- Sidebar -->
        <div :class="{'w-64': sidebarOpen, 'w-20': !sidebarOpen}" 
             class="bg-gray-800 text-white transition-all duration-300 ease-in-out fixed top-0 left-0 h-screen z-30">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    @if(isset($settings->dashboard_logo) && $settings->dashboard_logo)
                        <img src="{{ asset('storage/' . $settings->dashboard_logo) }}" alt="Logo" class="h-8" 
                             :class="{'hidden': !sidebarOpen}">
                    @else
                        <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Logo" class="h-8" 
                             :class="{'hidden': !sidebarOpen}">
                    @endif
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>
                </div>
            </div>

            <nav class="mt-8 space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 transition-colors duration-300 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="ml-3" :class="{'hidden': !sidebarOpen}">Dashboard</span>
                </a>

                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 transition-colors duration-300 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                    </svg>
                    <span class="ml-3" :class="{'hidden': !sidebarOpen}">Posting</span>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 transition-colors duration-300 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="ml-3" :class="{'hidden': !sidebarOpen}">Users</span>
                </a>

                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 transition-colors duration-300 px-4 py-3 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="ml-3" :class="{'hidden': !sidebarOpen}">Setting</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div :class="{'ml-64': sidebarOpen, 'ml-20': !sidebarOpen}" 
             class="flex-1 flex flex-col transition-all duration-300">
            <header class="bg-white shadow-sm fixed top-0 right-0 left-0 z-20" 
                    :class="{'pl-64': sidebarOpen, 'pl-20': !sidebarOpen}">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Admin Dashboard</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300 ease-in-out flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-6 mt-16">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
    <script>
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `transform transition-all duration-300 ease-out scale-95 opacity-0 
            ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} 
            text-white px-6 py-3 rounded-lg shadow-lg mb-4`;
        notification.textContent = message;
        
        const container = document.getElementById('notification-container');
        container.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('scale-95', 'opacity-0');
            notification.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        setTimeout(() => {
            notification.classList.add('scale-95', 'opacity-0');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    </script>
</body>

</html>