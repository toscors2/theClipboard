

<?php
include ("../inc/connect.php");


/*Build Category Menu*/
$buildCatMenu = $conn->prepare("select categoryID, categoryName from categoryTbl");
$buildCatMenu->execute();
$buildCatMenu->store_result();
$buildCatMenu->bind_result($catID, $cat);

while ($buildCatMenu->fetch()) {
 echo "<div id='".$catID."' class='button'>";
 echo "<button class='button selBtn' id='" .$catID ."' name='" .$cat ."'>" . $cat . "</button>";
 echo "</div>";
}
?>

