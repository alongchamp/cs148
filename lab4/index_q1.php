<?php

include "top.php";
//########################################################
// This	page lists the records based on the query given
//########################################################

// create query to add for injection
// changed to read from tblTeacher and order alphabetically by last name then first name
$query = 'SELECT fldFirstName, fldLastName ';
$query .= 'FROM tblTeacher ';
$query .= 'ORDER BY fldLastName, fldFirstName';

// added a 1 to allow the order to go through and not break the code
$records = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);

if (DEBUG) {
    print "<p>Contents of the array<pre>";
    print_r($records);
    print "</pre></p>";
}
print '<h2 class="alternateRows">UVM Professors</h2>';
if (is_array($records)) {
    foreach ($records as $record) {
        print "<p>" . $record['fldFirstName'] . " " . $record['fldLastName'] . "</p>";
    }
}

include "footer.php";
?>