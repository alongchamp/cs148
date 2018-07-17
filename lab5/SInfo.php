<?php
// initialize variables
$SNetId = $user;
$ANetId = "";
$CatalogYear = "";
$StartYear = "";
$Degrees = "";
$dateCreate = "";

$planCreated = false;

// test if button for student info has been submitted
if (isset($_POST['btnSInfo'])) {
    // grab student info from post array if possible 
    $SNetId = htmlentities($_POST['txtSNetId'], ENT_QUOTES, "UTF-8");
    $ANetId = htmlentities($_POST['txtANetId'], ENT_QUOTES, "UTF-8");
    $CatalogYear = htmlentities($_POST['txtCatalogYear'], ENT_QUOTES, "UTF-8");
    $StartYear = htmlentities($_POST['txtStartYear'], ENT_QUOTES, "UTF-8");
    $Degree = htmlentities($_POST['lstdegree'], ENT_QUOTES, "UTF-8");
    $dateCreate = date("Y-m-d");
    
    // write student info to tblPlans
    $query_6 = "INSERT INTO tblPlans (fldCatalogYear, fldDateCreated, fnkSNetId, fnkANetId, fldDegId) VALUES (?, ?, ?, ?, ?)";
    $dataArray_6 = array($CatalogYear, $dateCreate, $SNetId, $ANetId, $Degree);
    $newPlan_1 = $thisDatabaseWriter->insert($query_6, $dataArray_6, 0);
    $_SESSION['lastPlan'] = $thisDatabaseWriter->lastInsert();

    // grab student netid and make email
    $uvmID = $user;
    $SEmail = $SNetId . "@uvm.edu";

    // grabs user info for name from uvm database
    function ldapName($uvmID) {
        if (empty($uvmID)) {
            return "no:netid";
        }
        $Sname = "not:found";

        $ds = ldap_connect("ldap.uvm.edu");

        if ($ds) {
            $r = ldap_bind($ds);
            $dn = "uid=$uvmID,ou=People,dc=uvm,dc=edu";
            $filter = "(|(netid=$uvmID))";
            $findthese = array("sn", "givenname");

            $sr = ldap_search($ds, $dn, $filter, $findthese);

            if (ldap_count_entries($ds, $sr) > 0) {
                $info = ldap_get_entries($ds, $sr);
                $Sname = $info[0]["givenname"][0] . " " . $info[0]["sn"][0];
            }
        }

        ldap_close($ds);

        return $Sname;
    }

    // get users name 
    list($SFName, $SLName) = explode(" ", ldapName($uvmID), 2);

    $query_2 = "INSERT INTO tblStudents (pmkSNetId, fldSFName, fldSLName, fldSEmail, fldStartYear) VALUES (?, ?, ?, ?, ?)";

    $dataArray_2 = array($SNetId, $SFName, $SLName, $SEmail, $StartYear);

    $newStudent = $thisDatabaseWriter->insert($query_2, $dataArray_2);
}

// user input for netid, advisor netid, catalog year, start year and degree
if (isset($_POST['btnSInfo'])) {
    print "Plan Started: Please Enter Courses for Semester";
    include "plan.php";
} else {
    
   print ' <form action="create.php" method="post">
        <fieldset>
            <label for="SNetId" class="required">Student NetId</label>
            <p>
                <input type="text" id="txtSNetId" name="txtSNetId" value="'.$user.'">
            </p>
            <label for="ANetId">Advisor NetId</label>
            <p>
                <input type="text" id="txtANetId" name="txtANetId" value="'.$ANetId.'">
            </p>
            <label for="StartYear">Student Start Year</label>
            <p>
                <input type="text" id="txtStartYear" name="txtStartYear" value="'.$StartYear.'">
            </p>
            <label for="CatalogYear">Catalog Year</label>
            <p>
                <input type="text" id="txtCatalogYear" name="txtCatalogYear" value="'.$CatalogYear.' ">
            </p>
            <label for="degree">Student Degree</label>
            <p>
                <select name="lstdegree">';
          
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
    <?php
}
