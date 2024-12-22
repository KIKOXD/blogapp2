<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Tampilkan halaman posts
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();

        // Filter berdasarkan author
        if ($request->has('author') && $request->author !== '') {
            $query->where('user_id', $request->author);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter berdasarkan tanggal
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $totalPosts = $query->count();
        $posts = $query->paginate(10)->withQueryString();
        $authors = \App\Models\User::all();

        return view('admin.posts.index', compact('posts', 'authors', 'totalPosts'));
    }

    // Tambahkan method show setelah method index
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
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
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        try {
            // Upload gambar
            $imagePath = $request->file('image')->store('posts', 'public');

            // Generate slug dari title
            $slug = Str::slug($request->title);
            
            // Pastikan slug unik
            $count = 1;
            while (Post::where('slug', $slug)->exists()) {
                $slug = Str::slug($request->title) . '-' . $count;
                $count++;
            }

            // Buat post baru
            $post = Post::create([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'image' => $imagePath,
                'user_id' => auth()->id(),
                'is_active' => true
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('admin.posts.index')
                ->with('success', 'Postingan berhasil dibuat!');

        } catch (\Exception $e) {
            \Log::error('Error creating post: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal membuat postingan: ' . $e->getMessage())
                ->withInput();
        }
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

        try {
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
                $path = $request->file('image')->store('posts', 'public');
                $post->image = $path;
            }

            // Simpan perubahan
            $post->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.posts.index')
                ->with('success', 'Postingan berhasil diperbarui!');

        } catch (\Exception $e) {
            \Log::error('Error updating post: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal memperbarui postingan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Cari post berdasarkan ID
            $post = Post::findOrFail($id);

            // Hapus gambar dari storage jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            // Hapus post dari database
            $post->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.posts.index')
                ->with('success', 'Postingan berhasil dihapus!');
            
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')
                ->with('error', 'Gagal menghapus postingan: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'posts' => 'required|array',
            'posts.*' => 'exists:posts,id'
        ]);

        $posts = Post::whereIn('id', $request->posts)->get();

        foreach ($posts as $post) {
            // Delete image if exists
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            
            // Delete post
            $post->delete();
        }

        return redirect()->route('admin.posts.index')
            ->with('success', count($request->posts) . ' postingan berhasil dihapus!');
    }

    // Add new method for toggle status
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        $post->is_active = !$post->is_active;
        $post->save();
        
        return response()->json(['success' => true]);
    }

}
