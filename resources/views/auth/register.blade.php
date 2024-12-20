@extends('layouts.auth')

@section('content')
<div class="auth-container">
    <div class="auth-logo">
        <img src="{{ asset('images/GIF-LOGO-MAHASLOT.gif') }}" alt="Logo">
    </div>
    <div class="auth-form">
        <h2 class="auth-title">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
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
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="password-container">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password">
                    <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                        👁️
                    </span>
                </div>
            </div>
            
            <button type="submit" class="btn-submit">Register</button>
        </form>
        <p class="auth-link">Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>
@endsection