<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        @vite(['resources/css/app.css' ])
</head>
<body>
@if (auth()->check())
         <script>window.location.href = "{{ route('test')}}"; </script>
        @else
             
        @endif

        <div class="littelmenu">
            @if (Route::has('login'))
                <div class="menu1">
                    @auth
                        <a href="{{ url('/test') }}" class="item">Home</a>
                        <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        @else
                        <a href="{{ route('login') }}" class="item">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="item">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div> 
<h1>Login</h1>

    <div class="container_login">
            <div class="login_form">

            <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
            </form>

        </div>

    </div>        
    
    
</body>
</html>