
$(document).ready(function () {

    estadisticasClientes();
    estadisticasProductos();
    $('#estaClientes').click(function () {

        estadisticasClientes();
    });
});

function estadisticasClientes() {

    $.ajax({
        type: 'GET',
        url: 'index.php?controller=Administradores&action=estadisticasClientes',
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
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
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

    new Chart(document.getElementById("horizontalBar"), {
        "type": "horizontalBar",
        "data": {
            "labels": ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey"],
            "datasets": [{
                "label": "Pedidos Realizados ",
                "data": [22, 33, 55, 12, 86, 23, 14],
                "fill": true,
                "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                    "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                ],
                "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                ],
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

}