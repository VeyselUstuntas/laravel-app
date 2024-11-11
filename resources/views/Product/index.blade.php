@extends('layouts.layout')

@section('content')
    <div class="container mt-2 d-flex justify-content-end align-items-center">
        <a class="btn btn-warning" href="/product/add-product/">Add Product</a>
    </div>
    <div class="container">
        @if (count($productsList) <= 0)
            <div class="alert alert-danger mt-2">
                <div class="d-flex justify-content-center align-item-center">Ürün Yok.</div>
            </div>
        @else
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                @foreach ($productsList as $product)
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        @endif

    </div>
@endsection
