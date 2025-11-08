<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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


    <h1>Registro</h1>
            
    <div class="container_login">
            <div class="login_form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf <!-- CSRF protection token -->

                    <div>
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation">Confirmar Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit">Registrase</button>
                </form>

            </div>        
    </div> 
            

          
    
</body>
</html>