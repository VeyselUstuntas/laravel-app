<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larevel App | @yield('title') </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
</head>

<body>
    @php
        $user = Auth::user();
    @endphp
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            @if (Auth::check())
                <a class="navbar-brand" href="/">Navbar</a>
            @else
                <a class="navbar-brand" href="/login">Navbar</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/home">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/users">Users</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/orders">Orders</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/products">Products</a>
                    </li>

                </ul>

                <ul class="navbar-nav me-1">

                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link active-user">Welcome, <span
                                    class="badge text-bg-success pb-2 pt-2">{{ $user->name . ' ' . $user->surname }}</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"><span
                                    class="badge text-bg-warning pb-2 pt-2">Logout</span></a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>
