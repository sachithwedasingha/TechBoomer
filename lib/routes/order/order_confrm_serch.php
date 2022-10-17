<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> conformorderlist_serch($_GET['searchData']);

echo($result);

?>