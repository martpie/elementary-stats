<?php

    define('ENABLE_ELEMENTARY_STATS', true);

    // update sript must have correct permissions: chmod +x update.py
    if(ENABLE_ELEMENTARY_STATS){
        $command = escapeshellcmd('python update.py 2>&1');
        $output  = exec($command);
    }

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>elementary stats</title>

        <link rel="profile" href="http://gmpg.org/xfn/11">

        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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

        <!-- JS libraries -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://www.google.com/jsapi"></script>
        <script src="https://jquery-csv.googlecode.com/files/jquery.csv-0.71.js"></script>

        <!-- JS stuff -->
        <script src="js/chart.js"></script>

    </body>
</html>
