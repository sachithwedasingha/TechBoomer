<?php

//include function page 
include_once('../../function/orderFunction.php');

//call the class and create an object 
$userObj = new Order();

$result = $userObj -> showorderlistdelivery();

echo($result);


?>