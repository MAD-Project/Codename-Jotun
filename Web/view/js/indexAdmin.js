//Tabla productos admin
$(document).ready(function () {
    $('#tablaProductosAdmin').DataTable();
    $('.dataTables_length').addClass('bs-select');
    $('#tablaProductosAdmin_wrapper').addClass('w-100');
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

//Habilitar / deshabilitar la tramatitación de pedidos

function habilitarPedidos(nombreAdmin) {

    $.ajax({
        type: "POST",
        url: "index.php?controller=Administradores&action=habilitarPedidos",
        data: {
            nombreAdmin: nombreAdmin,
            habilitar: $('#pedidosActivo').prop('checked')
        },

        error: function (data) {
            alert("Error" + data);
        }

    });
}