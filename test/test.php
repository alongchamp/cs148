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