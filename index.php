<?php 

    // update sript must have chmod +x myscript.py
    $command = escapeshellcmd('python core/update.py');
    $output = shell_exec($command);
    echo $output;

?>

<!DOCTYPE html>

<html lang="en"> 
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <title>elementary stats</title>
        
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="img/icons/favicon.png" />
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->  
        
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>   
    </head>


   
    <body>
       
        <!-- Header -->
        <header class="container-fluid">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="row">
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
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <h3 class="text-left">freya-beta2</h3>
                        <div id="chart_div"></div>
                        <hr class="delimiter" />
                    </div>
                </div>
                <div class="row" id="description">
                    <div class="col-md-8 col-md-offset-2">
                        <a href="https://github.com/KeitIG/elementary-stats" target="_blank">sources</a>
                    </div>
                </div>
            </div>

        </div>
    
        
        <!-- Libraries -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        
        <script type="text/javascript">

            // Load the Visualization API and the piechart package.
            google.load('visualization', '1.0', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                
                var days = <?php echo count($data); ?>;

                // Create the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'New', 'Incomplete', 'Confirmed', 'Triaged','In Progress', 'Fix Commited', 'Fix Released'],    
                ]);           
                
                var options = {
                    legend: { position: 'top', maxLines: 3 },
                    bar: { groupWidth: '90%' },
                    height: 400,
                    isStacked: true,
                    colors: ['#993300', '#b50000', '#FF0000', '#FF6600', '#a2d93c', '#0099C6', '#3366CC'],
                    chartArea: {
                        'width': '80%',
                        'height': '350px' }
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div')); // ColumnChart / PieChart / BarChart ect...
                chart.draw(data, options);
            }


            jQuery(window).resize(function () {
                drawChart();
            });
        </script>
    </body>
    
</html>