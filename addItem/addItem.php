<?php

include ("../inc/connect.php");
$itemNum = $_POST['itemNum'];
$itemName = $_POST['itemName'];
$flavor = $_POST['flavor'];
$category = $_POST['category'];
$supplier = $_POST['supplier'];
$pack = $_POST['pack'];
$size = $_POST['size'];

echo $itemNum .":  item number<br />";
echo $itemName .":  item name<br />";
echo $flavor .":  flavor<br />";
echo $category .":  category<br />";
echo $supplier .": supplier<br />";
echo $pack .": pack<br />";
echo $size .":  size<br />";

$query = "insert into itemTbl (itemNum, itemName, flavor, category, supplier, pack, size, active) values (" .$itemNum .", '" .$itemName ."', '" .$flavor ."', '" .$category ."', '" .$supplier ."', " .$pack .", " .$size .", 'y')";
$insert = mysqli_query($conn, $query);

?>