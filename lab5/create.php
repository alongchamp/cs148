<?php
include 'top.php';
include 'nav.php';
?>
<body>
    <h2>
        Create New Plan
    </h2>
    <p>
        Here is where you create a new four year plan.
    </p>
    <p>
        If you are not taking classes for any of the summer or winter semesters, don't check save and then press the submit button.
    </p>
    <p>
        Semesters 1, 5, 9, and 13 are Fall semesters.<br>
        Semesters 2, 6, 10, and 14 are Winter semesters.<br>
        Semesters 3, 7, 11 and 15 are Spring semesters.<br>
        Semesters 4, 8 and 12 are Summer Semesters.
    </p>

    <?php
    if (isset($_POST['btnSInfo'])) {
        include 'plan.php';
    } elseif (isset($_POST['btnSemester'])) {
        if ($_SESSION['count'] < 7) {
            $_SESSION['count'] = $_SESSION['count'] + 1;
            include 'plan.php';
        } else {
            header("Location: https://alongcha.w3.uvm.edu/cs148_develop/labs/lab5/thanks.php");
            $_SESSION['count'] = 0;
            exit();
        }
    } else {
        include "SInfo.php";
    }

    echo $_SESSION['count'];
    ?>
</body>
</html>