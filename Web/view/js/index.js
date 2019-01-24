//Ejecuciones al cargar el documento
$(function () {
    $("#scroller").css("display", "none");
});

// Al pasar un ancla por la altura de noticias, activa el icono del carrito cuando se agregue un producto a la cesta
$(window).scroll(function (e) {
    var scroller_anchor = $(".scroller_anchor").offset().top;

    if ($(this).scrollTop() >= scroller_anchor && $('#scroller').css('position') != 'fixed' && localStorage.getItem("carritoActivado") != null) {
        function mostrarCarrito() {
            $('#scroller').fadeIn("slow");
            $('#scroller').addClass("fixed-top carrito-position");
        }
    }
});

$(window).scroll(function (e) {
    var scroller_anchor = $("#nav").offset().top;

    if ($(this).scrollTop() >= scroller_anchor && localStorage.getItem("scrollDone") != 1) {
        $('html, body').animate({
            scrollTop: $("#productosDiv").offset().top
        }, 1000);
        localStorage.setItem("scrollDone", 1);
    }
});


/* ANIMACIONES VISUALES */

// Desplaza la pagina hasta el div del carrito
function irCarrito() {
    $('html, body').animate({
        scrollTop: $("#carrito").offset().top
    }, 1000);
}

//Rota la flecha cuando se despliegan o contraen las categorias
function rotateArrow(id) {
    if ($('#' + id).hasClass("rotate")) {
        $('#' + id).removeClass("rotate");
        $('#' + id).addClass("rotate-origin");
        setTimeout(function () {
            $('#' + id).removeClass("rotate-origin");
        }, 500);
    } else {
        $('#' + id).addClass("rotate");
    }
}
/* END ANIMACIONES VISUALES */