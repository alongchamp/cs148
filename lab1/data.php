<?php
include ("constants.php");
include ("top.php");
include ("header.php");
include ("nav.php");
?>

<table>
    <thread>
        <?php
        foreach ($headers as $oneRecord)
        {
            print "<tr>";
            print "<td>$oneRecord[0]</td>";
            print "<td>$oneRecord[1]</td>";
            print "<td>$oneRecord[2]</td>";
            print "<td>$oneRecord[3]</td>";
            print "<td>$oneRecord[4]</td>";
            print "<td>$oneRecord[5]</td>";
            print "<td>$oneRecord[6]</td>";
            print "<td>$oneRecord[7]</td>";
            print "<td>$oneRecord[8]</td>";
            print "<td>$oneRecord[9]</td>";
            print "<td>$oneRecord[10]</td>";
            print "<td>$oneRecord[11]</td>";
            print "<td>$oneRecord[12]</td>";
            print "<td>$oneRecord[13]</td>";
            print "<td>$oneRecord[14]</td>";
            print "<td>$oneRecord[15]</td>";
            print "<td>$oneRecord[16]</td>";
            print "<td>$oneRecord[17]</td>";
            print "</tr>";
        }
        ?>
    </thread>
    <?php
    foreach ($records as $oneRecord)
    {
        $subject = $oneRecord[0];
        $number = $oneRecord[1];
        $title = $oneRecord[2];
        $cNumber = $oneRecord[3];
        $section = $oneRecord[4];
        $lecLab = $oneRecord[5];
        $cCode = $oneRecord[6];
        $maxEnroll = $oneRecord[7];
        $curEnroll = $oneRecord[8];
        $start = $oneRecord[9];
        $end = $oneRecord[10];
        $days = $oneRecord[11];
        $credit = $oneRecord[12];
        $building = $oneRecord[13];
        $room = $oneRecord[14];
        $prof = $oneRecord[15];
        $netID = $oneRecord[16];
        $email = $oneRecord[17];
        
        if ($_GET["classes"] == $subject . " " . $number . " " . $section)
        {
            print "<tr>";
            print "<td>$subject</td>";
            print "<td>$number</td>";
            print "<td>$title</td>";
            print "<td>$cNumber</td>";
            print "<td>$section</td>";
            print "<td>$lecLab</td>";
            print "<td>$cCode</td>";
            print "<td>$maxEnroll</td>";
            print "<td>$curEnroll</td>";
            print "<td>$start</td>";
            print "<td>$end</td>";
            print "<td>$days</td>";
            print "<td>$credit</td>";
            print "<td>$building</td>";
            print "<td>$room</td>";
            print "<td>$prof</td>";
            print "<td>$netID</td>";
            print "<td>$email</td>";
            print "</tr>";
        }
    }
    ?>
</table>
<?php
include ("footer.php");
?>