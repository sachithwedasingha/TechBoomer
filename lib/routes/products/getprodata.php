<?php

//include function page 
include_once('../../function/productFunction.php');

//call the class and create an object 
$serObj = new Product();

$result = $serObj -> prodata($_GET['uid']);


echo($result);


?>