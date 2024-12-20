@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>All Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create New Post</a>
    <!-- List all posts -->
</div>
@endsection
