<!-- Navigation -->
<nav>
    <ul>
        <?php
        // test to see if on index page
        if ($path_parts['filename'] == 'index') {
            print '<li><a class="activePage">Index</a></li>';
        }
        else {
            print '<li><a href="index.php">Index</a></li>';
        }
        
        // test to see if on create page
        if ($path_parts['filename'] == 'create') {
            print '<li><a class="activePage">Create</a></li>';
        }
        else {
            print '<li><a href="create.php">Create</a></li>';
        }
        
        // test to see if on search page
        if ($path_parts['filename'] == 'search') {
            print '<li><a class="activePage">Search</a></li>';
        }
        else {
            print '<li><a href="search.php">Search</a></li>';
        }
        ?>
    </ul>
</nav>