<?php

include ("connect.php");

?>

<html>

<head>
<title>theClipboard</title>
<link href="inc/stylesheet.css" rel="stylesheet" type="text/css" />

</head>

<body>
<p>LINKS TO LIVE SERVER</p>
<form action="">
    <input type="button" value="COUNT" onclick="window.location.href='enterCount';"/>
    <input type="button" value="RECEIVE" onclick="window.location.href='receiveInventory';"/>
    <input type="button" value="REPORT" onclick="window.location.href='reports';"/>
    <input type="button" value="Add/UPDATE" onclick="window.location.href='addItem';"/>
</form>
<p>LINKS TO TESTING SERVER</p>
<form action="">
    <input type="button" value="Enter Counts" onclick="window.location.href='enterCount';"/>
    <input type="button" value="Enter Receiving" onclick="window.location.href='receiveInventory';"/>
    <input type="button" value="Inventory Reports" onclick="window.location.href='reports';"/>
</form>

</body>




</html>