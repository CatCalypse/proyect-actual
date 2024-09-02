@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

<h1>Iniciar Sesión</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach


        </ul>
    </div>

@endif

@if( Session('AuthError'))
    <p>{{ session('AuthError') }}</p>
@endif

<div id="login-form">
<form method="post" action="/login"/>
    @csrf
    <div>
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user"/>
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password"/>
    </div>

    <div>
        <label for="remember">Mantener sesión</label>
        <input type="checkbox" name="remember" id="remember"/>
    </div>

    <div>
        <input type="submit" value="Login">
    </div>
</form>
</div>

<div>
    <button id="register">Registrarse</button>

    <script defer>
        let boton = document.querySelector("#register")
        boton.addEventListener("click", function(){window.location.href = "/register"})
    </script>
</div>

@endsection

