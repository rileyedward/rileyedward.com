<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the home page with featured work.
     */
    public function __invoke(): Response
    {
        return Inertia::render('public/Home', [
            'featuredProjects' => ProjectResource::collection(
                Project::query()->visible()->where('is_featured', true)->ordered()->get(),
            ),
        ]);
    }
}
