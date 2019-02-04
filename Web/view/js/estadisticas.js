
$(document).ready(function () {

    estadisticasClientes();
    estadisticasProductos();

    $('#estaClientes').click(function () {

        estadisticasClientes();
    });

    $('#estaProductos').click(function () {

        estadisticasProductos();
    });

});

function estadisticasClientes() {

    $.ajax({
        type: 'GET',
        url: 'index.php?controller=administradores&action=estadisticasClientes',
        dataType:"json",
        success: function (data) {

            var clientesNuevos = data[0][0];
            var clientesQueRepiten = data[1][0];
            var clientesHabituales = data[2][0];

            var ctxP = document.getElementById("pieChart").getContext('2d');
            var myPieChart = new Chart(ctxP, {
                type: 'pie',
                data: {
                    labels: ["Número de clientes nuevos", "Número de clientes que repiten", "Número de clientes habituales"],
                    datasets: [{
                        data: [clientesNuevos, clientesQueRepiten, clientesHabituales],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
                    }]
                },
                options: {
                    responsive: true
                }
            });

        },
        error: function (data) {
            alert(data);
        }
    });
}

function estadisticasProductos() {

    $.ajax({
        type: 'GET',
        url: 'index.php?controller=administradores&action=estadisticasProductos',
        dataType:"json",
        success: function (data) {

            var nombres = [];
            var numPedidos = [];
            var colores = [];

            for (i=0;i<data.length;i++){
                nombres.push(data[i][0]);
                numPedidos.push(data[i][1]);
                colores.push(colorAleatorio());
            }

            new Chart(document.getElementById("horizontalBar"), {
                "type": "horizontalBar",
                "data": {
                    "labels": nombres,
                    "datasets": [{
                        "label": "Pedidos Realizados ",
                        "data": numPedidos,
                        "fill": true,
                        "backgroundColor": colores,
                        "borderWidth": 1
                    }]
                },
                "options": {
                    "scales": {
                        "xAxes": [{
                            "ticks": {
                                "beginAtZero": true
                            }
                        }]
                    }
                }
            });

        },
        error: function (data) {
            alert(data);
        }
    });

}

function colorAleatorio() {

    function aleatorio(inferior,superior){
        numPosibilidades = superior - inferior;
        aleat = Math.random() * numPosibilidades;
        aleat = Math.floor(aleat);
        return parseInt(inferior) + aleat;
    }

    function colorA(){
        hexadecimal = ["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F"];
        color_aleatorio = "#";
        for (x=0;x<6;x++){
            posarray = aleatorio(0,hexadecimal.length);
            color_aleatorio += hexadecimal[posarray];
        }
        return color_aleatorio;
    }

    return colorA();
}
