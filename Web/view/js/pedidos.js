function tramitarPedido(idPedido, email,nuevoEstado) {

    //aqui el mailto

    $.ajax({
        type: "POST",
        url: "index.php?controller=Pedidos&action=tramitarPedido",
        data: { idPedido: idPedido,
                nuevoEstado: nuevoEstado,
                email: email},
    success: function (data) {

       if(data==1){

           location.reload();
       }else{

           $("#tramitarPedido").modal("hide");
           $("<p style='color:red'>Ha ocurrido un error, intentalo de nuevo en unos minutos</p>" ).insertBefore($( "#accordionPendientes" ));


       }
    },
    error: function (data) {
        alert("Error"+data);
    }

    });

    return false;
}

