

<?php
include ("../inc/connect.php");
/*Build location Menu*/
$buildLocMenu = $conn->prepare("select locationID, locationName from locationTbl");
$buildLocMenu->execute();
$buildLocMenu->store_result();
$buildLocMenu->bind_result($locID, $loc);

while ($buildLocMenu->fetch()) {
 echo "<div id='".$locID."' class='button'>";
 echo "<button class='button selBtn' id='" .$locID ."' name='" .$loc ."'>" . $loc . "</button>";
 echo "</div>";
}
?>


