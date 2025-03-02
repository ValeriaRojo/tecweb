document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("formularioProductos");

    formulario.addEventListener("submit", function(event){
        event.preventDefault();

        let nombre = document.getElementById("form-nombre").value.trim();
        let marca = document.getElementById("form-marca").value.trim();
        let modelo = document.getElementById("form-modelo").value.trim();
        let precio = document.getElementById("form-precio").value.trim();
        let detalles = document.getElementById("form-detalles").value.trim();
        let unidades = document.getElementById("form-unidades").value.trim();
        let imagen = document.getElementById("form-img").value.trim();

        if (nombre === "" || nombre.length > 100){
            alert("Nombre obligatorio que no sobrepase los 100 caracteres.");
            return;
        }

        if (marca === ""){
            alert("Debe de seleccionar una marca");
            return;
        }

        if (modelo === "" || modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(modelo)){
            alert("El modelo es obligatorio, alfanumérico y máximo 25 caracteres.");
            return;
        }

        if (precio === "" || isNaN(precio) || parseFloat(precio) <= 99.99){
            alert("Los detalles no deben de superar los 250 caracteres.");
            return;
        }

        if (unidades === "" || isNaN(unidades) || parseInt(unidades) < 0){
            alert("Debes de escoger una cantidad de unidades mayor o igual a 0.");
            return;
        }

        if (imagen === ""){
            document.getElementById("form-img").value = "img_2/imagen.png";
        }

        formulario.submit();
    });
});