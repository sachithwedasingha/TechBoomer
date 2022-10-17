<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> deliverlist_serch($_GET['searchData']);

echo($result);

?>