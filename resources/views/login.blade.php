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

<div id="login_form">
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
        <input type="submit" value="Login">
    </div>
</form>
</div>

<div>
    <button id="boton">Registrarse</button>

    <script>
        boton = document.querySelector("#boton")
        boton.addEventListener("click", function(){window.location.href = "/register"})
    </script>
</div>