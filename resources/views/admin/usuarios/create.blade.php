@extends("layouts.layout")

@section("title", "NHdiario")

@section ("content")
<form method="post" action="/create"/>
    @csrf
    <div>
        <label for="mail">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="">
    </div>

    <div>
        <label for="mail">Apellido</label>
        <input type="text" name="apellido" id="apellido" value="">
    </div>

    <div>
        <label for="user">Usuario</label>
        <input type="text" name="user" id="user" value=""/>
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="">
    </div>

    <div>
        <label for="mail">Correo</label>
        <input type="text" name="mail" id="mail" value="">
    </div>

    <div>
        <label for="activo">Activo</label>
        <input type="checkbox" name="activo" id="activo" checked>
    </div>

    <div>
        <label for="rol">Rol</label>

        <select name="rol" id="rol">
            <option value="">--Seleccionar Rol--</option>
            @foreach(getAllRoles() as $rol)
                <option value="{{$rol->id}}">{{ $rol->rol}}</option>
            @endforeach
        </select>
    </div>

    <div>
        <input type="submit" value="Crear">
    </div>

</form>
@endsection
