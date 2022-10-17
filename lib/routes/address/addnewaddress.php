<?php
// include function page(userFunction.php)

include_once('../../function/orderFunction.php');

$orderObj = new Order();

$result = $orderObj->addaddressdata($_POST['userid'],$_POST['name'],$_POST['number'],$_POST['lane'],$_POST['town'],$_POST['dis']);

echo($result);

?>