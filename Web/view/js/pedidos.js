function aceptarPedido(idPedido, email,nuevoEstado) {

    //aqui el mailto
debugger;
    $.ajax({
        type: "POST",
        url: "index.php?controller=pedidos&action=tramitarPedido",
        data: { idPedido: idPedido,
                nuevoEstado: nuevoEstado},
    success: function (data) {
       if(data===1){
           alert("ouch");
           location.reload();
       }else{
           alert("hey");
           $("#tramitarPedido").modal("hide");
           $("<h3 style='color:red'>Ha ocurrido un error</h3>" ).insertBefore($( "#accordionPendientes" ));
           
           return false;
       }
    },
    error: function (data) {
        alert("Error"+data);
    }

    });

}