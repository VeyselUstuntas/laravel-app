<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name','price'];

    public function orderItem():HasMany{
        return $this->hasMany(OrderItem::class);
    }
}
