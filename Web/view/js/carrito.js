function carrito() {

    $('#scroller').fadeIn("slow");
    $('#scroller').addClass("fixed-top carrito-position");

    return false;
}

function annadirCarrito(form) {
    $("#carritoLista").append("<li class='p-4 list-group-item item-separation' style='border: none !important;'>" + form.elements[2].value + "<span>" + form.elements[3].value + " Unidades</span></li>");

    $('#modalProductos').modal("hide");

    return false;
}