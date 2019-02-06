function tramitarPedido(nombre, idPedido, email, nuevoEstado, fechaentrega) {

    $.ajax({
        type: "post",
        url: "index.php?controller=Pedidos&action=tramitarPedido",
        data: {
            nombre: nombre,
            idPedido: idPedido,
            nuevoEstado: nuevoEstado,
            email: email,
            fechaEntrega: fechaentrega
        },
        success: function (data) {
            if (data == "enviado" || data == "entregado") {
                location.reload();
            } else {
                $("#tramitarPedido").modal("hide");
                $("<p style='color:red'>Ha ocurrido un error, intentalo de nuevo en unos minutos</p>").insertBefore($("#accordionPendientes"));
            }
        },
        error: function (data) {
            alert("Error envio email");
        }

    });

    return false;
}