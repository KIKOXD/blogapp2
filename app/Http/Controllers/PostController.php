<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Tampilkan halaman posts
    public function index()
    {
        // Load semua postingan dari database
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // Fungsi untuk membuat post baru
    public function create()
    {
        return view('admin.posts.create');
    }

    // Fungsi untuk menyimpan post baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Buat instance baru Post
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        // Simpan data ke database
        $post->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dibuat!');
    }

    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    // Fungsi untuk mengupdate post
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Ambil post yang akan diupdate
        $post = Post::findOrFail($id);

        // Update data
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            // Upload gambar baru
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        // Simpan perubahan
        $post->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Cari post berdasarkan ID
        $post = Post::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        // Hapus post dari database
        $post->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
