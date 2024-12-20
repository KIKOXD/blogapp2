@extends('admin.layouts.master')

@section('content')
<h1 class="text-2xl font-bold mb-6">Welcome to Admin Dashboard</h1>
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Users</h2>
        <p>Total: 120</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Posts</h2>
        <p>Total: 50</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Comments</h2>
        <p>Total: 300</p>
    </div>
</div>
@endsection
