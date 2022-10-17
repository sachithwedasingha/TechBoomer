<?php
// include function page(userFunction.php)

include_once('../../function/orderFunction.php');

$orderObj = new Order();

$result = $orderObj->makeserviceoff($_POST['tempid'],$_POST['userid'],$_POST['date'],$_POST['address'],$_POST['serviceid'],$_POST['designid'],$_POST['unitprice'],$_POST['width'],$_POST['height'],$_POST['total']);

echo($result);

?>