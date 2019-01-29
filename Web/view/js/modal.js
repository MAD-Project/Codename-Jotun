$('#modalProductos').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var precio = button.data('precio');
    var nombre = button.data('nombre');
    var medida = button.data('medida');
    var id = button.data('id');
    var unidad = button.data('cantidad');

    if (unidad === 0){
        unidad = 1;
    }

    $('#unidadesProducto').prop("min",unidad);

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
    modal.find('.modal-body .nombrePorducto').val(nombre);
});

$('#tramitarPedido').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('id');
    var correo = button.data('correo');
    var nombre = button.data('nombre');

    var modal = $(this);
    modal.find('.modal-body .pedidoNombre').html("<b>"+nombre+"</b>");

    var boton=modal.find('.modal-body #botonTramitar');
    var form=modal.find('.modal-body .formularioPedido');
    switch (button.data('estado')){
        case 'A':
            boton.html("Aceptar el pedido");
            boton.attr("class","btn btn-primary");
            form.attr("onsubmit","return tramitarPedido("+id+",'"+correo+"','A')");
            break;

        case 'R':
            boton.html("Rechazar el pedido");
            boton.attr("class","btn btn-danger");
            form.attr("onsubmit","return tramitarPedido("+id+",'"+correo+"','R')");
            break;

        case 'N':
            boton.html("Pedido preparado");
            boton.attr("class","btn btn-success");
            form.attr("onsubmit","return tramitarPedido("+id+",'"+correo+"','N')");
            break;

        case 'E':
            boton.html("Pedido entregado");
            boton.attr("class","btn btn-success");
            form.attr("onsubmit","return tramitarPedido("+id+",'"+correo+"','E')");
            break;

    }



});
