<?php

//include function page 
include_once('../../function/productFunction.php');

//call the class and create an object 
$userObj = new Product();

$result = $userObj -> proList();

echo($result);


?>