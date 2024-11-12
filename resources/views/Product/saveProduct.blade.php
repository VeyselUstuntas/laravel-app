@extends('layouts.layout')
@section('title','Save Product')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ is_array($error) ? implode(', ', $error) : $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Product Information Form</h2>
        <form method="POST" action="{{ route('Product.saveProduct') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Enter Product Name">
            </div>

            <div class="form-group mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}"
                    placeholder="Enter Price">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
