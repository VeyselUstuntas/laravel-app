<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $district = $this->getCityAndDistrict();
            return view("Home.index", ["districts" => $district]);
        } else {
            return redirect()->route("Login.index");
        }
    }

    public function getCityAndDistrict()
    {
        // n+1 problemine yol açar
        // return District::all();


        // n+1 problemi çözümü 1. yol
        // return District::with('city')->get();

        // n+1 problemi çözümü 2. yol

        return DB::table("cities")
            ->leftJoin('districts', 'cities.id', '=', 'districts.city_id')
            ->select('cities.name as city_name', 'districts.name as district_name')
            ->get();
    }
}
