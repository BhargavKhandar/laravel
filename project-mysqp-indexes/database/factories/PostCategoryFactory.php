<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    protected $model = PostCategory::class;

    public function definition()
    {
        return [
            'post_id' => $this->faker->unique()->randomElement(Post::pluck('id')->toArray()), // Unique random post_id
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),  // Random category_id
        ];
    }
}
