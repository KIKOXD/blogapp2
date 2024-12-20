@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Postingan</h1>

    <!-- Tombol Create Post -->
    <div class="create-post-btn" style="text-align: right; margin-bottom: 20px;">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">+ Create Post</a>
    </div>

    <!-- Tabel Daftar Postingan -->
    <table class="post-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $index => $post)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="image-column">
                        @if ($post->image)
                            <a href="#" class="image-popup" data-image="{{ asset('storage/' . $post->image) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="post-image">
                            </a>
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{!! \Illuminate\Support\Str::limit(strip_tags($post->description), 50, '...') !!}</td>
                    <td>
                        <div class="action-buttons" style="display: flex; gap: 10px;">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Popup untuk Gambar -->
<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage" alt="Popup Image">
</div>

<script>
    // Event Listener untuk Image Popup
    document.querySelectorAll('.image-popup').forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modal.style.display = "flex"; // Gunakan flex untuk menampilkan modal di tengah
            modalImage.src = item.getAttribute('data-image');
        });
    });

    // Close Modal
    document.querySelector('.modal .close').addEventListener('click', () => {
        document.getElementById('imageModal').style.display = "none";
    });
</script>
@endsection