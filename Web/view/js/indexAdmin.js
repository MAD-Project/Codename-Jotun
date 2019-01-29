//Tabla productos admin
$(document).ready(function () {
    $('#tablaProductosAdmin').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

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
$(function () {
    $('[data-toggle="popover"]').popover()
});

$('.popover-dismiss').popover({
    trigger: 'focus'
});
//FIN tabla productos admin