$(function(){
    console.log('jQuery está funcionando');

    $('#search').keyup(function(e){
        let search = $('#search').val();
        //console.log(search);
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
                    //console.log(product);

                    let descripcion = '';
                    descripcion += '<li>precio: '+product.precio+'</li>';
                    descripcion += '<li>unidades: '+product.unidades+'</li>';
                    descripcion += '<li>modelo: '+product.modelo+'</li>';
                    descripcion += '<li>marca: '+product.marca+'</li>';
                    descripcion += '<li>detalles: '+product.detalles+'</li>';

                    template += `
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2">
                                    <strong>ID:</strong> ${product.id}
                                </div>
                                <div class="col-md-3">
                                    <strong>Nombre:</strong> ${product.nombre}
                                </div>
                                <div class="col-md-3">
                                    <strong>Marca:</strong> ${product.marca}
                                </div>
                                <div class="col-md-4">
                                    <strong>Descripción:</strong>
                                    <ul class="list-unstyled">
                                        ${descripcion.split(',').map(item => `<li>${item.trim()}</li>`).join('')}
                                    </ul>
                                </div>
                            </div>
                        </li>`;
                });

                $('#container').html(template);
            } 
        })
    })
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
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

