function carrito() {



    return false;
}

//Añade productos al carrito del fondo de la pagina, muestra el simbolo del carrito
function annadirCarrito(form) {
    $('#scroller').fadeIn("slow");
    $('#scroller').addClass("fixed-top carrito-position");
    $("#noProductos").remove();
    totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) + Number.parseInt(form.elements[3].value, 10);
    $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
    $("#carritoLista").append("<li class='p-4 list-group-item item-separation'>" + form.elements[2].value + "<span><img class='mr-2' src='img/minus.svg' height='25' onclick='cambiarUnidades(" + form.elements[0].value + ",0,1)'><img class='mr-3 mt-0' src='img/plus.svg' height='25' onclick='cambiarUnidades(" + form.elements[0].value + ",1,1)'><span id='cambiar" + form.elements[0].value + "'>" + form.elements[3].value + "</span> Unidades</span></li>");
    $('#modalProductos').modal("hide");

    return false;
}

function cambiarUnidades(id, what, howmuch) {
    var cambio = "#cambiar" + id;

    if (what == 0) {
        $(cambio).text(Number.parseInt($(cambio).text() - howmuch));
        totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) - howmuch;
        $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
    } else {
        $(cambio).text(Number.parseInt($(cambio).text()) + Number.parseInt(howmuch));
        totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) + howmuch;
        $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
    }
}