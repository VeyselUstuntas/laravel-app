<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    public int $id;
    public int $orderId;
    public int $productId;
    public int $quantity;

    public function __construct() {}

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orders():BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
