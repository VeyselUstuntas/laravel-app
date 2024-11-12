@extends('layouts.layout')
@section('title','Save User')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Customer Information Form</h2>
        <form method="POST" action="{{ url('/user/add-user/') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Enter Name">
            </div>

            <div class="form-group mb-3">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" class="form-control" name="surname" id="surname" value="{{ old('surname') }}"
                    placeholder="Enter Surname">
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}"
                    placeholder="Enter Mail Address">
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
