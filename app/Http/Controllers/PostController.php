<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Pastikan model Post sudah diimpor

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        // Simpan postingan ke database
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        // Simpan gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat!');
    }
}
