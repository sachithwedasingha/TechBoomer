<?php

//include function
include_once('../../function/productFunction.php');

$proObj = new Product();

$result = $proObj -> productSearch($_GET['searchData']);

echo($result);

?>