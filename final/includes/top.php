<?php
session_start();
include "lib/constants.php";
include "lib/validation-functions.php";
$debug = false;
if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Online Couponing</title>
        <meta charset="utf-8">
        <meta name="author" content="Connor Allan">
        <meta name="description" content="Database for the UVM Registrar">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->
        <!-- CSS for the dropdown menu on mobile devices -->
        <style type="text/css">
            li a, .dropbtn {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover, .dropdown:hover .dropbtn {
                background-color: red;
            }

            li.dropdown {
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {background-color: #f1f1f1}

            .show {display:block;}

        </style>
        <link rel="stylesheet" href="css/custom.css" type="text/css" media="screen">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. 
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //$user = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
        print "<!-- require Database.php -->";

        require_once(BIN_PATH . '/Database.php');

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //
        // generally you dont need the admin on the web

        print "<!-- make Database connections -->";
        $dbUserName = 'crallan_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = 'crallan_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);
        ?>	

    </head>

    <!-- **********************     Body section      ********************** -->
    <?php
    $email = htmlentities($_SESSION['email'], ENT_QUOTES, "UTF-8");
    $pass = htmlentities($_SESSION['password'], ENT_QUOTES, "UTF-8");
    $query = 'SELECT fldpassword FROM tblUsers WHERE pmkEmail= ?'; //Takes user's input for email to find matching password
    $data = array($email);
    $results = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, FALSE, FALSE);
    $Qpass = $results[0]['fldpassword'];
    if ($Qpass !== $pass) {
        header('Location: https://alongcha.w3.uvm.edu/cs148_develop/final/login.php');
    }
    if ($debug) {
        echo '<pre>';
        print_r($_SESSION);
        echo 'results';
        print_r($results);
        echo '</pre>';
    }
    print '<body id="' . $PATH_PARTS['filename'] . '">';
//include "header.php";
//include "nav.php";
    ?>