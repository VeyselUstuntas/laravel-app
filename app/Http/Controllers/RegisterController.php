<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view("Register.index");
    }

    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        $user = new User();
        $user->fill([
            'name'=> $request->name,
            'surname'=> $request->surname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $user->save();

        return redirect()->route("Login.index")->with("User Creation Success");
    }
}
