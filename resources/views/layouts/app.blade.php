<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">My Blog</a>
            <div>
                @auth
                    <span class="text-white me-2">Hi, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-sm btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

</body>
</html>
