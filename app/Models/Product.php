<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','id'];

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
