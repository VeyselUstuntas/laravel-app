<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{

    protected $fillable = ['order_id', 'product_id', 'quantity'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','order_id','product_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
