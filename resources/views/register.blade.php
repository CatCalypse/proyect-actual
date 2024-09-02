@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")
<h1>Registrarse</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach
        </ul>
    </div>

@endif


<div id="register-form">
<form method="post" action="/register"/>
    @csrf
    <div>
        <label for="mail">Nombre</label>
        <input type="text" name="nombre" id="nombre">
    </div>

    <div>
        <label for="mail">Apellido</label>
        <input type="text" name="apellido" id="apellido">
    </div>

    <div>
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user"/>
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password"/>
    </div>

    <div>
        <label for="mail">Correo</label>
        <input type="text" name="mail" id="mail">
    </div>

    <div>
        <label for="remember">Mantener sesión</label>
        <input type="checkbox" name="remember">
    </div>

    <div>
        <input type="submit" value="Register">
    </div>
</form>
</div>
@endsection