@extends('layouts.layout')

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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-3">
        <form method="POST" action="{{ route('Register.index') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">User Register</h1>

            <div class="form-group mt-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" 
                    autofocus>
            </div>
            <div class="form-group mt-2">
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname" class="form-control" placeholder="Enter Surname" 
                    autofocus>
            </div>


            <div class="form-group mt-2">
                <label for="inputEmail">Email address</label>
                <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" 
                    autofocus>
            </div>

            <div class="form-group mt-2">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                    >
            </div>

            <button class="btn btn-lg btn-primary mt-2" type="submit">Register</button>
        </form>
    </div>
@endsection
