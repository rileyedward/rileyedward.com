<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(): Response
    {
        return inertia('blog/blog-index');
    }

    public function show(BlogPost $blogPost): Response
    {
        return inertia('blog/blog-show', [
            'blogPost' => $blogPost,
        ]);
    }
}
