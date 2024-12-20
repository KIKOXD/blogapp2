<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Admin Logo">
        </div>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.posts') }}"><i class="fas fa-edit"></i> Posting</a></li>
            <li><a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="{{ route('admin.settings') }}"><i class="fas fa-cogs"></i> Setting</a></li>
        </ul>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>


    <!-- Navbar -->
    <div class="navbar">
        <h1 class="navbar-title">Dashboard</h1>
        <div class="profile">
            <i class="fas fa-user-circle profile-icon"></i>
            <span class="profile-name">{{ Auth::user()->name }}</span>
        </div>
    </div>

    {{-- <div class="sidebar">
        <a href="{{ route('admin.posts.index') }}">Posts</a>
    </div> --}}

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</body>

</html>