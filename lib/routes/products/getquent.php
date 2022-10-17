<?php

//include function
include_once('../../function/productFunction.php');

$proObj = new Product();

$result = $proObj -> count($_GET['pid']);

echo($result);

?>