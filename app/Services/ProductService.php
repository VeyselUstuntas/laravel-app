<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends Service
{

    public function __construct() {}

    public function getAllProductList()
    {
        $products = Product::all();
        return $products;
    }
}
