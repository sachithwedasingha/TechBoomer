<?php
// include function page(userFunction.php)

include_once('../../function/orderFunction.php');

$orderObj = new Order();

$result = $orderObj->makeorderoff($_POST['tempid'],$_POST['date'],$_POST['userid'],$_POST['total'],$_POST['productid'],$_POST['productcount'],$_POST['address']);

echo($result);

?>