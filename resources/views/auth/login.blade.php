@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-logo">
        <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Logo">
    </div>
    <div class="auth-form">
        <h2 class="auth-title">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                    <span class="toggle-password" onclick="togglePassword('password')">
                        👁️
                    </span>
                </div>
            </div>            
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <p class="auth-link">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    </div>
</div>
@endsection