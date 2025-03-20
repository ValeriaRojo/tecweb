$(function(){
    console.log('jQuery está funcionando');
    init();
    buscarProducto();
    $('#product-form').submit(function(e){
        agregarProducto(e);
    });
});

// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    //document.getElementById("description").value = JsonString;
    
    //Cambiamos y usamos jQuery para simplificar
    $('#description').val(JsonString);

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}

function validaciones(product){
    if (!product.nombre || product.nombre.length > 100) {
        alert("Nombre obligatorio y no debe sobrepasar los 100 caracteres.");
        return false;
    }

    if (!product.marca) {
        alert("Debe de seleccionar una marca.");
        return false;
    }

    if (!product.modelo || product.modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(product.modelo)) {
        alert("El modelo es obligatorio, alfanumérico y máximo 25 caracteres.");
        return false;
    }

    if (!product.precio || isNaN(product.precio) || parseFloat(product.precio) <= 99.99) {
        alert("El precio debe ser mayor a 99.99 y debe ser un número.");
        return false;
    }

    if (!product.unidades || isNaN(product.unidades) || parseInt(product.unidades) < 0) {
        alert("Las unidades deben ser un número mayor o igual a 0.");
        return false;
    }

    if (!product.imagen) {
        product.imagen = "img_2/imagen.png";
    }

    return true;

}

function buscarProducto(){
    //$('#search').keyup(function(e){
        /**let search = $('#search').val();
        //console.log(search);
        if (search === "") {
            $("#product-result").html("").removeClass("card my-4 d-block"); //Limpiamos si no existe búsqueda
            return;
        }*/

        let lastSearch = ""; //Almacenamos última búsqueda

        $('#search').on('input', function (e) {
        let search = $(this).val().trim(); 

        if (search === lastSearch) return;

        lastSearch = search; // Actualizamos la última búsqueda

        if (search === "") {
            $("#product-result").html("").removeClass("card my-4 d-block").html(""); // Limpiamos si no hay nada (búsqueda)
            return;
        }
        
        $.ajax({
            url: 'backend/product-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                //console.log(response);
                let products = JSON.parse(response);
                //console.log(products);
                let template = '';

                products.forEach(product => {
                    if(product.eliminado == 0){
                        //console.log(product);

                        let descripcion = `
                            <li>Precio: ${product.precio}</li>
                            <li>Unidades: ${product.unidades}</li>
                            <li>Modelo: ${product.modelo}</li>
                            <li>Marca: ${product.marca}</li>
                            <li>Detalles: ${product.detalles}</li>`;

                        template += `
                            <li class="list-group-item" data-id = "${product.id}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <td>${product.id}</td>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Nombre:</strong> ${product.nombre}
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Marca:</strong> ${product.marca}
                                    </div>
                                    <div class="col-md-5">
                                        <strong>Descripción:</strong>
                                        <ul class="list-unstyled">
                                            ${descripcion.split(',').map(item => `<li>${item.trim()}</li>`).join('')}
                                        </ul>
                                    </div>
                                </div>
                            </li>`;
                    }
                });
                
                if (template) {
                    $("#product-result").addClass("card my-4 d-block").html(template); // Muestra la barra de estado
                } else {
                    $("#product-result").removeClass("card my-4 d-block").html(""); // Oculta si no hay resultados
                }
                //$('#container').html(template);
            } 
        });
    });   
}

function listarProductos(){
    $.ajax({
        url: 'backend/product-list.php',
        type: 'POST',
        data: {},
        success: function(response){
            let products = JSON.parse(response);
            let template = '';

            products.forEach(product =>{
                if(product.eliminado == 0){

                    let descripcion = '';
                    descripcion += '<li>precio: '+product.precio+'</li>';
                    descripcion += '<li>unidades: '+product.unidades+'</li>';
                    descripcion += '<li>modelo: '+product.modelo+'</li>';
                    descripcion += '<li>marca: '+product.marca+'</li>';
                    descripcion += '<li>detalles: '+product.detalles+'</li>';

                    template += `
                        <li class="list-group-item" data-id="${product.id}">
                            <div class="row">
                                <div class="col-md-2">
                                    <td>${product.id}</td>
                                </div>
                                <div class="col-md-3">
                                    <strong>Nombre:</strong> ${product.nombre}
                                </div>
                                <div class="col-md-2">
                                    <strong>Marca:</strong> ${product.marca}
                                </div>
                                <div class="col-md-5">
                                    <strong>Descripción:</strong>
                                    <ul class="list-unstyled">${descripcion}</ul>
                                </div>
                            </div>
                        </li>`;
                }
            });
            $('#container').html(template);
        }

    });
}

function agregarProducto(e){
    e.preventDefault();

    var productoJsonString = $('#description').val();
    try{
        var finalJSON = JSON.parse(productoJsonString);
    } catch(error){
        alert("Error en el formato JSON.:(");
        return;
    }

    finalJSON['nombre'] = $('#name').val();

    if(!validaciones(finalJSON)){
        return;
    }

    productoJsonString = JSON.stringify(finalJSON, null, 2);
    /**
     * Aquí puedo agregar las validaciones antes de enviarlas al JSON
     */
    $.ajax({
        url: 'backend/product-list.php',
        type: 'POST',
        contentType: 'application/json',  // 📌 Indica que es un JSON
        data: JSON.stringify(finalJSON),
        success: function(response){
            try{
                let respuesta = JSON.parse(response);

                let template = `
                     <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;

                //Mostramos la barra de estado  
                $("#product-result").addClass("card my-4 d-block");
                $("#container").html(template);

                // Actualizamos la lista de productos
                listarProductos();
            } catch(error){
                console.error("Error al enviar la respuesta.", error);
            }
        },
        error: function(xhr, status, error){
            console.error("Error en la petición de AJAX", error);
        }

    });
}

function eliminarProducto(event){
    if(confirm("¿Deseas eliminar el producto?")){
        var id = $(event.target).closest('.list-group-item').data('id');

        $.ajax({
            url: 'backend/product-delete.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                try{
                    let respuesta = JSON.parse(response);

                    let template_bar = `
                        <li style="list-style: none;">Status: ${respuesta.status}</li>
                        <li style="list-style: none;">Message: ${respuesta.message}</li>
                    `;

                    $("#product-result").addClass("card my-4 d-block").html(template_bar);
                    listarProductos();
                } catch (error) {
                    console.error("Error en la respuesta del servidor", error);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición AJAX:", error);
            }
        });
    }

}


