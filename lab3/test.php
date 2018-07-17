<?php
// Add in top
include 'top.php';
?>

<!-- Print out the title and list boxes -->
<article>
    <h1>
        Choosing a Class by Department or the Class
    </h1>

    <form action="choose.php" method="post">

        <br>
        <br>


        <fieldset class='listbox'>
            <label for="department">Department</label>

            <br>
            <br>

            <select name="department">
                <?php
                $query = 'SELECT fldDepartment, pmkClassId FROM tblClass';

                $depts = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
                //initialize last department variable
                $lastDpt = '';

                //read through database for department and course id
                foreach ($depts as $dept) {
                    //put current departmen into $dpt
                    $dpt = $dept['fldDepartment'];
                    //put current class id into $clsId
                    $clsId = $dept['pmkCourseId'];

                    // if new department print new department with class id set current department as last department
                    if ($dpt != $lastDpt) {
                        print '<option value="' . $clsId . '">' . $dpt . '</option>';
                        $lastDpt = $dpt;
                    }
                }
                ?>
            </select>
        </fieldset>
        <input type='submit'>            
    </form>
    
    <form action="results.php" method="post">

        <br>
        <br>


        <fieldset class='listbox'>
            <label for="class">Class</label>

            <br>
            <br>

            <select name="class">
                <?php
                $query = 'SELECT fldName, fldCourseNum FROM tblClass WHERE fldDepartment LIKE' . ($_GET($department));

                $results = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

                //read through database for department and course id
                foreach ($results as $result) {
                    //put current departmen into $dpt
                    $name = $result['fldName'];
                    //put current class id into $clsId
                    $crsNum = $result['fldCourseNum'];
                    $crs = $name . " " . $crsNum;
                            
                    // if new department print new department with class id set current department as last department
                    if ($name != $lstName) {
                        print '<option value="' . $clsId . '">' . $crs . '</option>';
                        $lastName = $name;
                    }
                }
                ?>
            </select>
        </fieldset>
        <input type='submit'>            
    </form>

</article>