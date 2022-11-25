function loadCharts(){
    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(pie_chart);

    google.charts.setOnLoadCallback(bar_chart);
}

function pie_chart() {

        var jsonData = $.ajax({
            url:"/admin/graficoTorta",
            dataType: "json",
            async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        data.addColumn('string', 'Producto');
        data.addColumn('number', 'Cantidad de suscripciones');

        const objeto = JSON.parse(jsonData);

        for (var i = 0; i < objeto.length; i++) {
            data.addRow([objeto[i].nombre, parseInt(objeto[i].sub_cant)]);
        }

        var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        chart.draw(data, {width: 400, height: 240});


    /*$.ajax({
        type:'GET',
        url:"/admin/graficoTorta",
        success: function (jsonData) {
            var data = new google.visualization.DataTable(jsonData);
            // assumes "word" is a string and "count" is a number
            data.addColumn('string', 'nombre');
            data.addColumn('number', 'sub_cant');


            for (var i = 0; i < jsonData.length; i++) {
                data.addRow([jsonData[i].nombre, jsonData[i].sub_cant]);
            }

            var options = {
                title: 'Productos'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
            chart.draw(data, options);
        }

    });*/
}

function bar_chart() {

    var jsonData = $.ajax({
        url:"/admin/graficoTorta",
        dataType: "json",
        async: false
    }).responseText;

    var data = new google.visualization.DataTable(jsonData);

    data.addColumn('string', 'Producto');
    data.addColumn('number', 'Cantidad de suscripciones');

    const objeto = JSON.parse(jsonData);

    for (var i = 0; i < objeto.length; i++) {
        data.addRow([objeto[i].nombre, parseInt(objeto[i].sub_cant)]);
    }

    var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
    chart.draw(data, {width: 400, height: 240});

}