$(document).ready(function () {

    $('#actualizarPagina').click(function () {
        setTimeout (function () {
            location.reload();
        },500);
    });
});


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
            let totalProductos = Number.parseInt($('#numeroProductosCarrito').text(), 10) + Number.parseInt(form.elements[4].value, 10);
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
    var fechaActual = new Date();
    var fecha = new Date($('#fechaEntregaCliente').val());
    fecha.setDate(fecha.getDate() - 4);

    if (fecha.getTime()<=fechaActual.getTime()){
        alert("Los pedidos se realizarán con un mínimo de 4 días lectivos de antelación");
        return false;
    }
    else {

        var c1 = new Cliente($('#nombreCliente').val(),$('#correoCliente').val(),$('#telefonoCliente').val(),$('#cometarioCliente').val(),fechaActual,$('#fechaEntregaCliente').val(),'P');

        arrayPedido.push(c1);

        $("span[id^='cambiar']").each(function () {
            let producto = new ProductosCarrito($(this).attr("id").slice(7).trim(), $(this).text().trim());
            arrayPedido.push(producto);
        });

        var pedidosJSON = "pedidos="+JSON.stringify(arrayPedido);

        $.ajax({
            data: pedidosJSON,
            url: 'index.php?controller=pedidos&action=realizarPedido',
            type: 'post',
            success: function (data) {

                if (data === "bien"){

                    $("#modalPedido").modal('hide');
                    $('#pedidoRealizado').html("Pedido realizado con éxito.");
                    document.cookie = "productosCarrito=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                    $("#centralModalSuccess").modal('show');
                }
                else {

                    alert("Error al realizar el pedido vuevla a intentarlo.");
                }
            },
            error: function (data) {
                alert(data);
            }
        });

        return false;
    }
}

function actualizarCookie(){
    let productosCarrito = [];
    $("span[id^='cambiar']").each(function () {
        let Producto = new ProductosCarrito($(this).attr("id").slice(7), $(this).text());
        productosCarrito.push(Producto);
    });
    document.cookie="productosCarrito="+JSON.stringify(productosCarrito)+";expires="+ new Date(new Date().getTime()+60*60*1000*24).toGMTString()+";";
}

//funcion para mostrar el icono del carrito cuando este se llena mediante las cookies
$(function() {
    if($("#noProductos").length==0){
        $('#scroller').fadeIn("slow");
        $('#scroller').addClass("fixed-top carrito-position hoverItem");
        $("#noProductos").remove();
        $("#carritoLista").removeClass("card");
        $("#numeroProductosCarrito").text($("#unidadesCarrito").val());
        $("#carritobtn").show();
    }
});

