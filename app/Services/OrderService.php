<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemSave;
use App\Models\OrderSave;
use Illuminate\Support\Facades\DB;

class OrderService extends Service
{

    public function __construct(protected UserService $userService, protected ProductService $productService) {}

    public function getAllOrderList()
    {
        $orders = DB::select("SELECT CONCAT(u.name,' ',UPPER(u.surname)) as 'customer_info',o.id as 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi LEFT OUTER JOIN orders as o on o.id = oi.order_id LEFT OUTER JOIN users as u on u.id = o.user_id LEFT OUTER JOIN products as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;");
        return $orders;
    }

    public function getSaveOrderForm(): array
    {
        $userList = $this->userService->getAllUserList();
        $productList = $this->productService->getAllProductList();
        $data = array("userList" => $userList, "productList" => $productList);
        return $data;
    }

    public function saveOrder(OrderSave $orderSave)
    {
        $userId = $orderSave->userId;

        DB::insert("INSERT INTO orders(user_id) VALUES(?)",[$userId]);

        $orderId = DB::getPdo()->lastInsertId();

        foreach ($orderSave->items as $orderItem) {
            $orderItemSave = new OrderItemSave($orderItem->productId, $orderItem->qty);
            $this->saveOrderItem($orderId, $orderItemSave);
        }
    }
    
    public function saveOrderItem(int $orderId, OrderItemSave $orderSaveItem)
    {
        DB::insert("INSERT INTO order_items(order_id, product_id, quantity) VALUES(?,?,?)",[$orderId,$orderSaveItem->productId,$orderSaveItem->qty]);
    }
}
