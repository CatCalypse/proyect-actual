@use('Illuminate\Support\Facades\Auth')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('/css/header.css')}}">
</head>

<body>
    <header>
        <div>
            @if(Auth::check())
                @if(getRol() != 3)
                    <div id="control-header">
                        <a href="redactar">Redactar Noticias</a>
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
