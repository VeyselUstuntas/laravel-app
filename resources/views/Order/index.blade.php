@extends('layouts.layout')


@section('content')
    <div class="container mt-2 d-flex justify-content-end align-items-center">
        <a href="/orders/add-order/" class="btn btn-warning">Add Order</a>
    </div>
    <div class="container mt-3">
        @if (count($orderList) <= 0)
            <div class="alert alert-danger">
                <div class="d-flex justify-content-center align-item-center">Sipariş Yok.</div>
            </div>
        @else
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
            <div class="table-responsive" style="max-height: 750px; overflow-y: auto;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Customer Info</th>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Order Id</th>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Product Name</th>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Product Price</th>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Piece</th>
                            <th style="position: sticky; top: 0; background-color: #fff; z-index: 1;" scope="col">Total Cost</th>
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
        @endif

    </div>
@endsection
