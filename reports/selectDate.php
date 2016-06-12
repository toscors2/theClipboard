<?php

session_start();
include ("../inc/connect.php");

$sql5 = "select * from dateTbl order by dateID DESC";
$res5 = mysqli_query($conn, $sql5);
#var_dump($res5);
#echo "<br />";
$sql6 = "select * from categoryTbl";
$res6 = mysqli_query($conn, $sql6);
#var_dump($res6);

echo "<br /><br /><br /><form name='startCount' method='POST' action='generate1.php'>
<label for='date1'>Select Count Date</label>
<select id='date1' input type='text' name ='date1'>";
foreach ($res5 as $dates) {
    echo "<option value='" . $dates['dateCol'] . "'>" . $dates['dateCol'] .
        "</option>";
}
echo "</select><br /><br />";

echo "<input type='submit' name='send2' value='Get Used Report'></input></form>";

echo "<br /><br /><br /><form name='getCounts' method='POST' action='generate2.php'>
<label for='date3'>Select Count Date</label>
<select id='date3' input type='text' name ='date3'>";
foreach ($res5 as $dates3) {
    echo "<option value='" . $dates3['dateCol'] . "'>" . $dates3['dateCol'] .
        "</option>";
}
echo "</select><br /><br />";

echo "<input type='submit' name='send2' value='Get Counts'></input></form>";

?>