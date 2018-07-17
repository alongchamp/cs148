<?php
include ("constants.php");
include ("top.php");
include ("header.php");
include ("nav.php");
?>

<article id="main">
    <h1>
        Please use the drop down to select a class
    </h1>
    <form action="data.php" method="get">
        <select name="classes">
        <?php
            foreach ($records as $oneRecord)
            {
                $subject = $oneRecord[0];
                $number = $oneRecord[1];
                $section = $oneRecord[4];
                $lstClass = $subject . " " . $number . " " . $section;
                print '<option value="' . $lstClass . '">' . $lstClass . '</option>';
            }
        ?>
        </select>
        <input type="submit">
    </form>
    
</article>

<?php
include ("footer.php");
?>

</body>
</html>