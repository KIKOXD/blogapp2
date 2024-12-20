<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil semua post dan urutkan dari yang terbaru
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('customer.index', compact('posts'));
    }
}