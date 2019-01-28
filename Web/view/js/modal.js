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

$('#aceptarPedido').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget);
    var id = button.data('id');
    var correo = button.data('correo');
    var nombre = button.data('nombre');

    var modal = $(this);
    modal.find('.modal-body .pedidoNombre').html("<b>"+nombre+"</b>");
    modal.find('.modal-body .formularioPedido').attr("onsubmit","aceptarPedido("+id+",'"+correo+"')");

});