<?php

//include function page 
include_once('../../function/orderFunction.php');

//call the class and create an object 
$serObj = new Order();

$result = $serObj -> declareorder($_GET['oid']);


echo($result);


?>