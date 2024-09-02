document.addEventListener('DOMContentLoaded', function () {
    let boton = document.querySelector("#boton-archivo");

    boton.addEventListener("click", function(){
        document.querySelector('#upload').click();
    })


    let archivo = document.querySelector("#nombre-archivo")

    document.getElementById('upload').addEventListener('change', function(e) {
        if (e.target.files[0]) {
            archivo.textContent = 'Archivo seleccionado: ' + e.target.files[0].name;
        }
    });
});