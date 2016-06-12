<?php
$db = new DB();
$oldCount = 0;
$currCount = $db->getCount($_SESSION['currDate'], $itemNum);
$oldCount = $db->getCount($_SESSION['oldDate'], $itemNum);
$received = $db->getReceived($_SESSION['currDate'], $itemNum);



$starting = $oldCount + $received;
$used = $starting - $currCount;
$currLocation1 = 0;
$oldLocation1 = 0;
$currLocation2 = 0;
$oldLocation2 = 0;
$currLocation3 = 0;
$oldLocation3 = 0;
$currLocation4 = 0;
$oldLocation4 = 0;
?>

<div id='itemArea <?php echo $itemNum; ?>' data-role='header' data-position="fixed" style='height:45px;'>
    <div class='itemName '><?php echo $itemName . " " . $flavor; ?></div>
</div>

<div id='enterArea<?php echo $itemNum; ?>' data-role='main' style='height:auto; padding-right:2px;'>
    <input id='<?php echo $itemNum; ?>' type='tel' name='sendCount'
           placeholder='<?php echo  $currCount ?>'>
    <label for='<?php echo $itemNum; ?>' class='ui-hidden-accessible'>Enter Count</label>
</div>

<div id='infoArea<?php echo $itemNum; ?>' class='ui-grid-b' data-role='footer' style="height:30px; padding-top:10px;">
    <a href='#' class='ui-block-a ui-btn ui-corner-all height40px'>
        Loc Count
    </a>
    <a href='#' class='ui-block-b ui-corner-all ui-btn height40px'>
        <?php echo $starting; ?>
    </a>
    <a href='#' class='ui-block-c ui-corner-all ui-btn height40px'>
        Repeat Count
    </a>
</div>
    



