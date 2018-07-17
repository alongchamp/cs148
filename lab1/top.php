<!DOCTYPE html>
<html>
    <head>
        <?php
        // set title, author, description, character style, and style sheet
        ?>
        <title>
            Class List from a CSV
        </title>
        <meta name="author" content="Aaron Longchamp">
        <meta name="description" content="Making an interactive class list.">
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" type="text/css" media="screen">
       
        <?php
        
        $phpSelf = htmlentities($_SERVER['PHP_SELF'],ENT_QUOTES, "UFT-8");
        $path_parts = pathinfo($phpSelf);
        
        ?>
        
    </head>
    
    <?php
    
    print '<body id="' . $path_parts['filename'] . '">';
    
    ?>

<!-- Body -->