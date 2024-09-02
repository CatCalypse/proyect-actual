@extends("layouts.layout")

@section("title", "NH Diario")

@section ("content")

@if( is_null(getUserData()))
<script>
     window.location.href = "/admin/usuarios"
</script>
@else
    @php($datos = getUserData())

    @if ($errors->edit->any())
    <div>
        <ul>
            @foreach ($errors->edit->all() as $error)
                <li>{{ $error }}</li>

            @endforeach


        </ul>
    </div>

    @endif

    <form method="post" action="/edit"/>
    @csrf

    <input type="hidden" name="id" id="id" value="{{ $datos->id }}">
    
    <div>
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" value="{{ $datos->usuario }}"/>
    </div>

        <div>
        <label for="mail">Correo</label>
        <input type="text" name="mail" id="mail" value="{{ $datos->correo }}">
    </div>

    <div>
        <label for="mail">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ $datos->nombre }}">
    </div>

    <div>
        <label for="mail">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="{{ $datos->apellidos }}">
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="">
    </div>

    
    <div>
        <label for="rol">Rol</label>

        <select name="rol" id="rol">
            @foreach(getAllRoles() as $rol)
                @if($datos->rol == $rol->id)
                    <option value="{{$rol->id}}" selected>{{ $rol->rol}}</option>
                @else
                    <option value="{{$rol->id}}">{{ $rol->rol}}</option>
                @endif
            @endforeach
        </select>
    </div>


    <div>
        <label for="activo">Activo</label>
        @if($datos->activo == 1)
            <input type="checkbox" name="activo" id="activo" checked>
        @else
            <input type="checkbox" name="activo" id="activo">
        @endif
    </div>

    <div>
        <input type="submit" value="Editar">
    </div>

</form>
@endif





@endsection
