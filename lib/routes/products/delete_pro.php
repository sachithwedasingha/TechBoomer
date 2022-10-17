<?php
// include function page(productFunction.php)

include_once('../../function/productFunction.php');

$proObj = new Product();

$result = $proObj->delete_pro($_GET['uid']);

echo($result);

?>