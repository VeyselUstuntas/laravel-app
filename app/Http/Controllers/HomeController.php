<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use DebugBar\DataCollector\RequestDataCollector;
use Illuminate\Support\Facades\DB;
use PDO;
use DebugBar\StandardDebugBar;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends Controller
{
    public function index()
    {
        // return view("Home.index", [$this->getOrdersWithOutOrm()]);
        // return view("Home.index", [$this->getOrdersWithOrm()]);

        // return $this->getOrdersWithOrm();
        return $this->getOrdersWithOutOrm();
        // return $this->getOrdersRawSqlQuery();
    }

    public function getOrdersRawSqlQuery()
    {
        $users = DB::select("SELECT id, name, email FROM users");

        $usersData = array();
        $ordersData = array();
        $orderItemsData = array();

        foreach ($users as $user) {
            $orders = DB::select("SELECT * FROM orders WHERE user_id = :user_id", ['user_id' => $user->id]);

            foreach ($orders as $order) {
                $orderItems = DB::select("SELECT * FROM order_items WHERE order_id = :order_id", ['order_id' => $order->id]);

                foreach ($orderItems as $orderItem) {
                    $products = DB::select("SELECT id,name,price FROM products WHERE id = :product_id", ['product_id' => $orderItem->product_id]);

                    $orderItemsData[] = [
                        'order_item_id' => $orderItem->id,
                        'order_id' => $orderItem->order_id,
                        'product_id' => $orderItem->product_id,
                        'quantity' => $orderItem->quantity,
                        'products' => $products
                    ];
                    $products = [];
                }

                $ordersData[] = [
                    'order_id' => $order->id,
                    'order_items' => $orderItemsData
                ];
                $orderItemsData = [];
            }


            $usersData[] = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'orders' => $ordersData
            ];
            $ordersData = [];
        }
        return response()->json($usersData);
    }


    public function getOrdersWithOutOrm()
    {
        $usersData = [];
        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        foreach ($users as $user) {
            $orders = DB::table('orders')
                ->where('user_id', '=', $user->id)->select(['id', 'user_id'])
                ->get()
                ->map(function ($order) {
                    $orderItems = DB::table('order_items')->select(['id', 'product_id', 'quantity'])
                        ->where('order_id', '=', $order->id)
                        ->get()
                        ->map(function ($orderItem) {
                            $product = DB::table('products')->select(['name', 'price'])
                                ->where('id', '=', $orderItem->product_id)
                                ->get();

                            $orderItem->product = $product;
                            return $orderItem;
                        });

                    $order->orderItems = $orderItems;
                    return $order;
                });

            $user->orders = $orders;
            $usersData[] = $user;
        }
        return response()->json($usersData);
    }


    public function getOrdersWithOrm()
    {
        $users = User::with([
            'orders',
            'orders.orderItems',
            'orders.orderItems.product'
        ]);

        $data = $users->get();

        return response()->json($data);
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
