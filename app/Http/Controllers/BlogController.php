<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();

        $blogPosts = BlogPost::query()
            ->with('category')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('blog/blog-index', [
            'categories' => $categories,
            'blogPosts' => $blogPosts,
        ]);
    }

    public function show(BlogPost $blogPost): Response
    {
        $blogPost->load('category');

        return inertia('blog/blog-show', [
            'blogPost' => $blogPost,
        ]);
    }
}
