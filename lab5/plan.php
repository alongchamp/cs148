<?php
if (isset($_POST['btnSemester'])) {
    //query that inserts data of semesterTerm, semesterYear, and planID into database
    $Term = htmlentities($_POST['Term'], ENT_QUOTES, "UTF-8");
    $TermYear = htmlentities($_POST['TermYear'], ENT_QUOTES, "UTF-8");
    $planId = $_SESSION['lastPlan'];
    $query_3 = "INSERT INTO tblSemesters SET pmkSemesterId= ?, pmkTermYear = ?, fnkPlanId = ?";
    $dataArray_3 = array($Term, $TermYear, $planId);
    $newClass = $thisDatabaseWriter->insert($query_3, $dataArray_3);
    
    for ($index = 1; $index <= 6; $index++) {
        $class = htmlentities($_POST['class' . $index], ENT_QUOTES, "UTF-8");
        $reqClass = htmlentities($_POST['reqClass' . $index], ENT_QUOTES, "UTF-8");

        $query_5 = "INSERT INTO tblSemesterClass SET fldRequired = ?, fnkClassId = ?, fnkTerm = ?, fnkTermYear = ? ";
        $dataArray_5 = array($reqClass, $class, $Term, $TermYear);
        $newSem = $thisDatabaseWriter->insert($query_5, $dataArray_5);
    }
}
?>

<form action="create.php" method="post">
    <h1>Semester <?php print $_SESSION['count'] ?></h1>
    <?php
    $f = 'Fall';
    $sp = 'Spring';

    print '<legend>Term</legend>' .
            '<select name="Term" id="Term">' .
            '<option value =' . $f . '>' . $f . '</option>' .
            '<option value =' . $sp . '>' . $sp . '</option>' .
            '</select>' .
            '</p>';

    $t1 = 1;
    $t2 = 2;
    $t3 = 3;
    $t4 = 4;

    print '<legend>Term Year</legend>' .
            '<select name="TermYear" id="TermYear">' .
            '<option value =' . $t1 . '>' . $t1 . '</option>' .
            '<option value =' . $t2 . '>' . $t2 . '</option>' .
            '<option value =' . $t3 . '>' . $t3 . '</option>' .
            '<option value =' . $t4 . '>' . $t4 . '</option>' .
            '</select>' .
            '</p>';

    $semArrays = array(1, 2, 3, 4, 5, 6);
    foreach ($semArrays as $semArray) {

        print '<p>';
        print '<fieldset>';
        print '<legend>Class ' . $semArray . '</legend>';
        print '<select id="class' . $semArray . '" name="class' . $semArray . '">';
        $query = 'SELECT pmkClassId, fldDepartment, fldClassNum ';
        $query .= 'FROM tblClasses ';
        $classes = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
        $lastClass = "";
        foreach ($classes as $class) {
            $Id = $class['pmkClassId'];
            $department = $class['fldDepartment'];
            $num = $class['fldClassNum'];
            $depNum = $department . ' ' . $num;
            if ($depNum != $lastClass) {
                print '<option value="' . $Id . '">' . $depNum . '</option>';
            }
        }
        print '</select>';
        print '<fieldset class="radio">';
        print '<legend>Requirement For Class ' . $semArray . '</legend>';
        print '<label><input type="radio"';
        print 'name="reqClass' . $semArray . '"';
        print 'value="Major">Major</label>';
        print '<label><input type="radio"';
        print 'name="reqClass' . $semArray . '"';
        print 'value="Minor">Minor</label>';
        print '<label><input type="radio"';
        print 'name="reqClass' . $semArray . '"';
        print 'value="Elective" checked>Elective</label>';
        print '</fieldset>';
        print '</fieldset>';
        print '</p>';
    }
    ?>
    <input type='submit' name='btnSemester'>
</form>