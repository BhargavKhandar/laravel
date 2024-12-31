<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHome()
    {
        return view('welcome');
    }

    public function showBlog()
    {
        return view('blog');
    }

    public function showUser(string $id)
    {
        return view('user', compact('id'));
    }
}
