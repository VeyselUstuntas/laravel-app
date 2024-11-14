@extends('layouts.layout')
@section('title', 'Home')

@section('content')
    Home
    @if (session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <di class="row">
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <th>Şehir</th>
                        <th>İlçe</th>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district)
                            <tr>
                                <td>{{ $district->city_name}}</td>
                                <td>{{ $district->district_name }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </di>
    </div>
@endsection
