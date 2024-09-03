@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")



<div id="alert-wrapper">
    @if($errors->any())
        <div class="alert error">
            @foreach ($errors->all() as $error) 
                <p class="error-message">{{ $error }}</p>
            @endforeach

            @if(isset($contentError))
                <p class="error-message">{{ $contentError }}</p>
            @endif
        </div>
    @endif

    @if (session('message'))
        <div class="alert succes">{{ session('message') }}</div>
    @endif
</div>


<h1 class="center-text">Iniciar Sesión</h1>


<div id="form-wrapper">
<form method="post" action="/login" id="login-form">
    @csrf


    <div class="input-wrapper">
        <label for="user">Usuario <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('user') }}" name="user" id="user" type="text"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="password">Contraseña <span class="requerido">*</span></label>

        <md-outlined-text-field name="password" id="password" type="password"></md-outlined-text-field>
    </div>

    <div class="input-wrapper">
        <div id="activo-wrapper">
            <label for="remember" id="label-activo">Mantener Sesión</label>

            <md-checkbox touch-target="wrapper" name="remember" id="remember"></md-checkbox>
        </div>
    </div>


    <div id="button-wrapper">
        <div class="button-container">
            <md-elevated-button type="submit">Iniciar Sesión</md-elevated-button>
        </div>

        <div class="button-container">
            <md-elevated-button type="button" id="register">Registrarse</md-elevated-button>

            <script defer>
                let boton = document.querySelector("#register")
                boton.addEventListener("click", function(){window.location.href = "/register"})
            </script>
        </div>
    </div>
</div>

</form>







@endsection

