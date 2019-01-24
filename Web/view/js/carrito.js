
function carrito() {
    $('#scroller').fadeIn("slow");
    $('#scroller').addClass("fixed-top carrito-position");

    alert($('.nombreProducto').val());
    $('#modalProductos').modal('hide');
    return false;
}