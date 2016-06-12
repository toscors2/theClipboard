<?php

include ("connect.php");

$sql = "select * from categoryTbl";
$res = mysqli_query($conn, $sql);

$sql2 = "select * from supplierTbl";
$res2 = mysqli_query($conn, $sql2);

$sql3 = "select * from bottleSizes";
$res3 = mysqli_query($conn, $sql3);

function category($results)
{    echo "<label for='category'>Select Category:  </label><select id='category' input type='text' name ='category'>";
    foreach ($results as $category) {
        echo "<option value='" . $category['categoryID'] . "'>" . $category['categoryName'] .
            "</option>";
    }
    echo "</select>";

}

function supplier($results2)
{
    echo "<label for='supplier'>Select Supplier:  </label><select id='supplier' input type='text' name ='supplier'>";
    foreach ($results2 as $supplier) {
        echo "<option value='" . $supplier['supplierID'] . "'>" . $supplier['supplierName'] .
            "</option>";
    }
    echo "</select>";

}

function size($results3)
{
    echo "<label for='size'>Select Package Size:  </label><select id='size' input type='text' name ='size'>";
    foreach ($results3 as $size) {
        echo "<option value='" . $size['sizeID'] . "'>" . $size['size'] .
            "</option>";
    }
    echo "</select>";

}

?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />

	<title>Untitled 3</title>
</head>

<body>

<?php

#var_dump($res);
#echo "  category<br />";
#var_dump($res2);
#echo "  supplier<br />";
#var_dump($res3);
#echo "  bottleSizes<br />";

?>

<table><form name='addItem' method='POST' action='addItem.php'>
<tr><td><label for='itemNum'>Item Number:  </label><input type='text' name='itemNum'></input></td></tr>
<tr><td><label for='itemName'>Item Name:  </label><input type='text' name='itemName'></input></td></tr>
<tr><td><label for='flavor'>Flavor:  </label><input type='text' name='flavor'></input></td></tr>
<tr><td><label for='pack'>Pack Quantity:  </label><input type='text' name ='pack'></input></td></tr>
<tr><td><?php category($res); ?></td></tr>
<tr><td><?php size($res3); ?></td></tr>
<tr><td><?php supplier($res2); ?></td></tr>
<tr><td><input type='submit' name='submit' value='submit'</td></tr>
</form>
</table>

</body>
</html>