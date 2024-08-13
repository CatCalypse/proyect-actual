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
                <?php
                    echo Auth::user();

                php?>
                <div id="control-header">
                    <a href="admin_users"></a>
    
                </div>
                
                <a href="/logout">LogOut</a>
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

