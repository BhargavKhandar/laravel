<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\IUserRepo;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    // private IUserRepo $iUserRepo;
    protected $user;
    public function __construct(IUserRepo $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
        return response()->json([
            'status' => true,
            'data' => $users,
            'message' => 'Query OK',
        ]);
    }
}
