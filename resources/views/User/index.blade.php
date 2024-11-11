@extends('layouts.layout')

@section('content')
    <div class="container">
        @if (count($userList) <= 0)
            <div class="alert alert-danger">
                <div class="d-flex justify-content-center align-item-center">Kullanıcı Yok.</div>
            </div>
        @else
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                @foreach ($userList as $user)
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </tbody>
                @endforeach

            </table>
        @endif

    </div>
@endsection
