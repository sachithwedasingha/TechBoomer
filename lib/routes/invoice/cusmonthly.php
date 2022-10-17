<?php

//include function page 
include_once('../../function/invoiceFunction.php');

//call the class and create an object 
$serObj = new invoice();

$result = $serObj -> cusmonthly($_GET['start'],$_GET['end']);

echo($result);


?>