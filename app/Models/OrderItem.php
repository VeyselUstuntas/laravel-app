<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public int $id;
    public int $orderId;    
    public int $productId;
    public int $quantity;

    public function __construct() {}
}
