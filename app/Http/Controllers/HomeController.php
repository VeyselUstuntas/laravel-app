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
        // return view("Home.index", [$this->getOrdersWithOrm()]);

        // return $this->getOrdersWithOptimizedOrm();
        // return $this->getOrdersWithNonOptimizedOrm();
        // return $this->getOrdersWithNestedQueries();
        return $this->getOrdersWithRawQuery();
    }

    public function getOrdersWithRawQuery()
    {
        $orders = DB::select("SELECT u.id as user_id, u.name as user_name, u.email as user_email,o.id as order_id, oi.id as order_item_id,  oi.quantity as piece, p.name as product_name, p.price as product_price FROM order_items as oi LEFT JOIN orders as o on oi.order_id = o.id LEFT JOIN products as p on oi.product_id = p.id LEFT JOIN users as u on o.user_id = u.id ORDER BY o.user_id ASC, oi.order_id ASC, oi.id ASC;");

        $userId = $orders[0]->user_id;
        $orderId = $orders[0]->order_id;
        $userName = $orders[0]->user_name;
        $userEmail = $orders[0]->user_email;

        $usersData = array();
        $ordersData = array();
        $orderItemsData = array();
        $productsData = array();

        foreach ($orders as $order) {
            if ($userId == $order->user_id) {
                if ($orderId == $order->order_id) {
                    $productsData = [
                        "name" => $order->product_name,
                        "price" => $order->product_price
                    ];

                    $orderItemsData[] = [
                        "order_item_id" => $order->order_item_id,
                        "quantity" => $order->piece,
                        "products" => $productsData
                    ];

                    $productsData = [];
                } else {
                    $ordersData[] = [
                        "order_id" => $orderId,
                        "order_items" => $orderItemsData
                    ];
                    $orderId = $order->order_id;
                    $orderItemsData = [];

                    //--

                    $productsData = [
                        "name" => $order->product_name,
                        "price" => $order->product_price
                    ];

                    $orderItemsData[] = [
                        "order_item_id" => $order->order_item_id,
                        "quantity" => $order->piece,
                        "products" => $productsData
                    ];

                    $productsData = [];
                }
            } else {
                $ordersData[] = [
                    "order_id" => $orderId,
                    "order_items" => $orderItemsData
                ];
                $orderId = $order->order_id;
                $orderItemsData = [];

                //--

                $usersData[] = [
                    "user_id" => $userId,
                    "user_name" => $userName,
                    "user_email" => $userEmail,
                    "orders" => $ordersData
                ];
                $userId = $order->user_id;
                $userName = $order->user_name;
                $userEmail = $order->user_email;
                $ordersData = [];
            }
        }
        $ordersData[] = [
            "order_id" => $orderId,
            "order_items" => $orderItemsData
        ];
        $orderId = $order->order_id;
        $orderItemsData = [];

        //--

        $usersData[] = [
            "user_id" => $userId,
            "user_name" => $userName,
            "user_email" => $userEmail,
            "orders" => $ordersData
        ];
        $userId = $order->user_id;
        $userName = $order->user_name;
        $userEmail = $order->user_email;
        $ordersData = [];

        return response()->json($usersData);
    }


    public function getOrdersWithNestedQueries()
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


    public function getOrdersWithNonOptimizedOrm()
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


    public function getOrdersWithOptimizedOrm()
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
