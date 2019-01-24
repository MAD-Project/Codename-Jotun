// This function will be executed when the user scrolls the page.
$(window).scroll(function (e) {
    // Get the position of the location where the scroller starts.
    var scroller_anchor = $(".scroller_anchor").offset().top;

    // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top      && localStorage.getItem("carritoActivado") != null 
    if ($(this).scrollTop() >= scroller_anchor && $('#scroller').css('position') != 'fixed' ) { //&& localStorage.getItem("carritoActivado") != null
        $('#scroller').removeClass("d-none");
        $('#scroller').addClass("fixed-top carrito-position");
    }
});

$(window).scroll(function (e) {
    // Get the position of the location where the scroller starts.
    var scroller_anchor = $("#nav").offset().top;

    // Check if the user has scrolled and the current position is after the scroller start location and if its not already fixed at the top      && localStorage.getItem("carritoActivado") != null 
    if ($(this).scrollTop() >= scroller_anchor && localStorage.getItem("scrollDone") != 1) { // Change the CSS of the scroller to hilight it and fix it at the top of the screen.
        $('html, body').animate({
            scrollTop: $("#productosDiv").offset().top
        }, 1000);
        localStorage.setItem("scrollDone", 1);
    }
});

function irCarrito() {
    $('html, body').animate({
        scrollTop: $("#carrito").offset().top
    }, 1000);
}

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