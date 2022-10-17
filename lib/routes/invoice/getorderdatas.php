<?php

//include function page 
include_once('../../function/invoiceFunction.php');

//call the class and create an object 
$serObj = new invoice();

$result = $serObj -> orderdatas($_GET['searchData']);

echo($result);


?>