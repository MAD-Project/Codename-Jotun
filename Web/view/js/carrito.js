var productosCarrito = [];
//Añade productos al carrito del fondo de la pagina, muestra el simbolo del carrito
function annadirCarrito(form) {
    if (form.elements[4].value != "") {
        $('#scroller').fadeIn("slow");
        $('#scroller').addClass("fixed-top carrito-position hoverItem");
        $("#noProductos").remove();
        $("#carritoLista").removeClass("card");

        if ($("#cambiar" + form.elements[0].value).length) {
            cambiarUnidades(form.elements[0].value, 1, form.elements[4].value, form.elements[3].value);
            $('#modalProductos').modal("hide");
        } else {
            totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) + Number.parseInt(form.elements[4].value, 10);
            $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
            $("#carritoLista").append("<li id='eliminar" + form.elements[0].value + "' class='p-4 list-group-item item-separation'>" + form.elements[2].value + "<span><img id='hoverItem' class='mr-2' src='img/minus.svg' height='25' onclick='cambiarUnidades(" + form.elements[0].value + ",0,1," + form.elements[3].value + ")'><img id='hoverItem' class='mr-3 mt-0' src='img/plus.svg' height='25' onclick='cambiarUnidades(" + form.elements[0].value + ",1,1," + form.elements[3].value + ")'><span id='cambiar" + form.elements[0].value + "'>" + form.elements[4].value + "</span> Unidades</span></li>");
            $('#modalProductos').modal("hide");
            $("#carritobtn").show();
            actualizarCookie();
        }

        $('#modalProductos').modal('hide');
    } else {
        $("#errorMsg").text("Ponga un número de productos válido.");
    }

    return false;

}

//Suma o resta unidades totales en el carrito y la chapa del icono del carrito, en caso de no superar el minimo o no haber productos, esconde los objetos creados al añadir un producto
function cambiarUnidades(id, what, howmuch, min) {
        var cambio = "#cambiar" + id;

        if (what == 0) {
            let numProd = Number.parseInt($(cambio).text() - howmuch);

            if (numProd >= min) {
                $(cambio).text(numProd);
                let totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) - howmuch;
                $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
            } else {
                let totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) - (numProd + howmuch);
                $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
                $("#eliminar" + id).remove();

                if ($("#numeroProductosCarrito").text() <= 0) {
                    $("#carritoLista").append("<li id='noProductos' class='p-4 list-group-item item-deparation' style='border: none!important;'>No tienes ningun producto</li>");
                    $("#carritoLista").addClass("card");
                    $("#carritobtn").hide();
                    $('#scroller').fadeOut("slow");
                }
            }
        } else {
            $(cambio).text(Number.parseInt($(cambio).text()) + Number.parseInt(howmuch));
            let totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) + Number.parseInt(howmuch);
            $("#numeroProductosCarrito").replaceWith("<span id='numeroProductosCarrito' class='badge badge-dark badge-pill badge-position'>" + totalProductos + "</span>");
        }
    actualizarCookie();
}

//Recoge el id y la cantidad de los elemen  tos de la lista de carrito y los envia al controlador de PHP para hacer el pedido
function tramitarPedido() {
    var arrayPedido = [];

    var c1 = new Cliente($('#nombreCliente').val(),$('#correoCliente').val(),$('#telefonoCliente').val(),$('#cometarioCliente').val());

    arrayPedido.push(c1);+


        $("#carritoLista").children().each(function () {
            let Producto = new ProductosCarrito($(this).children().find("span").attr("id").slice(7), $(this).children().find("span").text());
            arrayPedido.push(Producto);
        });

    var pedidosJSON = "pedidos="+JSON.stringify(arrayPedido);

    $.ajax({
        data: pedidosJSON,
        url: 'index.php?controller=pedidos&action=realizarPedido',
        type: 'post',
        success: function (data) {
            debugger;
            alert("Bien. Data: " + data);
        },
        error: function (data) {
            alert("Error. Data: " + data);
        }
    });

    return false;
}

function actualizarCookie(){
    productosCarrito = [];
    $("#carritoLista").children().each(function () {
        debugger;
        let Producto = new ProductosCarrito($(this).children().find("span").attr("id").slice(7), $(this).children().find("span").text());
        productosCarrito.push(Producto);
    });
    document.cookie="productosCarrito="+JSON.stringify(productosCarrito)+";expires="+ new Date(new Date().getTime()+60*60*1000*24).toGMTString()+";";
}

function leerCookieCarrito() {
    var nombre = "productosCarrito=";
    var cookies = decodeURIComponent(document.cookie).split(';');
    debugger;
    for(var i = 0; i <cookies.length; i++) {
        let c = cookies[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(nombre) == 0) {

            let carrito=JSON.parse(c.substring(nombre.length, c.length));
            debugger;
            return  carrito;
        }
    }
    return [];
}