function tramitarPedido(nombre, idPedido, email, nuevoEstado, fechaentrega) {

    $.ajax({
        type: "POST",
        url: "index.php?controller=Pedidos&action=tramitarPedido",
        data: {
            nombre: nombre,
            idPedido: idPedido,
            nuevoEstado: nuevoEstado,
            email: email,
            fechaentrega: fechaentrega
        },
        success: function (data) {

            if (data == 1) {

                location.reload();
            } else {

                $("#tramitarPedido").modal("hide");
                $("<p style='color:red'>Ha ocurrido un error, intentalo de nuevo en unos minutos</p>").insertBefore($("#accordionPendientes"));


            }
        },
        error: function (data) {
            alert("Error" + data);
        }

    });

    return false;
}