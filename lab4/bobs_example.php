<?php

include "top.php";
//########################################################
//	This	page	lists	the	records	based	on	the	query	given
//########################################################
$query = 'SELECT	fldFirstName,	fldLastName	'
        . 'FROM	tblTeacher '
        . 'ORDER BY fldLastName, fldFirstName';
//public	function	select($query,	$values	=	"",	$wheres	=	1,	$conditions	=	0,	
//			$quotes	=	0,	$symbols	=	0,	$spacesAllowed	=	false,	$semiColonAllowed	=	false)
$records = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);
if (DEBUG) {
    print "<p>Contents	of	the	array<pre>";
    print_r($records);
    print "</pre></p>";
}
print '<h2	class="alternateRows">Meet	the	Jetsons!</h2>';
if (is_array($records)) {
    foreach ($records as $record) {
        print "<p>" . $record['fldFirstName'] . "	" . $record['fldLastName'] . "</p>";
    }
}
include "footer.php";
?>