<?php
// Add in top
include 'top.php';
?>

<!-- Print out the title and list boxes -->
<article>
    <h1>
        Choose a Class from the Department
    </h1>

    <form action="" method="post">

        <br>
        <br>
        

        <fieldset class='listbox'>
            <label for="class">Class</label>

            <br>
            <br>

            <select name="class">
                <?php
                
                print $department;
                
                $query = 'SELECT pmkClassId, fldName, fldCourseNum FROM tblClass WHERE fldDepartment LIKE ' . ($_GET($department));

                $classes = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
               
                
                foreach ($classes as $class) {
                    
                    $Id = $class['pmkClassId'];
                    
                    $name = $class['fldName'];
                    
                    $crsNumber = $class['fldCourseNum'];
                    
                    $cNmNum = $name . " " . $crsNumber;

                    print '<option value="' . $Id . '">' . $cNmNum . '</option>';
                }
                ?>
            </select>

            <input type='submit'>            
            </form>

            </article>