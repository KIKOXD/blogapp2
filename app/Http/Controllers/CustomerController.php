<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_active', true)
            ->latest()
            ->paginate(12);

        $totalPosts = Post::where('is_active', true)->count();

        return view('customer.index', compact('posts', 'totalPosts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('customer.show', compact('post'));
    }
}