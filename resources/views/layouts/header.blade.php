@use('Illuminate\Support\Facades\Auth')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>


    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
</head>

<body>
    <header>
        <div>
            @if(Auth::check())
                @if(getRol() != 3)
                    <div id="control-header">
                        <a href="/admin/redactar">Redactar Noticias</a>
                        @if(getRol() == 1)
                            <a href="/admin/usuarios">Usuarios</a>
                            <a href="/admin/noticias">Noticias</a>
                        @endif
                    </div>
                @endif
                
                <div id="header-content">
                    <a href="/logout">LogOut</a>
                </div>

            @endif

            @if(!Auth::check())
                <button id="boton">Iniciar Sesión</button>

                <script>
                    boton = document.querySelector("#boton")
                    boton.addEventListener("click", function(){window.location.href = "/login"})
                </script>
            @endif
        </div>

    </header>    

    <main>
