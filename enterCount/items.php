<?php
#include("../inc/getFunctions.php");
include("../inc/cfgGlobal.php");
include("../inc/connect.php");

#session_start();
#$db = new DB();


$currDate = $_SESSION['currDate'];
$oldDate = $_SESSION['oldDate'];
$category = $_SESSION['category'];
$categoryID = $_SESSION['categoryID'];
$location = $_SESSION['location'];
$locationID = $_SESSION['locationID'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Count Screen</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <link href="../inc/stylez.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css"/>



</head>
<body>
<div id="pageContainer" data-role="page">

    <?php
    /*Build Category Menu*/
    $buildCatMenu = $conn->prepare("select categoryID, categoryName from categoryTbl");
    $buildCatMenu->execute();
    $buildCatMenu->store_result();
    $buildCatMenu->bind_result($catID, $cat);

    echo "<div id='countHeader' data-role='header' data-position='fixed' class='ui-grid-c'><div id='selectCategoryWrapper' data-role='collapsible' class='ui-block-a'><h3> Category</h3>";

    while ($buildCatMenu->fetch()) {
        echo "<div id='".$catID."' class='button'>";
        echo "<button class='button selBtn' id='" .$catID ."' name='" .$cat ."'>" . $cat . "</button>";
        echo "</div>";
    }

    echo "</div>";

    /*Build Location Menu*/
    $getLocation = $conn->prepare("select locationName, locationID from locationTbl");
    $getLocation->execute();
    $getLocation->store_result();
    $getLocation->bind_result($loc, $locID);

    echo "<div id='selectLocationWrapper' data-role='collapsible' class='ui-block-b ui-content'> <h3>Locations</h3>";

    while ($getLocation->fetch()) {
        echo "<div id='". $locID ."' class='button'><button class='button selBtn' id='" . $locID . "' name='" . $loc . "'>" . $loc . "</button></div>";
    }
    echo "</div>
        <div class='ui-block-c'><h3>back button</h3></div>
        <div class='ui-block-d'><h3>add item</h3></div>
        </div>";


    echo "<div id='countWrap' data-role='main' style='height:100%'><div id='countArea'>";
    echo "<h3>".$_SESSION['category'] . ":" . $_SESSION['location'] . "</h3>>";
    $columnCount = 0;
    $count = 0;

    /*    Get Items to search with*/
    $getItems = $conn->prepare("select a.itemName, a.flavor, a.category, a.itemNum from itemTbl as a left join categoryTbl as b on a.category = b.categoryID where a.category = ? order by a.itemName, a.flavor");
    $getItems->bind_param("s", $_SESSION['categoryID']);
    $getItems->execute();
    $getItems->store_result();
    $getItems->bind_result($itemName, $flavor, $category, $itemNum);

    while ($getItems->fetch()) {

        echo "<div id='itemWrap' data-role='page' class='itemFloat itemFlexContainer'>";
        include("itemTable.php");
        echo "</div>";
        $count++;
        $columnCount = 0;
    }

    echo "</div></div><div data-role='footer' data-position='fixed'><a href='initializeCount.php'>".$count ."</a></div>
        </div>";



    ?>





<script>
    $(document).ready(function () {
        $('#selectCategoryWrapper').on("click", "button", function () {
            var changeData = {
                "categoryID": $(this).attr('id'),
                "category": $(this).text(),
                "changeCategory": true
            };
            console.log(changeData);
            var changecat = $.post('../inc/cfgGlobal.php', changeData);
            changecat.done(function (data) {
                console.log("category changed:  " + data);
                $('#countWrap').html("<h1>Loading Items...</h1>");
                $('#countWrap').load("items.php #countArea");
                $('#footer').load("items.php #footer");
            });
            changecat.fail(function (data) {
                console.log("category not changed:  " + data);
            });
            console.log("category menu button pressed: " + $(this).attr('id') + " : " + $(this).text());
            /*$('#selectCategoryWrapper').addClass('ui-collapsible-collapsed');*/

        });
        $('#selectLocationWrapper').on("click", "button", function () {
            var changeData = {
                "locationID": $(this).attr('id'),
                "location": $(this).text(),
                "changeLocation": true
            };
            console.log(changeData);
            var changeLoc = $.post('../inc/cfgGlobal.php', changeData);
            changeLoc.done(function (data) {
                console.log("location changed:  " + data);
                $('#countWrap').html("<h1>Loading Items...</h1>");
                $('#countWrap').load("items.php #countArea");
            });
            changeLoc.fail(function (data) {
                console.log("location not changed:  " + data);
            });
            console.log("location menu button pressed: " + $(this).attr('id') + " : " + $(this).text());

        });

    });

</script>

</body>

</html>