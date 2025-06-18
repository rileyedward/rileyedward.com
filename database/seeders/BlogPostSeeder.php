<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $files = scandir(public_path('blog-posts'));

        $markdownFiles = array_filter($files, function ($file) {
            return Str::endsWith($file, '.md');
        });

        foreach ($markdownFiles as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $slug = pathinfo($file, PATHINFO_FILENAME);
            $title = Str::title(str_replace('-', ' ', $slug));
            $content = file_get_contents(public_path('blog-posts/' . $file));
            $category = Category::query()->inRandomOrder()->first();

            BlogPost::query()->create([
                'category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'is_published' => true,
            ]);
        }
    }
}
