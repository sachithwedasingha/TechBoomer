<?php

//include function page 
include_once('../../function/productFunction.php');

//call the class and create an object 
$serObj = new Product();

$result = $serObj -> editdata($_GET['id'],$_GET['un'],$_GET['de'],$_GET['ca'],$_GET['pc']);


echo($result);


?>