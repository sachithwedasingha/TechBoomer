<?php

//include function
include_once('../../function/order_serviceFunction.php');

$proObj = new SOrder();

$result = $proObj -> deliverlist_serch($_GET['searchData']);

echo($result);

?>