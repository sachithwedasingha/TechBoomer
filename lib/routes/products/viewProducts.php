<?php

//include function page 
include_once('../../function/productFunction.php');

//call the class and create an object 
$proObj = new Product();

$result = $proObj -> ViewAllproduct();

echo($result);


?>