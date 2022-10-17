<?php

//include function page 
include_once('../../function/order_serviceFunction.php');

//call the class and create an object 
$serObj = new SOrder();

$result = $serObj -> deleteorder($_GET['oid']);


echo($result);


?>