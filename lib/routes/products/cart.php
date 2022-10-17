<?php

//include function page 
include_once('../../function/cartFunction.php');

//call the class and create an object 
$emp = new cart();

$result = $emp -> ViewCartItems();

echo($result);


?>