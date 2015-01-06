#!/usr/bin/php

<?php


    /*
    |--------------------------------------------------------------------------
    | Config
    |--------------------------------------------------------------------------
    */

    date_default_timezone_set("UTC");



    /*
    |--------------------------------------------------------------------------
    | Variables
    |--------------------------------------------------------------------------
    */

    $url              = 'https://launchpad.net/elementary/+milestone/freya-rc1'; // URL of the Launchpad page you want
    $data_file        = 'data.csv';                                              // name of your data file
    $temp_file        = 'temp.del';                                              // name of temp file
    $bugs_line        =  300;                                                    // max line of url page source code where bugs
    $current_date     =  date('d/m/y');                                          // the date (UTC)



    /*
    |--------------------------------------------------------------------------
    | Get bugs count
    |--------------------------------------------------------------------------
    */

    // Check if the script was runned once - best for memory cunsomption

    if(exec('grep '.escapeshellarg($current_date).' ./data.csv')) exit();


    // Get Lauchpad page

    $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n'))); // Fix performance issue
    $reponse = file_get_contents($url, false, $context);
    $reponse = implode("\n", array_slice(explode("\n", $reponse), $bugs_line));                  // Shortern String for better performance

    $array = explode("\n", $reponse);

    foreach($array as $i=>$line) {

        if(strpos($line,'class="statusNEW"') !== false && !isset($b_new))
        {

            $b_new = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusINCOMPLETE"') !== false && !isset($b_incomp))
        {

            $b_incomp = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusCONFIRMED"') !== false && !isset($b_conf))
        {

            $b_conf = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusTRIAGED"') !== false && !isset($b_triaged))
        {

            $b_triaged = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusINPROGRESS"') !== false && !isset($b_inprog))
        {

            $b_inprog = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusFIXCOMMITTED"') !== false && !isset($b_fix_committed))
        {

            $b_fix_committed = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
        else if(strpos($line,'class="statusFIXRELEASED"') !== false && !isset($b_fix_released))
        {

            $b_fix_released = str_replace([' ', '<strong>', '</strong>'], '', $array[$i + 1]);
        }
    }

    $b_new           = isset($b_new)           ? $b_new           : 0;
    $b_incomp        = isset($b_incomp)        ? $b_incomp        : 0;
    $b_conf          = isset($b_conf)          ? $b_conf          : 0;
    $b_inprog        = isset($b_inprog)        ? $b_inprog        : 0;
    $b_triaged       = isset($b_triaged)       ? $b_triaged       : 0;
    $b_fix_committed = isset($b_fix_committed) ? $b_fix_committed : 0;
    $b_fix_released  = isset($b_fix_released)  ? $b_fix_released  : 0;



    /*
    |--------------------------------------------------------------------------
    | Saving new data
    |--------------------------------------------------------------------------
    */


    // Generate input

    $input = $current_date.', '.$b_new.', '.$b_incomp.', '.$b_conf.', '.$b_triaged .', '.$b_inprog.', '.$b_fix_committed.', '.$b_fix_released;


    // Write in data.csv

    $file = fopen($data_file, 'a');
    fwrite($file, $input."\n");
    fclose($file);


    // We're done
