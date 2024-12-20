<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Tampilkan halaman posts
    public function index()
    {
        return view('admin.posts.index');
    }

    // Fungsi untuk membuat post baru
    public function create()
    {
        return view('admin.posts.create');
    }

    // Fungsi untuk menyimpan post baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        // Simpan logika penyimpanan post ke database
        // Contoh:
        // Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat!');
    }
}
