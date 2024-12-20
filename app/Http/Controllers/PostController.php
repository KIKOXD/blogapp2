<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
}
