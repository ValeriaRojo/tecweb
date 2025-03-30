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
    let JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}

$(document).ready(function(){
    console.log('jQuery está funcionando');
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
            
                if(Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item text-danger text-decoration-none">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            //console.log(search);
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        const productos = JSON.parse(response);
                        
                        if(Object.keys(productos).length > 0) {
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item text-danger text-decoration-none">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            $('#product-result').show();
                            $('#container').html(template_bar);
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        //Agregamos validaciones
        function validaciones(product){
            //console.log(product)
            if (!product.nombre || product.nombre.length > 100) {
                alert("Nombre obligatorio y no debe sobrepasar los 100 caracteres.");
                return false;
            }
        
            if (!product.marca || product.marca > 25) {
                alert("Debe seleccionar una marca.");
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

        let postData = JSON.parse( $('#description').val() );
        postData['nombre'] = $('#name').val();
        postData['id'] = $('#productId').val(); 

        if (!validaciones(postData)) {
            return;
        }

        //Decidimos si se hace una inserción o actualización del producto
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, JSON.stringify(postData), (response) => {
            console.log("Datos que se envían al servidor:", JSON.stringify(postData, null, 2)); //Verificamos que se esté enviando los datos correctos
            console.log("Respuesta del servidor:", response); // <-- Imprime la respuesta en la consola
            try {
                const respuesta = JSON.parse(response);
                console.log("JSON válido:", respuesta);
            } catch (e) {
                console.error("Error al parsear JSON:", e);
                alert("Error en la respuesta del servidor. Revisa la consola.");
            }
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            $('#name').val('');
            $('#description').val(JsonString);
            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            let element = $(this)[0].activeElement.parentElement.parentElement;
            let id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            delete(product.nombre);
            delete(product.eliminado);
            delete(product.id);
            let JsonString = JSON.stringify(product,null,2);
            $('#description').val(JsonString);
            
            edit = true;
        });
        e.preventDefault();
    });    
});


