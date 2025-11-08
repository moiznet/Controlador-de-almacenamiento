<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenido</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        @vite(['resources/css/app.css' ])
    </head>
    <body class="antialiased">
        <!-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif -->


        @if (auth()->check())
         
        @else
            <script>window.location.href = "{{ route('login')}}"; </script>
        @endif




        <div class="bigbotons">
            <a href="archivos">
                <div class="left">
                    <h1>Panel de usuario</h1>
                    <div class="svgs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 24 24"><path fill="#515253" d="M7.5 5C9.43 5 11 6.57 11 8.5S9.43 12 7.5 12S4 10.43 4 8.5S5.57 5 7.5 5M1 19v-2.5C1 14.57 4.46 13 7.5 13c1.18 0 2.42.24 3.5.64V19zm21 0h-8c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1h5l4 4v9c0 .55-.45 1-1 1m-4-9h3v-.17L18.17 7H18zm-3 2v1.5h6V12zm0 3v1.5h6V15z"/></svg>
                    </div>
                </div>
            </a>
            <a href="usuarios">
                <div class="left">
                    <h1>Panel de administrador</h1>
                    <div class="svgs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 16 16"><path fill="#515253" d="M6.5 12c0 .706.133 1.38.375 2H0a7 7 0 0 1 4.812-6.651a4 4 0 1 1 5.42-.992c-.283.387-.682.657-1.081.927q-.207.137-.406.282A5.5 5.5 0 0 0 6.5 12"/><path fill="#515253" fill-rule="evenodd" d="M16 12a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-1.5-.94L13.44 10l-1.88 1.879l-1-1l-1.06 1.06L11.56 14z" clip-rule="evenodd"/></svg>
                    </div>
                </div>
            </a>
        </div>









        

            




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
           
    </body>
</html>
