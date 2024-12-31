<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $startTime = microtime(true); // Start timing

        $query = $request->input('query');
        $lowerCase = toLowerCase($query);

        // Perform search on different models
        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get();

        $posts = Post::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->get();

        $comments = Comment::where('comment', 'like', "%$query%")
            ->get();

        $categories = Category::where('name', 'like', "%$query%")
            ->get();

        $endTime = microtime(true); // End timing
        $processingTime = $endTime - $startTime; // Calculate processing time in seconds
        // dd($startTime, $endTime, $processingTime);

        // Pass the data and processing time to the view
        return view('results', [
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
            'categories' => $categories,
            'processingTime' => $processingTime,
        ]);
    }
}

