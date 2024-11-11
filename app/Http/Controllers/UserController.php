<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userList;
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $this->userList = $this->getAllUser();
        return view("User.index", ["userList" => $this->userList]);
    }

    public function getAllUser()
    {
        return $this->userService->getAllUserList();
    }
}
