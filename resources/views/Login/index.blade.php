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
        <form method="POST" action="{{ route('Login.index') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <div class="form-group mt-2">
                <label for="inputEmail">Email address</label>
                <input type="text" name="email" id="inputEmail" class="form-control" value="{{old('email')}}" placeholder="Email address"
                    autofocus>
            </div>

            <div class="form-group mt-2">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
            </div>

            <div class="button-group mt-3">
                <button class="btn btn-lg btn-primary" type="submit">Sign In</button>
                <a class="btn btn-lg btn-info" href="{{route('Register.index')}}">Sign Up</a>
            </div>
        </form>
    </div>
@endsection
