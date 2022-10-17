<?php

//include function page 
include_once('../../function/orderFunction.php');

//call the class and create an object 
$addObj = new Order();

$result = $addObj -> getaddress($_GET['uid']);


echo($result);


?>