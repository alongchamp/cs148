<!-- Navigation Bar -->
<nav>
    <ol>
        <?php
        // tests to see if on main page
        if ($path_parts['filename'] == "index")
        {
            print '<li class="activePage">Home</li>';
        }
        else 
        {
            print '<li><a href="index.php">Home</a></li>';
        }
        ?>
    </ol>
</nav>
