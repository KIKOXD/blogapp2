<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data users
        $totalUsers = \App\Models\User::count();
        $recentUsers = \App\Models\User::latest()->take(5)->get();

        // Ambil 10 postingan terbaru dengan relasi user
        $recentPosts = Post::with('user')
                            ->latest()
                            ->limit(10)
                            ->get();
        
        // Hitung total posts dan status
        $totalPosts = Post::count();
        $activePosts = Post::where('is_active', true)->count();
        $inactivePosts = Post::where('is_active', false)->count();
        
        // Tambahan data statistik
        $todayPosts = Post::whereDate('created_at', today())->count();
        $weeklyPosts = Post::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        
        // Data untuk chart mingguan
        $weeklyStats = Post::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data untuk chart
        $dates = [];
        $counts = [];
        foreach ($weeklyStats as $stat) {
            $dates[] = \Carbon\Carbon::parse($stat->date)->format('d M');
            $counts[] = $stat->total;
        }

        return view('admin.dashboard', compact(
            'recentPosts',
            'recentUsers',
            'totalUsers',
            'totalPosts',
            'activePosts',
            'inactivePosts',
            'todayPosts',
            'weeklyPosts',
            'dates',
            'counts'
        ));
    }
} 