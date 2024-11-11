<?php

namespace App\Services;

use App\Models\User;

class UserService extends Service
{

    public function __construct() {}

    public function getAllUserList()
    {
        $users = User::all();
        return $users;
    }
}
