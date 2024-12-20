<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-900 text-white w-64 flex flex-col shadow-md">
            <div class="p-5 text-center">
                <img src="{{ asset('images/logo.gif') }}" alt="Admin Panel Logo" class="mx-auto w-32 h-auto rounded-full">
            </div>
            <nav class="flex-1">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-users mr-2"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-cogs mr-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4">
                <a href="{{ route('logout') }}" class="block py-2 px-3 text-center rounded bg-red-600 hover:bg-red-500 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-50">
            <header class="bg-white shadow-md p-4">
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
            </header>
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
