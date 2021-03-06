<!DOCTYPE html>
<?php
include 'top.php';
?>
<h1>
    These are the SQL statements that I used to make the table.
</h1>
<article>
<p>
    CREATE TABLE IF NOT EXISTS tblTeacher (
  pmkNetId varchar(20) NOT NULL PRIMARY KEY,	
  fldFirstName varchar(20) DEFAULT NULL,
  fldLastName varchar(20) DEFAULT NULL,
  fldEmail varchar(20) DEFAULT NULL
)


CREATE TABLE IF NOT EXISTS tblSection (
  pmkSectionId int(11) NOT NULL PRIMARY KEY,
  fldCompNum int(11) DEFAULT NULL,
  fldSection varchar(20) DEFAULT NULL,
  fldLectLab varchar(20) DEFAULT NULL,
  fldCamp varchar(20) DEFAULT NULL,
  fldMaxEnroll int(11) DEFAULT NULL,
  fldCurrEnroll int(11) DEFAULT NULL,
  fldStart varchar(20) DEFAULT NULL,
  fldEnd varchar(20) DEFAULT NULL,
  fldDays varchar(20) DEFAULT NULL,
  fldCredits varchar(20) DEFAULT NULL,
  fldBuilding varchar(20) DEFAULT NULL,
  fldRoom varchar(20) DEFAULT NULL,
  fnkClassId int(11) DEFAULT NULL,
  fnkNetId varchar(20) DEFAULT NULL
) 

CREATE TABLE IF NOT EXISTS tblClass (
  pmkClassId int(11) NOT NULL PRIMARY KEY,
  fldCourseNum int(11) DEFAULT NULL,
  fldName varchar(30) DEFAULT NULL,
  fldDepartment varchar(20) DEFAULT NULL
)
</p>
</article>
