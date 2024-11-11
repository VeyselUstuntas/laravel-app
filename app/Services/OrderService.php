<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class OrderService extends Service
{

    public function __construct() {}

    public function getAllOrderList() {
        $orders = DB::select("SELECT CONCAT(u.name,' ',UPPER(u.surname)) as 'customer_info',o.id as 'order_id',UPPER(p.name) as 'product_name', p.price as 'product_price', oi.quantity as 'piece', (oi.quantity * p.price) as 'total_cost' FROM order_items as oi LEFT OUTER JOIN orders as o on o.id = oi.order_id LEFT OUTER JOIN users as u on u.id = o.user_id LEFT OUTER JOIN products as p on p.id = oi.product_id ORDER BY u.id ASC, o.id ASC;");
        return $orders;
    }
}
