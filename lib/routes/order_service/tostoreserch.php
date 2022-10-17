<?php

//include function
include_once('../../function/order_serviceFunction.php');

$proObj = new SOrder();

$result = $proObj -> tostoreserch($_GET['searchData']);

echo($result);

?>