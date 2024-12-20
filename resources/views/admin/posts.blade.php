@extends('admin.layouts.master') <!-- Pastikan namespace sesuai -->

@section('content')
<div class="posts-container">
    <h2>Manage Posts</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create New Post</a>
    <div class="posts-list">
        <!-- Daftar postingan -->
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop posts -->
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{!! Str::limit(strip_tags($post->description), 50) !!}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection