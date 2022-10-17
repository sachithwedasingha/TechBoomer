<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> Searchorderlistdelivery($_GET['searchData']);

echo($result);

?>