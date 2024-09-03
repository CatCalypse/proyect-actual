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

<h1 class="center-text">Registrarse</h1>
<div id="form-wrapper">
<form method="post" action="/register" id="user-form">
    @csrf

    <div class="input-wrapper">
        <label for="nombre">Nombre <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('nombre') }}" name="nombre" id="nombre" type="text"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="apellido">Apellido <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('apellido') }}" name="apellido" id="apellido" type="text"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="user">Usuario <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('user') }}" name="user" id="user" type="text"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="password">Contraseña <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('password') }}" name="password" id="password" type="password"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="mail">Correo <span class="requerido">*</span></label>

        <md-outlined-text-field value="{{ old('mail') }}" name="mail" id="mail" type="mail"></md-outlined-text-field>
    </div>

    <div class="input-wrapper">
        <div id="activo-wrapper">
            <label for="remember" id="label-activo">Mantener Sesión</label>

            <md-checkbox touch-target="wrapper" name="remember" id="remember"></md-checkbox>
        </div>
    </div>


    <div>
        <md-elevated-button type="submit">Registrarse</md-elevated-button>
    </div>

</form>
</div>
@endsection