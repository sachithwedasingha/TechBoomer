<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> tostoreserch($_GET['searchData']);

echo($result);

?>