//Ejecuciones al cargar el documento
$(function () {
    goTop();
    $("#scroller").css("display", "none");
    $("#scroller2").css("display", "none").addClass("fixed-bottom flecha-position");
    $("#carritobtn").hide();
});


function goTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 1000);
}

//Dos funciones que ocultan y muestran el carrito y la flecha para ir a tope dependiendo del scrolling y de si se ha seleccionado un producto
$(window).scroll(function (e) {
    if ($(this).scrollTop() >= $("#nav").offset().top && localStorage.getItem("scrollDone") != 1) {
        $('html, body').animate({
            scrollTop: $("#productosDiv").offset().top
        }, 1000);
        localStorage.setItem("scrollDone", 1);
    }

    if ($(this).scrollTop() >= $(".scroller_anchor").offset().top) {
        $('#scroller2').fadeIn();
    } else if ($(this).scrollTop() < $(".scroller_anchor").offset().top) {
        $('#scroller2').fadeOut();
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