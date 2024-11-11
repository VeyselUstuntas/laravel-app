@extends('layouts.layout')

@section('content')
    <div class="container">
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
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>
@endsection
