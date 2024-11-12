<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view("Home.index");
        } else {
            return redirect()->route("Login.index");
        }
    }

}
