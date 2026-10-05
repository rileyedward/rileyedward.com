<?php

namespace App\Support;

use Illuminate\Support\Str;

class Markdown
{
    /**
     * Render markdown to HTML with raw HTML stripped and unsafe links removed.
     */
    public static function render(string $markdown): string
    {
        return Str::markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 20,
        ]);
    }
}
