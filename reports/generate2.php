<?php

var_dump($_POST);
echo "from post<br />";
var_dump($_SESSION);
echo "from session<br />";
#$date = $_POST['date3'];
$date = 42516;
$count = 0;
include ("../inc/connect.php");
include("../inc/getFunctions.php");

function toFile($lines) {
    $file = fopen("'physicalCount" .$getDate() .".txt'", "w");
        $string = $lines ."\n";
        fwrite($file, $string);
    
    
    
}

$sql7 = "select sum(countCol) as a.countCol, a.itemNum, a.dateCol from countTbl as a join items as b on a.itemNum = b.itemNum where a.dateCol = " .
    $date . " group by itemNum";
$res7 = mysqli_query($conn, $sql7);

var_dump($res7);

echo "<table><tr><th>Final Count</th><th>Item Number</th><th>Item Name</th><th>Date Counted</th></tr>";

foreach ($res7 as $counts) {
$sql8 = "select ";
    print "<tr>";
    $sql11 = "select itemName, itemNum, flavor from items where itemNum = " . $counts['itemNum'];
    $res11 = mysqli_query($conn, $sql11);
    foreach ($res11 as $items) {
        #       var_dump($items);
    }
    $count++;
    echo "<td align='center'>" . $counts['countCol'] . "</td><td align='center'>" .
        $counts['itemNum'] . "</td><td align='center'>" . $items['itemName'] . "  " . $items['flavor'] .
        "</td><td align='center'>" . $date . "</td></tr>";
    #        echo "qty used array:  <br />";
    #    var_dump($qtyUsed);
}
echo "</table>";
echo "<br />" . $count;

?>