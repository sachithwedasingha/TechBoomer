<?php

//include function page 
include_once('../../function/invoiceFunction.php');

//call the class and create an object 
$invObj = new invoice();

$result = $invObj -> tcount($_GET['month']);

echo($result);


?>