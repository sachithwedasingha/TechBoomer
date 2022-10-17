<?php

//include function page 
include_once('../../function/productFunction.php');

//Get product Details 

$productImageName = $_FILES['productImg']['name'];
$productImageSize = $_FILES['productImg']['size'];
$productImageType = $_FILES['productImg']['type'];
$productImageLocation = $_FILES['productImg']['tmp_name'];

//call the class and create an object 
$prdObj = new Product();

$result = $prdObj -> addProduct($_POST['productName'],$_POST['productDetails'],$_POST['productCategory'],$_POST['productPrice'],$_POST['productQuantity'],$_POST['productSection'],$_POST['productRow'],$_POST['productColume'],$_POST['productLevel'],$_POST['productQuantityWH'],$productImageName,$productImageSize,$productImageType,$productImageLocation);


echo($result);


?>