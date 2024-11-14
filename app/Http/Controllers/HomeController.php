<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    public function index()
    {
        // dd($this->getOrdersWithOutOrm());
        // return response()->json($this->getOrdersWithOutOrm());
        return response()->json($this->getOrdersWithOrm());
    }

    public function getOrdersWithOutOrm()
    {
        $orders = DB::table('order_items')  // Burada düzeltme yapıldı
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->selectRaw("users.name as customer_name, orders.id as order_id, products.name as product_name, order_items.quantity as piece")
            ->get();

        return $orders;
    }

    public function getOrdersWithOrm()
    {
        $users = User::with([
            'orders:id,user_id',
            'orders.orderItems:order_id,product_id,quantity',
            'orders.orderItems:id,name'
        ])->get();
        return $users;
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
            $rawQuery = preg_replace('/\?/', $param, $rawQuery, 1);
        }

        return str_replace('`', '', $rawQuery);
    }

    public function getOrmQuery()
    {
        $query = City::leftJoin('districts', 'districts.city_id', '=', 'cities.id')
            ->select('cities.name as city_name', DB::raw('count(districts.city_id) as district_count'))
            ->groupBy('cities.name')
            ->havingRaw('count(districts.city_id) < ?', [10])
            ->whereIn('cities.id', [1, 2, 3, 4])
            ->orderByRaw('cities.name, count(districts.city_id) desc');

        $parameters = $query->getBindings();
        $rawQuery = $query->toSql();

        foreach ($parameters as $param) {
            $rawQuery = preg_replace('/\?/', $param, $rawQuery, 1);
        }

        return str_replace('`', '', $rawQuery);
    }
}
