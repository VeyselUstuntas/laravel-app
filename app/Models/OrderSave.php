<?php

namespace App\Models;

class OrderSave
{
    public int $userId;
    /**
     * @var OrderItemSave[] $items
    */
    public array $items;

    public function __construct(array $data)
    {
        $this->userId = $data["userId"];
        $this->items = $data["items"];
    }
}