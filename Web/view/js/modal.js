$('#modalProductos').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var precio = button.data('precio');
    var nombre = button.data('nombre');
    var medida = button.data('medida');
    var id = button.data('id');
    var unidad = button.data('cantidad');

    $('#unidades').prop("min",unidad);

    switch (medida){

        case "R":
            medida = "Ración";
            break;

        case "K":
            medida = "Kilo";
            break;

        case "U":
            medida = "Unidad";
            break;
    }

    var modal = $(this);
    modal.find('.modal-body .nProducto').html("Nombre : "+nombre);
    modal.find('.modal-body .pProducto').html("Precio: "+precio+"€ / "+medida);

    modal.find('.modal-body .precioProducto').val(precio);
    modal.find('.modal-body .idProducto').val(id);
});

$('#tramitarPedido').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('id');
    var correo = button.data('correo');
    var nombre = button.data('nombre');

    var modal = $(this);
    modal.find('.modal-body .pedidoNombre').html("<b>"+nombre+"</b>");

    if(button.data('aceptar')==true){

        modal.find('.modal-body #botonTramitar').html("Aceptar el pedido");
        modal.find('.modal-body #botonTramitar').attr("class","btn btn-primary");
        modal.find('.modal-body .formularioPedido').attr("onsubmit","return aceptarPedido("+id+",'"+correo+"','A')");

    }else{

        modal.find('.modal-body #botonTramitar').html("Rechazar el pedido");
        modal.find('.modal-body #botonTramitar').attr("class","btn btn-danger");
        modal.find('.modal-body .formularioPedido').attr("onsubmit","rechazarPedido("+id+","+correo+",R)");
    }


});
