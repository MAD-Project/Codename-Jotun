
function carrito() {

    localStorage.setItem("carritoActivado", 1);

    alert($('.nombreProducto').val());
    $('#modalProductos').modal('hide');
    return false;
}