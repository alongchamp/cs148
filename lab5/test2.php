<?php
$user = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
$SNetId = $user;
$ANetId = "";
$CatalogYear = "";
$StartYear = "";
$Degrees = "";
$dateCreate = "";

$planCreated = false;

if (isset($_POST['btnSInfo'])) {
    $SNetId = htmlentities($_POST['txtSNetId'], ENT_QUOTES, "UTF-8");
    $ANetId = htmlentities($_POST['txtANetId'], ENT_QUOTES, "UTF-8");
    $CatalogYear = htmlentities($_POST['txtCatalogYear'], ENT_QUOTES, "UTF-8");
    $StartYear = htmlentities($_POST['txtStartYear'], ENT_QUOTES, "UTF-8");
    $Degree = htmlentities($_POST['lstDegree'], ENT_QUOTES, "UTF-8");
    $dateCreate = date("Y-m-d");


    $query = "INSERT INTO tblPlans (fnkSNetId, fnkANetId, fldCatalogYear, fldStudentDegree, fldDateCreated) VALUES (?, ?, ?, ?, ?)";
    $dataArray = array($SNetId, $ANetId, $StartYear, $Degree, $dateCreate);
    $newPlan = $thisDatabaseWriter->insert($query, $dataArray, 0);
    $_SESSION['lastPlan'] = $thisDatabaseWriter->lastInsert();

    $SNetId = $user;
    $SEmail = $SNetId . "@uvm.edu";

    function ldapName($SNetId) {
        if (empty($SNetId)) {
            return "no:netid";

            $SName = "not:found";

            $ds = ldap_connect("ldap.uvm.edu");

            if ($ds) {
                $r = ldap_bind($ds);
                $dn = "uid=$SName,ou=People,dc=uvm,dc=edu";
                $filter = "(|(netid=$SName))";
                $findthese = array("sn", "givenname");

                $sr = ldap_search($ds, $dn, $filter, $findthese);

                if (ldap_count_entries($ds, $sr) > 0) {
                    $info = ldap_get_entries($ds, $sr);
                    $name = $info[0]["givenname"][0] . " " . $info[0]["sn"][0];
                }
            }

            ldap_close($ds);

            return $name;
        }

        list($SFName, $SLName) = explode(" ", ldapName($SNetId), 2);

        $query_2 = "INSERT INTO tblStudents SET pmkSNetId = ?, fldSFName = ?, fldSLName = ?, fldSEmail = ?, fldStartYear = ?";
        $dataArray_2 = array($SNetId, $SFName, $SLName, $SEmail, $StartYear);
        $newStudent = $thisDatabaseWriter->insert($query_2, $dataArray2);
    }

}

if ($planCreated) {
    print "Plan Started: Please Enter Courses for Semester";
    include "plan.php";
} else {
    ?>
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
            <label for="CatalogYear">Catalog Year</label>
            <p>
                <input type="text" id="txtCatalogYear" name="txtCatalogYear" value="<?php $CatalogYear ?>">
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
    <?php
}
