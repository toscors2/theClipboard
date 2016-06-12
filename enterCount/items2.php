<?php
include("../inc/getFunctions.php");
include("../inc/connect.php");
session_start();
#session_start();
#$db = new DB();


$currDate = $_SESSION['currDate'];
$oldDate = $_SESSION['oldDate'];
$category = $_SESSION['category'];
$categoryID = $_SESSION['categoryID'];
$location = $_SESSION['location'];
$locationID = $_SESSION['locationID'];



$columnCount = 0;
$count = 0;

/*    Get Items to search with*/
$getItems = $conn->prepare("select a.itemName, a.flavor, a.itemNum from itemTbl as a left join categoryTbl as b on a.category = b.categoryID where a.category = ? order by a.itemName, a.flavor");
$getItems->bind_param("s", $_SESSION['categoryID']);
$getItems->execute();
$getItems->store_result();
$getItems->bind_result($itemName, $flavor, $itemNum);

while ($getItems->fetch()) {

    echo "<div id='itemWrap". $itemNum ."' class='itemFloat itemWrap'>";
    include("itemTable.php");
    echo "</div>";
    $count++;
    $columnCount = 0;
}





?>





