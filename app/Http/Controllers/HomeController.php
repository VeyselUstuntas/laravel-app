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
            return view("Home.index", ["districts" => $district, "query" => $this->getQuery()]);
        } else {
            return redirect()->route("Login.index");
        }
    }

    public function getCityAndDistrict()
    {
        // n+1 problemine yol açar
        return District::all();

        // n+1 problemi çözümü 1. yol
        // return District::with('city')->get();

        // n+1 problemi çözümü 2. yol

        // return DB::table("cities")
        //     ->leftJoin('districts', 'cities.id', '=', 'districts.city_id')
        //     ->select('cities.name as city_name', 'districts.name as district_name')
        //     ->get();
    }

    public function getQuery()
    {
        // $sql = DB::table("districts")->where("city_id",7)->toSql();
        $sql = DB::table('cities')
            ->leftJoin('districts', 'districts.city_id', '=', 'cities.id')
            ->selectRaw('cities.name as city_name, count(districts.city_id) as district_count')
            ->groupBy('cities.name')
            ->havingRaw("count(districts.city_id) < ?", [10])
            ->whereRaw('cities.id IN(?,?,?,?)', [1, 2, 3, 4])
            ->orderBy('cities.name, count(districts.city_id)', 'desc');

        $parameters = $sql->getBindings();
        $rawQuery = $sql->toSql();
        foreach ($parameters as $param) {
            $rawQuery = preg_replace('/\?/', $param, $rawQuery,1);
        }
        return str_replace('`', '', $rawQuery);
    }
}
