<?php
// add in top.php
include 'top.php';
//check for submitted variables
if (isset($_POST['department'])) {
    $department = htmlentities($_POST['department'], ENT_QUOTES, "UTF-8");
}
if (isset($_POST['class'])) {
    $cls = htmlentities($_POST['class'], ENT_QUOTES, "UTF-8");
}
?>

<!-- Print out the title and list boxes -->
<article>
    <h1>
        Choosing a Class by Department or the Class
    </h1>

    <!-- start form -->
    <form action="index.php" method="post">

    <fieldset class='listbox'>
        <label for="department">Department</label>
        <select name="department">
            <?php
            // query to get variables to show in list box
            $query = 'SELECT fldDepartment, pmkClassId ';
            $query .= 'FROM tblClass';
            // sets up array to read from
            $depts = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
            // initialize $lastDpt
            $lastDpt = '';

            // checks variables and adds to list box if its not in it already
            if (isset($_POST['department'])) {
                foreach ($depts as $dept) {
                    $dpt = $dept['fldDepartment'];
                    $clsId = $dept['pmkCourseId'];

                    // print department if its not already there
                    if ($dpt != $lastDpt) {
                        print '<option value="' . $dpt . '"';
                        if ($dpt == $_POST['department']) {
                            print ' selected';
                        }
                        print '>' . $dpt . '</option>';
                        $lastDpt = $dpt;
                    }
                }
            } else {
                foreach ($depts as $dept) {
                    $dpt = $dept['fldDepartment'];
                    $clsId = $dept['pmkCourseId'];

                    // print department if its not already there
                    if ($dpt != $lastDpt) {
                        print '<option value="' . $dpt . '">' . $dpt . '</option>';
                        $lastDpt = $dpt;
                    }
                }
            }
            echo '<pre>';
            print_r($_POST);
            echo $_POST['department'];
            echo '</pre>';
            ?>
        </select>
    </fieldset>
    <fieldset class='listbox'>
        <label for="class">Class</label>
        <?php
        // next list box to show classes
        if (isset($_POST['department'])) {
            if (isset($_POST['class'])) {
                print '<select name="class">';
                // sql to grab from database
                $query = 'SELECT pmkClassId, fldName, fldCourseNum ';
                $query .= 'FROM tblClass ';
                // tells the computer what youre looking for
                $query .= 'WHERE fldDepartment LIKE ?';
                $data = array($_POST['department']);
                // create the array
                $classes = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
                // set first one as empty
                // print out the classes in the department
                foreach ($classes as $class) {
                    $Id = $class['pmkClassId'];
                    $name = $class['fldName'];
                    $crsNumber = $class['fldCourseNum'];
                    $cNmNum = $name . " " . $crsNumber;
                    print '<option value="' . $Id . '"';
                    if ($Id == $_POST['class']) {
                        print ' selected';
                    }
                    print '>' . $cNmNum . '</option>';
                }
            } else {
                print '<select name="class">';
                // sql to grab from database
                $query = 'SELECT pmkClassId, fldName, fldCourseNum ';
                $query .= 'FROM tblClass ';
                // tells the computer what youre looking for
                $query .= 'WHERE fldDepartment LIKE ?';
                $data = array($_POST['department']);
                // create the array
                $classes = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
                // set first one as empty
                print '<option value=""></option>';
                // print out the classes in the department
                foreach ($classes as $class) {
                    $Id = $class['pmkClassId'];
                    $name = $class['fldName'];
                    $crsNumber = $class['fldCourseNum'];
                    $cNmNum = $name . " " . $crsNumber;
                    print '<option value="' . $Id . '">' . $cNmNum . '</option>';
                }
            }
        } else {
            // prints all classes
            print '<select name="class">';
            $query = 'SELECT pmkClassId, fldName, fldCourseNum ';
            $query .= 'FROM tblClass';
            $classes = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
            foreach ($classes as $class) {
                $Id = $class['pmkClassId'];
                $name = $class['fldName'];
                $crsNumber = $class['fldCourseNum'];
                $cNmNum = $name . " " . $crsNumber;
                print '<option value="' . $Id . '">' . $cNmNum . '</option>';
            }
        }
        print '</select>';
        ?>
    </fieldset>
    <input type='submit'>            
    </form>
</article>
<article>

    <?php
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    
    echo $Id;
    ?>
    
    <?php
    // if given department
    if (isset($_POST['department'])) {
        // if given the class
        if (isset($cls)) {
            print '<table id="table">';
            $query = 'SELECT * ';
            $query .= 'FROM tblSection ';
            $query .= 'JOIN tblClass ON pmkClassId = fnkClassId ';
            $query .= 'JOIN tblTeacher ON pmkNetId = fnkNetId ';
            $query .= 'WHERE fnkClassId LIKE ?';
            $classData = array($cls);
            $printers = $thisDatabaseReader->select($query, $classData, 1, 0, 0, 0, false, false);
            foreach ($printers as $printer) {
                print '<tr>';
                print '<td>' . $printer['fldCompNum'] . '</td>';
                print '<td>' . $printer['fldSection'] . '</td>';
                print '<td>' . $printer['fldLectLab'] . '</td>';
                print '<td>' . $printer['fldMaxEnroll'] . '</td>';
                print '<td>' . $printer['fldCurrEnroll'] . '</td>';
                print '<td>' . $printer['fldStart'] . '</td>';
                print '<td>' . $printer['fldEnd'] . '</td>';
                print '<td>' . $printer['fldDays'] . '</td>';
                print '<td>' . $printer['fldCredit'] . '</td>';
                print '<td>' . $printer['fldBuilding'] . '</td>';
                print '<td>' . $printer['fldRoom'] . '</td>';
                print '<td>' . $printer['fnkClassId'] . '</td>';
                print '<td>' . $printer['fnkNetId'] . '</td>';
                print '<td>' . $printer['fldCourseNum'] . '</td>';
                print '<td>' . $printer['fldName'] . '</td>';
                print '<td>' . $printer['fldDepartment'] . '</td>';
                print '<td>' . $printer['pmkNetId'] . '</td>';
                print '<td>' . $printer['fldFirstName'] . '</td>';
                print '<td>' . $printer['fldLastName'] . '</td>';
                print '<td>' . $printer['fldEmail'] . '</td>';
                print '</tr>';
            }
        }
        // if not given course
        else {
            $query = 'SELECT * ';
            $query .= 'FROM tblSection ';
            $query .= 'JOIN tblClass ON pmkClassId = fnkClassId ';
            $query .= 'JOIN tblTeacher ON pmkNetId = fnkNetId ';
            $query .= 'WHERE fldDepartment LIKE ?';

            $deptData = array($_POST['department']);
            $printer = $thisDatabaseReader->select($query, $deptData, 1, 0, 0, 0, false, false);

            foreach ($printers as $printer) {
                print '<tr>';
                print '<td>' . $printer['fldCompNum'] . '</td>';
                print '<td>' . $printer['fldSection'] . '</td>';
                print '<td>' . $printer['fldLectLab'] . '</td>';
                print '<td>' . $printer['fldMaxEnroll'] . '</td>';
                print '<td>' . $printer['fldCurrEnroll'] . '</td>';
                print '<td>' . $printer['fldStart'] . '</td>';
                print '<td>' . $printer['fldEnd'] . '</td>';
                print '<td>' . $printer['fldDays'] . '</td>';
                print '<td>' . $printer['fldCredit'] . '</td>';
                print '<td>' . $printer['fldBuilding'] . '</td>';
                print '<td>' . $printer['fldRoom'] . '</td>';
                print '<td>' . $printer['fnkClassId'] . '</td>';
                print '<td>' . $printer['fnkNetId'] . '</td>';
                print '<td>' . $printer['fldCourseNum'] . '</td>';
                print '<td>' . $printer['fldName'] . '</td>';
                print '<td>' . $printer['fldDepartment'] . '</td>';
                print '<td>' . $printer['pmkNetId'] . '</td>';
                print '<td>' . $printer['fldFirstName'] . '</td>';
                print '<td>' . $printer['fldLastName'] . '</td>';
                print '<td>' . $printer['fldEmail'] . '</td>';
                print '</tr>';
            }
        }
    }
    // if not given department
    else {
        $query = 'SELECT * ';
        $query .= 'FROM tblSection ';
        $query .= 'JOIN tblClass ON pmkClassId = fnkClassId ';
        $query .= 'JOIN tblTeacher ON pmkNetId = fnkNetId ';

        $everything = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

        foreach ($printers as $printer) {
            print '<tr>';
            print '<td>' . $printer['fldCompNum'] . '</td>';
            print '<td>' . $printer['fldSection'] . '</td>';
            print '<td>' . $printer['fldLectLab'] . '</td>';
            print '<td>' . $printer['fldMaxEnroll'] . '</td>';
            print '<td>' . $printer['fldCurrEnroll'] . '</td>';
            print '<td>' . $printer['fldStart'] . '</td>';
            print '<td>' . $printer['fldEnd'] . '</td>';
            print '<td>' . $printer['fldDays'] . '</td>';
            print '<td>' . $printer['fldCredit'] . '</td>';
            print '<td>' . $printer['fldBuilding'] . '</td>';
            print '<td>' . $printer['fldRoom'] . '</td>';
            print '<td>' . $printer['fnkClassId'] . '</td>';
            print '<td>' . $printer['fnkNetId'] . '</td>';
            print '<td>' . $printer['fldCourseNum'] . '</td>';
            print '<td>' . $printer['fldName'] . '</td>';
            print '<td>' . $printer['fldDepartment'] . '</td>';
            print '<td>' . $printer['pmkNetId'] . '</td>';
            print '<td>' . $printer['fldFirstName'] . '</td>';
            print '<td>' . $printer['fldLastName'] . '</td>';
            print '<td>' . $printer['fldEmail'] . '</td>';
            print '</tr>';
        }
    }
    ?>
</table>

</article>
