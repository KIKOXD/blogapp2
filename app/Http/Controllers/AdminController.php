<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $recentUsers = User::latest()->paginate(10);
        $recentPosts = Post::latest()->paginate(10);
        
        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'recentUsers', 'recentPosts'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        // Logic untuk menyimpan user baru
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Logic untuk update user
    }

    public function destroyUser($id)
    {
        // Logic untuk menghapus user
    }

    public function settings()
    {
        return view('admin.settings');
    }
}