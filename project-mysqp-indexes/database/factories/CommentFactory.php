<?php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id, // Assign a random post to each comment
            'comment' => substr($this->faker->paragraph, 0, 255),
        ];
    }
}
