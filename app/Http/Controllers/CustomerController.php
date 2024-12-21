<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(12);
        return view('customer.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('customer.show', compact('post'));
    }
}