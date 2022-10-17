<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> Searchorderlist($_GET['searchData']);

echo($result);

?>