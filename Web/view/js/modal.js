$('#modalProductos').on('show.bs.modal', function (event) {
    
    var button = $(event.relatedTarget);
    var precio = button.data('precio');
    var nombre = button.data('nombre');
    var medida = button.data('medida');
    var id = button.data('id');
    var unidad = button.data('cantidad');

    if (unidad === 0) {
        unidad = 1;
    }

    $('#unidadesProducto').prop("min", unidad);

    switch (medida) {

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
    modal.find('.modal-body .nProducto').html("<h5>" + nombre + "</h5>");
    modal.find('.modal-body .pProducto').html("Precio: " + precio + "€ / " + medida);

    modal.find('.modal-body .precioProducto').val(precio);
    modal.find('.modal-body .idProducto').val(id);
    modal.find('.modal-body .nombrePorducto').val(nombre);
    modal.find('.modal-body .minProducto').val(unidad);
    modal.find('#unidadesProducto').val(null);
    modal.find('#unidadesProducto').attr("placeholder", "Mínimo " + unidad + " unidades.")
});

$("#modalProductos").on('hidden.bs.modal', function(){

    $('#errorMsg').html("");
});

$("#modalPedido").on('hidden.bs.modal', function () {

    $('#errorFecha').html("");
});

$('#tramitarPedido').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('id');
    var correo = button.data('correo');
    var nombre = button.data('nombre');
    var nombre = button.data('fechaentrega');

    var modal = $(this);
    modal.find('.modal-body .pedidoNombre').html("<b>" + nombre + "</b>");
    modal.find('.modal-body .formularioPedido').attr("onsubmit", "aceptarPedido(" + id + ",'" + correo + "')");

    var boton=modal.find('.modal-body #botonTramitar');
    var form=modal.find('.modal-body .formularioPedido');
    switch (button.data('estado')){
        case 'A':
            boton.html("Aceptar el pedido");
            boton.attr("class","btn btn-primary");
            form.attr("onsubmit","return tramitarPedido("+nombre+","+id+",'"+correo+"','A',null)");
            break;

        case 'R':
            boton.html("Rechazar el pedido");
            boton.attr("class","btn btn-danger");
            form.attr("onsubmit","return tramitarPedido("+nombre+","+id+",'"+correo+"','R',null)");
            break;

        case 'N':
            boton.html("Pedido preparado");
            boton.attr("class","btn btn-success");
            form.attr("onsubmit","return tramitarPedido("+nombre+","+id+",'"+correo+"','N','"+fechaentrega+"')");
            break;

        case 'E':
            boton.html("Pedido entregado");
            boton.attr("class","btn btn-success");
            form.attr("onsubmit","return tramitarPedido("+nombre+","+id+",'"+correo+"','E',null)");
            break;

    }



});
