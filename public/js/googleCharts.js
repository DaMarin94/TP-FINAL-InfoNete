function loadCharts(suscripciones){

    var jsonSuscripciones = suscripciones;

    google.charts.load('current', {'packages':['corechart']});

    google.setOnLoadCallback(function() { bar_chart(jsonSuscripciones); });

    google.setOnLoadCallback(function() { pie_chart(jsonSuscripciones); });
}

function pie_chart(jsonSuscripciones) {

    const objeto = JSON.parse(jsonSuscripciones);

    var data = new google.visualization.DataTable(objeto);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de suscripciones');

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].nombre, parseInt(objeto[i].sub_cant)]);
    }

    var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    chart.draw(data);

}

function bar_chart(jsonSuscripciones) {

    const objeto = JSON.parse(jsonSuscripciones);

    var data = new google.visualization.DataTable(objeto);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de suscripciones');

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].nombre, parseInt(objeto[i].sub_cant)]);
    }

    var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    chart.draw(data);

}