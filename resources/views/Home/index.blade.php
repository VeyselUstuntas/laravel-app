@extends('layouts.layout')
@section('title', 'Home')

@section('content')
    Home
    @if (session('success'))
        <div class="alert alert-info">
            {{ session('success') }}
        </div>
    @endif
@endsection
