@use('Illuminate\Support\Facades\Auth')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://9000-idx-proyect-actual-1722536483066.cluster-rz2e7e5f5ff7owzufqhsecxujc.cloudworkstations.dev/css/header.css">
</head>
<body>
    <header>
        <div>
        
            @if(Auth::check())
                @if(getRole() != 3)
                    <div id="control-header">
                        <a href="redactar" style="color:white">Redactar Noticias</a>
                        @if(getRole() == 1)
                            <a href="admin-usuarios">Usuarios</a>
                            <a href="admin-noticias">Noticias</a>
                        @endif
                    </div>
                @endif
                
                <div id="header-content">
                    <a href="/logout">LogOut</a>
                </div>

            @endif

            @if(!Auth::check())
                <button id="boton">Iniciar Sesión</button>

                <script>
                    boton = document.querySelector("#boton")
                    boton.addEventListener("click", function(){window.location.href = "/login"})
                </script>
            @endif
        </div>

    </header>    

</body>
</html>

