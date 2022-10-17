$(document).ready(function(){
    //send an ajax request at loading products for sell
    $.get("lib/routes/products/viewProducts.php", function (res) {
      //display data 
      $("#products").html(res);
    })
       
    
    //search items 
    $("#searchData").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("lib/routes/products/productSearch.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect1").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect2").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect3").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect4").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect5").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect6").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect7").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })

    $("#catselect8").on('click', function () {
      $inputData = $(this).text();

            //send an ajax request 
            $.get("lib/routes/products/productSearchcat.php",{searchData:$inputData},function(res){
                $("#products").html(res);
            })
    })
})
