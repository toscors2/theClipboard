<?php

    include("../inc/getFunctions.php");
include("../inc/connect.php");
    $db = new DB();
    $conn->autocommit(false);
    $currDate = $_POST['date1'];
    $oldDate = $db->getOldDate($currDate);
    $counts = 0;
    $breakCount = 1;
    $fileName = "reports/inventory" . $currDate . ".csv";
    $supplierBreak = "";


?>

<html>
<head>
    <link href="stylesheet2.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Quench Lounge Order Guide for week Ending <?php echo $currDate; ?>
    <table class="working">
        <tr>
            <th>Item Name</th>
            <th>Item Number</th>
            <th>On Hand</th>
            <th>QTY Used</th>
            <th>Par</th>
        </tr>

        <?php
            #$file = fopen($fileName, "w");

            $getItems = $conn->prepare("select a.itemName, a.flavor, a.itemNum, b.supplierName as supplier, a.active from itemTbl as a join supplierTbl as b on a.supplier = b.supplierID left join categoryTbl as c on a.category = c.categoryID left join familyTbl as d on c.family = d.familyName order by b.supplierPriority, d.familyPriority, c.categoryPriority, a.itemName, a.flavor");
            $getCount = $conn->prepare("select sum(countCol) as currCount from countTbl where dateCol = ? and itemNum = ?");
            $getReceived = $conn->prepare("select sum(receivedCol) as qtyReceived from receivingTbl where dateCol = ? and itemNum = ? group by itemNum");

            $getItems->execute();
            $getItems->store_result();
            $getItems->bind_result($itemName, $flavor, $currItem, $currSupplier, $active);

            while ($getItems->fetch()) {
                if ($active == 'y') {
                    $itemCount = 0;
                    $itemName = $itemName . "  " .$flavor;
                    $processTime = microtime(true);
                    $currCount = (float)$db->getCount($currDate, $currItem);
                    $priorCount = (float)$db->getCount($oldDate, $currItem);
                    $received = (float)$db->getReceived($currDate, $currItem);
                    $preCount = $priorCount + $received;
                    $itemUsed = $preCount - $currCount;
                    $itemCount = $currCount;

                    if ($supplierBreak != $currSupplier) {
                        $supplierBreak = $currSupplier;
                        print "<th class='category'>" . $supplierBreak . "</th>";
                    }

                    if ($breakCount != 2) {
                        print "<tr>";
                        $breakCount++;

                    } else {

                        print "<tr class='break'>";
                        $breakCount = 1;
                    }

                    echo "<td style='text-align:left'>" . $itemName . "</td><td>" . $currItem.
                        "</td><td>" .$currCount . "</td><td>" . $itemUsed . "</td><td>" . "not yet" . "</td></tr>";

                    #$lines = $itemName . ", " . $currItem . ", " . $itemUsed . ", " . $currCount .
                    # ", \n";
                    #   fwrite($file, $lines);
                    $counts++;
                    $processTime = (microtime(true) - $processTime) * 1000;
                }
            }
            #fclose($file);
            echo "</br>It took " . $processTime . " milliseconds to process " . $counts . " items!";

        ?>
</h1>
</body>
</html>