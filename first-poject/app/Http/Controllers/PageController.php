<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function showUser()
    {
        return view('welcome');
    }
}
