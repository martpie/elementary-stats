#!/usr/bin/php

<?php
error_reporting(-1);
ini_set('display_errors', 'On');
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
    $data_backup_file = 'data_backup.csv';                                       // name of your backup data file
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
    $reponse = trim(preg_replace('/\s+/', ' ', $reponse));                                       // remove \n


    // Initialize bug count - need refactoring

    /*$b_new         = substr($reponse, strpos($reponse, '<span class="statusNEW">') + strlen('<span class="statusNEW">') + 9, 1);
    $b_incomp        = substr($reponse, strpos($reponse, '<span class="statusINCOMPLETE">') + strlen('<span class="statusINCOMLETE">') + 10, 1);
    $b_conf          = substr($reponse, strpos($reponse, '<span class="statusCONFIRMED">') + strlen('<span class="statusCONFIRMED">') + 9, 1);
    $b_inprog        = substr($reponse, strpos($reponse, '<span class="statusTRIAGED">') + strlen('<span class="statusTRIAGED">') + 9, 1);
    $b_triaged       = substr($reponse, strpos($reponse, '<span class="statusINPROGRESS">') + strlen('<span class="statusINPROGRESS">') + 9, 1);
    $b_fix_committed = substr($reponse, strpos($reponse, '<span class="statusFIXCOMITTED">') + strlen('<span class="statusFIXCOMITTED">') + 9, 1);
    $b_fix_released  = substr($reponse, strpos($reponse, '<span class="statusFIXRELEASED">') + strlen('<span class="statusFIXRELEASED">') + 9, 1);

    echo($b_new.'<br />');
    echo($b_incomp.'<br />');
    echo($b_conf.'<br />');
    echo($b_inprog.'<br />');
    echo($b_triaged.'<br />');
    echo($b_fix_committed.'<br />');
    echo($b_fix_released.'<br />');*/

    $b_new           = 1;
    $b_incomp        = 2;
    $b_conf          = 3;
    $b_inprog        = 4;
    $b_triaged       = 5;
    $b_fix_committed = 6;
    $b_fix_released  = 7;


    /*
    |--------------------------------------------------------------------------
    | Saving new data
    |--------------------------------------------------------------------------
    */


    copy($data_file, $data_backup_file);

    // Generate input

    $input = "\n".$current_date.', '.$b_new.', '.$b_incomp.', '.$b_conf.', '.$b_triaged .', '.$b_inprog.', '.$b_fix_committed.', '.$b_fix_released;

    // Write in data.csv
    $current_data  = file_get_contents($data_file);
    $current_date .= $input;
    file_put_contents ($data_file, $current_data);
