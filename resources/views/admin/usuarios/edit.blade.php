@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

@if( is_null(getUserData()))
<script>
    window.location.href = "/admin/usuarios";
</script>
@else


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


    @php($datos = getUserData())


    <div id="form-wrapper">
    <form method="post" action="/edit" id="user-form">
    @csrf

    <input type="hidden" name="id" id="id" value="{{ $datos->id }}">

    <div class="input-wrapper">
        <label for="nombre">Nombre <span class="requerido">*</span></label>

        <md-outlined-text-field name="nombre" id="nombre" type="text" value="{{ $datos->nombre }}"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="apellido">Apellido <span class="requerido">*</span></label>

        <md-outlined-text-field name="apellido" id="apellido" type="text" value="{{ $datos->apellidos }}"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="user">Usuario <span class="requerido">*</span></label>

        <md-outlined-text-field name="user" id="user" type="text" value="{{ $datos->usuario }}"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="password">Contraseña <span class="requerido">*</span></label>

        <md-outlined-text-field name="password" id="password" type="password"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <label for="mail">Correo <span class="requerido">*</span></label>

        <md-outlined-text-field name="mail" id="mail" type="mail" value="{{ $datos->correo }}"></md-outlined-text-field>
    </div>


    <div class="input-wrapper">
        <div id="activo-wrapper">
            <label for="activo" id="label-activo">Activo <span class="requerido">*</span></label>

            @if($datos->activo == 1)
                <md-checkbox touch-target="wrapper" name="activo" id="activo" checked></md-checkbox>
            @else
                <md-checkbox touch-target="wrapper" name="activo" id="activo"></md-checkbox>
            @endif
        </div>
    </div>


    <div class="input-wrapper">
        <label for="rol">Rol <span class="requerido">*</span></label>

        <md-outlined-select name="rol" id="rol">
            @foreach(getAllRoles() as $rol)
                @if($datos->rol == $rol->id)
                    <md-select-option value="{{$rol->id}}" selected>
                        <div slot="headline">{{ $rol->rol}}</div>
                    </md-select-option>
                @else
                    <md-select-option value="{{$rol->id}}">
                        <div slot="headline">{{ $rol->rol}}</div>
                    </md-select-option>
                @endif
            @endforeach
        </md-outlined-select>
    </div>

    <div>
        <md-elevated-button type="submit">Modificar</md-elevated-button>
    </div>

</form>
</div>

@endif

@endsection
