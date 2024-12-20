@extends('admin.layouts.master')

@section('content')
<h1>Daftar Postingan</h1>
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->description }}</td>
            <td>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100px; height: auto;">
                @else
                    <span>Tidak ada gambar</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a> | 
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus postingan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
