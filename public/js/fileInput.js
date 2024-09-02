document.addEventListener('DOMContentLoaded', function () {
    let boton = document.querySelector("#boton-archivo");

    boton.addEventListener("click", function(){
        document.querySelector('#destacado').click();
    })


    let archivo = document.querySelector("#nombre-archivo")

    document.getElementById('destacado').addEventListener('change', function(e) {
        if (e.target.files[0]) {
            archivo.textContent = 'Archivo seleccionado: ' + e.target.files[0].name;
        }
      });
});