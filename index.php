<?php

include "top.php";
//########################################################
// This	page lists the records based on the query given
//########################################################

// create query to add to injection
// changed to read from tblTeacher and order alphabetically by last name then first name
// joined tblTeacher to tblSection and tblClass and created the where statment to check for cs courses only
// added in the sum of students, grouped teachers by their netid's and ordered the list from the most students taught to least

$query = 'SELECT fldFirstName, fldLastName, fldDepartment, fnkNetId, SUM(fldCurrEnroll) ';
$query .= 'FROM tblTeacher ';
$query .= 'JOIN tblSection ON fnkNetId = pmkNetId ';
$query .= 'JOIN tblClass ON fnkClassId = pmkClassId ';
$query .= 'WHERE fldDepartment LIKE ? ';
$query .= 'GROUP BY pmkNetId ';
$query .= 'ORDER BY SUM(fldCurrEnroll) DESC';

// added a 1 to allow the order to go through and not break the code
// added in the array to search for which is cs in this case and a 1 to allow the where to work
$records = $thisDatabaseReader->select($query, array('cs'), 1, 1, 0, 0, false, false);

//if (DEBUG) {
    print "<p>Contents of the array<pre>";
    print_r($records);
    print "</pre></p>";
//}
print '<h2 class="alternateRows">UVM Professors</h2>';
if (is_array($records)) {
    foreach ($records as $record) {
        // added $record[4] which allows the php to print the number of students enrolled in courses taught by that professor
        print "<p>" . $record['fldFirstName'] . " " . $record['fldLastName'] . "     ". $record[4] . "</p>";
    }
}

include "footer.php";
?>