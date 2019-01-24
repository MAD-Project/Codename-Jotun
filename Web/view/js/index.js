//Ejecuciones al cargar el documento
$(function () {
    $("#scroller").css("display", "none");
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