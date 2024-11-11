<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public int $id;
    public int $userId;
    public function __construct() {}
}
