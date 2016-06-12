<?php
    include("../inc/getFunctions.php");
    include("../inc/connect.php");
session_start();

    $db = new DB();
    $currDate = $_POST['date1'];
    $oldDate = $db->getOldDate($currDate);
    $counts = 0;
    $breakCount = 1;
    $fileName = "reports/inventory" . $currDate . ".csv";
    $categoryBreak = "";
?>

<html>
<head>
    <link href="stylesheet2.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Quench Lounge Inventory for week Ending <?php echo $currDate; ?>
    <table class="working">
        <tr>
            <th>Item Name</th>
            <th>Item Number</th>
            <th>Beg. QTY</th>
            <th>QTY Used</th>
            <th>On Hand</th>
        </tr>

        <?php
            #$file = fopen($fileName, "w");

            $query = "select a.itemName, a.flavor, a.itemNum, b.categoryName, a.active from itemTbl as a join categoryTbl as b on a.category = b.categoryID left join familyTbl as c on b.family = c.familyName order by c.familyPriority, b.categoryPriority, a.itemName, a.flavor";
            $results = mysqli_query($conn, $query);
            foreach ($results as $line) {
                if ($line['active'] == 'y') {
                    $itemCount = 0;
                    $processTime = microtime(true);
                    $currItem = $line['itemNum'];
                    $currentCategory = $line['categoryName'];


                    $itemName = $line['itemName'] . "  " .$line['flavor'];
                    #$itemName = $db->getItemName($currItem);
                    $currCount = (float)$db->getCount($currDate, $currItem);
                    $priorCount = (float)$db->getCount($oldDate, $currItem);
                    $received = (float)$db->getReceived($currDate, $currItem);
                    $preCount = $priorCount + $received;
                    $itemUsed = $preCount - $currCount;
                    $itemCount = $currCount;

                    if ($categoryBreak != $currentCategory) {
                        $categoryBreak = $currentCategory;
                        print "<th class='category'>" . $categoryBreak . "</th>";
                    }

                    if ($breakCount != 2) {

                        print "<tr>";
                        $breakCount++;
                    } else {

                        print "<tr class='break'>";
                        $breakCount = 1;
                    }

                    echo "<td style='text-align:left'>" . $itemName . "</td><td>" . $currItem .
                        "</td><td>" . $preCount . "</td><td>" . $itemUsed . "</td><td>" . $currCount . "</td></tr>";

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