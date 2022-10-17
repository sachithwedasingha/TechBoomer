<?php

//include function
include_once('../../function/orderFunction.php');

$proObj = new Order();

$result = $proObj -> offlinepaymentserch($_GET['searchData']);

echo($result);

?>