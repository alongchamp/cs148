<?php

// Read from a csv and put it into an array

$debug = false;

if (isset($_GET["debug"]))
{
    $debug = true;
}

$myFileName = "curr_enroll_fall";

$fileExt = ".csv";

$filename = $myFileName . $fileExt;

if ($debug)
{
    print "<p>Filename is " . $filename;
}

$file = fopen($filename,"r");

if ($file)
{
    if ($debug)
    {
        print "<p>File Opened</p>";
    }
}

if ($file)
{
    if ($debug)
    {
        print "<p>Begin reading data into an array.</p>";
    }
    
    $headers[] = fgetcsv($file);
    
    if ($debug)
    {
        print "<p>Finished reading data.</p>";
        print "<p>My header array<p><pre>";
        print_r($headers);
        print "</pre></p>";
    }
    
    while (!feof($file))
    {
        $records[] = fgetcsv($file);
    }
    
    fclose($file);
    
    if ($debug)
    {
        print "<p>Finished reading data. File closed.</p>";
        print "<p>My Data Array<p><pre>";
        print_r($records);
        print "</pre></p>";
    }
}

// Initiate Variables

$debug = false;

if (isset($_GET["debug"]))
{
    $debug = true;
}

if ($debug)
{
    print "<p>DEBUG MODE: ON</p>";
}

// Form Variables

$lstclass = ""
?>