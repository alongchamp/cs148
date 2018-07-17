<form action="create.php" method="post">
    <fieldset>
        <label for="SNetId" class="required">Student NetId</label>
        <p>
            <input type="text" id="txtSNetId" name="txtSNetId" value="<?php $SNetId ?>">
        </p>
        <label for="ANetId">Advisor NetId</label>
        <p>
            <input type="text" id="txtANetId" name="txtANetId" value="<?php $ANetId ?>">
        </p>
        <label for="StartYear">Student Start Year</label>
        <p>
            <input type="text" id="txtStartYear" name="txtStartYear" value="<?php $StartYear ?>">
        </p>
        <label for="degree">Student Degree</label>
        <p>
            <select name="lstdegree">';
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