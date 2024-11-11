<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderList;
    public function __construct(protected OrderService $orderService) {}

    public function index()
    {
        $this->orderList = $this->getAllOrders();
        return view("Order.index",["orderList"=>$this->orderList]);
    }

    public function getAllOrders(){
        return $this->orderService->getAllOrderList();
    }
}
