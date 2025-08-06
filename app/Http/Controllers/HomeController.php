<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $recentBlogPosts = BlogPost::query()
            ->with('category')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return inertia('home', [
            'recentBlogPosts' => $recentBlogPosts,
        ]);
    }
}
