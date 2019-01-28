
function carrito() {

    $('#scroller').fadeIn("slow");
    $('#scroller').addClass("fixed-top carrito-position");

    var unidades = $('#unidadesProducto').val();
    var numeroProductosCarrito = $('#numeroProductosCarrito').text();

    var totalProductos = parseInt(unidades)+parseInt(numeroProductosCarrito);

    $('#modalProductos').modal('hide');

    $('#numeroProductosCarrito').html(totalProductos);

    var productos = [];

    return false;
}