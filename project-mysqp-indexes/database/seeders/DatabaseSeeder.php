<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating a user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 50 posts
        Post::factory(1000)->create();

        // Create 1000 comments
        Comment::factory(1000)->create();

        // Create 1000 categories
        Category::factory(1000)->create();

        // Create 1000 post-category relationships
        PostCategory::factory(1000)->create();
    }
}

