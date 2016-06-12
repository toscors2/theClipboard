<?php

include ("connect.php");
echo $database ."</br></br>";
?>

<html>

<head>
<title>Receiving</title>
<link href="../inc/stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body><p>
<?php

$sql = "select * from supplierTbl";
$res = mysqli_query($conn, $sql);

$sql2 = "select * from dateTbl order by dateCol DESC";
$res2 = mysqli_query($conn, $sql2);

echo "<form name='supplierSelect' method='POST' action='receiveInventory.php'><select input type='text' name='supplierID'>";

foreach ($res as $supplier) {
    echo $supplier ."</br></br>";
    #echo $res ."</br></br>";
    echo "<option value='" .$supplier['supplierID'] .":" .$supplier['supplierName'] ."'>" .$supplier['supplierName'] ."</option>";    
} 
echo "</select><select input type='text' name='dateCol'>";

foreach ($res2 as $dateCol) {
    echo "<option value='" .$dateCol['dateCol'] ."'>" .$dateCol['dateCol'] ."</option>";
}
echo "</select>
<input type='submit' name='submit' value='submit'></input></form>";
#echo $res;
?>



</p></body>


</html>