<?php

//include function page 
include_once('../../function/order_serviceFunction.php');

//call the class and create an object 
$userObj = new SOrder();

$result = $userObj -> offlinepayment();

echo($result);


?>