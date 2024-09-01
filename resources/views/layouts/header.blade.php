@use('Illuminate\Support\Facades\Auth')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>


    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
</head>

<body>
    <header>
        <div>
            <div id="control-header">
                <div id="control-options">
                    @if(Auth::check())
                        <div id="control-links">
                            @if(getRol() != 3)
                                <a href="/admin/redactar">Redactar</a>
                                @if(getRol() == 1)
                                    <a href="/admin/usuarios">Usuarios</a>
                                    <a href="/admin/noticias">Noticias</a>
                                @endif
                            @endif
                        </div>

                        <a href="/logout">Cerrar Sesión</a>
                    @else
                        <div id="control-links"></div>

                        <a href="/login">Iniciar Sesión</a>
                    @endif
                </div>
            </div>
           


            <div id="header-content">
                <div id="brand">
                    <h1>NH Diario</h1>
                </div>
                <div id="header-links">
                    <a href="/">Portada</a>
                    
                    @php ($categoriasSlug = getCategorias())

                    @foreach($categoriasSlug as $cat)
                        <a href="/{{getSlug($cat->categoria)}}">{{$cat->categoria}}</a>
                    @endforeach
                </div>
            </div>
        </div>

    </header>    

    <main>
