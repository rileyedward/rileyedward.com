<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Markdown;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarkdownPreviewController extends Controller
{
    /**
     * Render markdown exactly as the public project page will.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'markdown' => ['nullable', 'string', 'max:50000'],
        ]);

        return response()->json(['html' => Markdown::render($validated['markdown'] ?? '')]);
    }
}
