<?php

namespace App\Models;

class OrderItemSave{
    public int $productId;
    public int $qty;

    public function __construct(int $productId, int $qty) {
        $this->productId = $productId;
        $this->qty = $qty;
    }


}