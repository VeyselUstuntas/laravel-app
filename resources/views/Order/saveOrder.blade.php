@extends('layouts.layout')
@section('title','Save Order')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-2">
        <form method="POST" action="{{ url('/orders/add-order/') }}">
            @csrf

            <div class="form-group mt-2">
                <label for="user_id">Select Customer</label>
                <select class="form-control" id="user_id" name="userId">
                    <option value="">Select A Customer</option>
                    @foreach ($userList as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name . ' ' . $user->surname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="order-items">
                <div class="form-group mt-2">
                    <label for="product_id">Select Product</label>
                    <select class="form-control" name="productId[]">
                        <option value="">Select A Product</option>
                        @foreach ($productList as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name="qty[]" placeholder="Enter Product Quantity">
                </div>
            </div>

            <div class="button-group mt-3">
                <button type="button" id="add-product" class="btn btn-secondary">Add Other Product</button>
                <button type="submit" class="btn btn-primary my-2">Save</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const orderItemsContainer = document.getElementById('order-items');
            const newItem = document.createElement('div');

            newItem.innerHTML = `
                        <div class="form-group">
                            <label for="product_id">Select Product</label>
                            <select class="form-control" name="productId[]">
                                <option value="">Select a Product</option>
                                @foreach ($productList as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="quantity">Quantitiy</label>
                            <input type="number" class="form-control" name="qty[]" placeholder="Enter Product Quantity" >
                        </div>
            `;

            orderItemsContainer.appendChild(newItem);
        });
    </script>
@endsection
