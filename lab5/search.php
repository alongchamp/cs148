<?php

include 'top.php';
include 'nav.php';
if (!isset($_GET['id'])) {
    $data = array($user);
    $query = 'SELECT pmkPlanId, fldDateCreated FROM tblPlans WHERE fnkSNetId = ?';
    $results = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, FALSE, FALSE);
    echo '<ul>';
    foreach ($results as $record) {
        echo '<li><a href=search.php?id=' . $record['pmkPlanID'] . '>';
        echo $record['fldDateCreated'];
        echo '</a></li>';
    }
    echo '</ul>';
} else {
    //Grabs the User's Plan information
    $id = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
    $query = 'SELECT fldStartYear, fldSFName, fldSLName, tblAdvisors.pmkANetID,
        tblAdvisors.fldAEmail, tblAdvisors.fldAFName, tblAdvisors.fldALName, 
	tblDegree.fldCollege, tblDegree.fldDegType, tblDegree.fldMajor, 
        tblPlans.fldDateCreated 
        FROM tblStudents 
	JOIN tblPlans on tblStudents.pmkSNetID = tblPlans.fnkSNetID 
	JOIN tblAdvisors on tblPlans.fnkANetID = tblAdvisors.pmkANetID 
	JOIN tblDegree on tblPlans.fnkDegID = tblDegree.pmkDegID 
        WHERE pmkPlanID = ?';
    $data = array($id);
    $results = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, FALSE, FALSE);

    echo '<article id="info"><div id="degreeinfo"><p>';
    echo '<span>Degree: ' . $results[0]['fldType'] . ' ' . $results[0]['fldConcentration'] . ' Catalog Year: ' . $results[0]['fldStartYear'] . '</span>';
    echo '</p></div><div id="studentinfo"><p>';
    echo '<span>Student <a href="mailto:' . $user . '@uvm.edu">' . $results[0]['fldSFirstName'] . ' ' . $results[0]['fldSLastName'] . '</a></span>';
    echo '</p></div><div id="advisorinfo"><p>';
    echo '<span>Advisor <a href="mailto:' . $results[0]['fldEmail'] . '">' . $results[0]['fldAFirstName'] . ' ' . $results[0]['fldALastName'] . '</a></span>';
    echo '</p></div></article>';
    //Grabs all the classes related to the Plan selected
    $query = 'SELECT tblSemesters.pmkTerm, tblSemesters.pmkTermYear, 
        tblSemesterCourses.fldRequired, tblClasses.fldDepartment, 
        tblClasses.fldClassNum, tblClasses.fldCredits
        FROM tblPlans
        JOIN tblSemesters on tblPlans.pmkPlanID = tblSemesters.fnkPlanID 
	JOIN tblSemesterClass on tblSemesters.pmkSemesterId = tblSemesterClass.fnkSemesterID 
	AND tblSemesters.pmkTerm = tblSemesterClass.fnkTerm 
	AND tblSemesters.pmkTermYear = tblSemesterClass.fnkTermYear 
	JOIN tblClasses ON tblSemesterClass.fnkClassID = tblClass.pmkClassID
        WHERE pmkPlanID = ?';
    $results = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, FALSE, FALSE);
    $semester = array();
    $classes = array();
    foreach ($results as $record) {
//        echo'<pre>';
//        print_r($record);
//        echo'</pre>';
        $credits = $record['fldCredits'];
        $requirements = $record['fldRequired'];
        $Term = $record['pmkTerm'] . ' ' . $record['pmkTermYear'];
        $class = $record['fldDepartment'] . ' ' . $record['fldClassNumber'];

        //Creates courses array in 3d array
        $course['credits'] = $credits;
        $course['req'] = $requirements;
        $course['class'] = $class;


        if (!isset($semester[$Term])) {
            $semester[$Term][0] = $Term;
            array_push($semester[$Term], $course);
        } elseif ($semester[$Term][0] == $Term) {
            array_push($semester[$Term], $course);
        }
    }


    foreach ($semester as $record) {
        $creditTotal = 0;
        echo '<div><span>' . $record[0] . '<ul>';
        for ($index = 1; $index < count($record); $index++) {
            $credits = $record[$index]['credits'];
            $req = $record[$index]['req'];
            $class = $record[$index]['class'];
            $creditTotal += $credits;
            echo '<li class="' . $req . '">' . $class . '</li>';
        }
        echo '</ul>';
        echo 'Total Credits: ' . $creditTotal . '</div>';
    }
}