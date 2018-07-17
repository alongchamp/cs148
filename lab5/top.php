<?php
session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}
include "lib/constants.php";
$user = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Lab 5</title>
        <meta charset="utf-8">
        <meta name="author" content="Aaron Longchamp">
        <meta name="description" content="Database Site For Our Stuff">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="style.css" media="screen">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. 
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

        print "<!-- require Database.php -->";

        require_once(BIN_PATH . '/Database.php');

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //
        // generally you dont need the admin on the web

        print "<!-- make Database connections -->";
        $dbUserName = get_current_user() . '_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);

        ?>	

    </head>

    <!-- **********************     Body section      ********************** -->
    <?php
    print '<h1>Four Year Plan Site</h1>';
    print '<body id="' . $PATH_PARTS['filename'] . '">';

    ?>