<?php

//include function
include_once('../../function/productFunction.php');

$empObj = new Product();

$result = $empObj -> proSearch($_GET['searchData']);

echo($result);

?>