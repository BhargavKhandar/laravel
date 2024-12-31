<?php

namespace App\Repository;

use App\Models\User;

class UserRepo implements IUserRepo
{
    function all() :  array
    {
        $users = [
            new User([
                'name' => 'Harshit',
                'email' => 'harshit@gmail.com',
                'phone' => '1234567890',
                'city' => 'Rajkot',
            ]),
        ];

        return $users;
    }
}