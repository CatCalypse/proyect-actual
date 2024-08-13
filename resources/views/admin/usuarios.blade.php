<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="create-form">
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
        <label for="rol">Rol</label>
        <input type="checkbox" name="rol" id="rol" checked>
    </div>

    <div>
        <label for="rol">Rol</label>
        <input type="text" name="rol" id="rol">
    </div>

    <div>
        <input type="submit" value="Register">
    </div>
</form>
</div>

</body>
</html>