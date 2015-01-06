
google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);

function drawChart() {

    $.get('data.csv', function(csvString) {

        var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

        var data = new google.visualization.arrayToDataTable(arrayData);

        // this view can select a subset of the data at a time
        var view = new google.visualization.DataView(data);
        view.setColumns([0,1]);

        var options = {
            legend: { position: 'top', maxLines: 3 },
            bar: { groupWidth: '90%' },
            height: 550,
            isStacked: true,
            colors: ['#993300', '#b50000', '#FF0000', '#FF6600', '#a2d93c', '#0099C6', '#3366CC'],
            chartArea: {
                'width': '80%',
                'height': '75%' },
                hAxis: {
                    showTextEvery: 'automatic' }
                };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div')); // ColumnChart / PieChart / BarChart ect...
        chart.draw(data, options);
    });
}


// Redraw chart on window resize

jQuery(window).resize(function () { // Resize charts in case of window resize

    drawChart();
});
