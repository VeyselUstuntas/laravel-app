<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productList;
    public function __construct(protected ProductService $productService) {}

    public function index(){
        $this->productList = $this->getAllProducts();
        return view("Product.index",["productsList"=>$this->productList]);
    }

    public function getAllProducts()
    {
        return $this->productService->getAllProductList();
    }
}
