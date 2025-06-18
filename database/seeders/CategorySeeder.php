<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Tech',
            'Games',
            'Movies',
            'Personal',
        ];

        foreach ($categories as $category) {
            Category::query()->create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
