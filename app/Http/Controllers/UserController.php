<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function saveUser(Request $request)
    {
        $validation = $request->validate(
            [
                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['required'],
                'password' => ['required']
            ],
            [
                'name.required' => 'Enter Name',
                'surname.required' => 'Enter Surname',
                'email.required' => 'Enter Email',
                'password.required' => 'Enter Password',
            ]
        );

        $user = new User();
        $user->fill([
            'name'=> $request->name,
            'surname'=> $request->surname,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        $this->userService->saveUser($user);
        return redirect()->route("User.saveUser")->with("success","User added successfully!");
    }

    public function getSaveUserForm()
    {
        return view("User.saveUser");
    }
}
