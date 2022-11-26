function loadCharts(suscripciones, compras, suscripcionesBarra){

    var jsonSuscripciones = suscripciones;

    var jsonCompras = compras;

    var jsonSuscripcionesBarra = suscripcionesBarra;

    google.charts.load('current', {'packages':['corechart']});

    google.setOnLoadCallback(function() { bar_chart(jsonCompras); });

    google.setOnLoadCallback(function() { pie_chart(jsonSuscripciones); });

    google.setOnLoadCallback(function() { bar_chart2(jsonSuscripcionesBarra); });
}

function pie_chart(jsonSuscripciones) {

    const objeto = JSON.parse(jsonSuscripciones);

    var data = new google.visualization.DataTable(objeto);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de suscripciones');

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].nombre, parseInt(objeto[i].sub_cant)]);
    }

    var options = {
        title: "Suscripciones",
        width: 1000,
        height: 400,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    chart.draw(data, options);

}

function bar_chart(jsonCompras) {

    const objeto = JSON.parse(jsonCompras);

    var data = new google.visualization.DataTable(objeto);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de compras');

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].fecha, parseInt(objeto[i].compras)]);
    }
    var options = {
        title: "Compras",
        width: 1000,
        height: 600,
        bar: {groupWidth: "80%"},
    };

    var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    chart.draw(data, options);

}

function bar_chart2(jsonSuscripcionesBarra) {

    const objeto = JSON.parse(jsonSuscripcionesBarra);

    var data = new google.visualization.DataTable(objeto);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de suscripciones');

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].fecha, parseInt(objeto[i].sub_cant)]);
    }
    var options = {
        title: "Suscripciones",
        width: 1000,
        height: 600,
        bar: {groupWidth: "80%"},

    };

    var chart = new google.visualization.BarChart(document.getElementById('barchart2_div'));
    chart.draw(data, options);

}