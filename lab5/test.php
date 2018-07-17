<form action="plan.php" method="post">
    <label for="class">Courses for Semester</label>
    <?php
    $semArrays = array( 1, 2, 3, 4, 5, 6);
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
        print 'value="Elective">Elective</label>';
        print '</fieldset>';
        print '</fieldset>';
        print '</p>';
    }
    ?>
    
</form>

<form action="create.php" method="post">
    <fieldset>
        <label for="SNetId" class="required">Student NetId</label>
        <p>
            <input type="text" id="txtSNetId" name="txtSNetId" value="<?php print $SNetId; ?>">
        </p>
        <label for="ANetId">Advisor NetId</label>
        <p>
            <input type="text" id="txtANetId" name="txtANetId" value="<?php print $ANetId; ?>">
        </p>
        <label for="StartYear">Student Start Year</label>
        <p>
            <input type="text" id="txtStartYear" name="txtStartYear" value="<?php print $StartYear; ?>">
        </p>
        <label for="degree">Student Degree</label>
        <p>
            <select name="lstdegree">
                <?php
                $query = 'SELECT fldDegType, fldMajor ';
                $query .= 'FROM tblDegree';
                $Degrees = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
                $lastTypeMajor = "";

                foreach ($Degrees as $Degree) {
                    $type = $Degree['fldDegType'];
                    $major = $Degree['fldMajor'];
                    $typeMajor = $type . ' ' . $major;

                    if ($typeMajor != $lastTypeMajor) {
                        print '<option value="' . $typeMajor . '">' . $typeMajor . '</option>';
                        $lastTypeMajor = $typeMajor;
                    }
                }
                ?>
            </select> 
        </p>
    </fieldset>
    <input type="submit" name="btnSInfo">
</form>