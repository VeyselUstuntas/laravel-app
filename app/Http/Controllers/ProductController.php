<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function saveProduct(Request $request){
        $validation = $request->validate(
            [
                'name'=>["required"],
                'price'=>["required"]
            ],
            [
                'name.required'=>["Enter Product Name"],
                'price.required'=>["Enter Product Price"],
            ]
        );

        $product = new Product();
        $product->fill([
            'name'=>$request->name,
            'price'=>$request->price
        ]);

        $this->productService->saveProduct($product);
        return redirect()->route("Product.saveProduct")->with('success',"Product added successfully!");
    }

    public function getSaveProductForm(){
        return view("Product.saveProduct");
    }

}
