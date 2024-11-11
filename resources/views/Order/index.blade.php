@extends('layouts.layout')

@php
    $orderId = $orderList[0]->order_id;
    $colorIndex = 0;
    $colorList = [
        'table-primary',
        'table-secondary',
        'table-success',
        'table-danger',
        'table-warning',
        'table-info',
        'table-light',
        'table-dark',
    ];
@endphp
@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Customer Info</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Piece</th>
                    <th scope="col">Total Cost</th>
                </tr>
            </thead>
            @foreach ($orderList as $order)
                <tbody>
                    @if ($order->order_id != $orderId)
                        @php
                            $colorIndex = ($colorIndex + 1) % 8;
                        @endphp
                    @endif
                    @php
                        $orderId = $order->order_id;
                    @endphp
                    <tr class={{ $colorList[$colorIndex] }}>
                        <td>{{ $order->customer_info }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->product_price }}</td>
                        <td>{{ $order->piece }}</td>
                        <td>{{ $order->total_cost }}</td>
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>
@endsection
