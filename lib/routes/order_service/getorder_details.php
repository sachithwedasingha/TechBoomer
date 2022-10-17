<?php

//include function page 
include_once('../../function/orderFunction.php');

//call the class and create an object 
$serObj = new Order();

$result = $serObj -> orderdata($_GET['sid']);


echo($result);


?>