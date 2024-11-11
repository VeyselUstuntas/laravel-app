<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItemSave;
use App\Models\OrderSave;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderList;
    public function __construct(protected OrderService $orderService) {}

    public function index()
    {
        $this->orderList = $this->getAllOrders();
        return view("Order.index", ["orderList" => $this->orderList]);
    }

    public function getAllOrders()
    {
        return $this->orderService->getAllOrderList();
    }

    public function getSaveOrderForm()
    {
        $data = $this->orderService->getSaveOrderForm();
        return view("Order.saveOrder", [
            "userList" => $data["userList"],
            "productList" => $data["productList"]
        ]);
    }

    public function saveOrder(Request $request)
    {
        $validated = $request->validate(
            [
                'userId' => ['required'],
                'productId.*' => ['required'],  
                'qty.*' => ['required']
            ],
            [
                'userId.required' => 'Select Customer!',
                'productId.*.required' => 'Select Product!',
                'qty.*.required' => 'Enter Piece',
            ]
        );


        $userId = $request->userId;

        /**
         * @var array $products
         */
        $products = $request->productId;

        /**
         * @var array $quantities
         */
        $quantities = $request->qty;

        $orderItemSaveList = [];
        for ($i = 0; $i < count($products); $i++) {
            $orderItemSaveModel = new OrderItemSave($products[$i], $quantities[$i]);
            $orderItemSaveList[] = $orderItemSaveModel;
        }

        $data = array("userId" => $userId, "items" => $orderItemSaveList);
        $orderSave = new OrderSave($data);
        $this->orderService->saveOrder($orderSave);
        return redirect('/orders/add-order/');
    }
}
