<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public int $id;
    public int $userId;
    public function __construct() {}

    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function orderItems():HasMany{
        return $this->hasMany(OrderItem::class);

    }
}
