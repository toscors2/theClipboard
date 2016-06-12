<?php

session_start();
include("../inc/connect.php");

?>


<?php
if (is_numeric($_POST['count'])) {
    
    $itemNum = $_POST['itemNum'];
    $countCol = $_POST['count'];
    $dateCol = $_SESSION['currDate'];
    $locationID = ($_SESSION['locationID']);
} else {
    die();
}
#var_dump($_POST);
#var_dump($_SESSION);

$insertCount = $conn->prepare("insert into countTbl (countCol, itemNum, dateCol, locationCol) values 
(?, ?, ?, ?)");
$insertCount->bind_param("diis", $countCol, $itemNum, $dateCol, $locationID);
$insertCount->execute();


header("Location: items.php");
?>

