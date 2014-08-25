<?php 

    /* urgent things to do:
     * 
     *   1 - clean all this mess below
     *   2 - define constants for options
     *
     */

    // update sript must have correct permissions: chmod +x update.py
    $command = escapeshellcmd('python update.py 2>&1');
    $output  = exec($command);

   
    $data_csv = array_map('str_getcsv', file('data.csv'));

    // get max(amount_of_bugs) count & date
    $max_bugs = 0;
    $max_bugs_date = '';
    $slope_arr = array();

    $yesterday_bugs = 0;

    foreach($data_csv as $i=>$data){
        
        $total_bugs = $data[1] + $data[2] + $data[3] + $data[4] + $data[5];
        
        if($total_bugs > $max_bugs){
            $max_bugs = $total_bugs;
            $max_bugs_date = $data[0]; // date
        }
        
        if($i >= 1 && is_int($total_bugs)){ // don't look for [-1]
            array_push($slope_arr, $total_bugs - $yesterday_bugs);
            $yesterday_bugs = $total_bugs;
        }
    }

    array_shift($slope_arr);                            // shifting first value
    $slope = array_sum($slope_arr) / count($slope_arr); // getting slope

?>

<!DOCTYPE html>

<html lang="en"> 
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <title>elementary stats</title>
        
        <link rel="profile" href="http://gmpg.org/xfn/11">
        
        <link rel="stylesheet" type="text/css" href="css/style_normalize.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style_main.css">
        
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->  
        
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>   
    </head>


   
    <body>
       
        <!-- Header -->
        <header class="container-fluid">
            <div class="row">
               <div class="col-sm-8 col-sm-offset-2"> 
                    <h1>
                        <img src="img/icons/elementary_logo.svg" alt="elementary_logo" id="elementary_logo">
                        elementary stats
                    </h1>                     
                </div>
            </div>
        </header>

       
        <!-- Main content -->
        <div id="wrap">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h3 class="text-left">freya-beta2</h3>
                        <div id="chart_div"></div>
                        <hr class="delimiter" />
                    </div>
                </div>
                <div class="row" id="description">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <a href="https://github.com/KeitIG/elementary-stats" target="_blank">sources</a>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Libraries -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="https://jquery-csv.googlecode.com/files/jquery.csv-0.71.js"></script>
        
        <script type="text/javascript">
            
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
            
            
            jQuery(window).resize(function () { // Resize charts in case of window resize
                drawChart();
            });
        </script>
    </body>
    
</html>
