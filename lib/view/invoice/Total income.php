<?php
//star the session
session_start();
//chek its logd in?
if(empty($_SESSION['user_id'])){
  header('location:login.php');
}
  
else{}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Link css and script file -->
    <link rel="stylesheet" href="../../../css/bootstrap.2min.css">
    <!--Link Bootstrap css file-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <!--Link Font awesome css file-->
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/all.min.css">
    <script src="../../../js/all.min.js"></script>
    <script src="../../../js/jquery.js"></script>
    <style>
    @media print {
        .no-print,
        .no-print,
        #gradient,
        #steps-uid-0-p-3 * {
            display: none !important;
        }
        #date,
        #date * {
            display: none !important;
        }
        #sidenav,
        #sidenav * {
            display: none !important;
        }
    }
    table, th, td {
  border: 1px solid;
}
</style>
</head>

</html>
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../../upload/invoice/head.jpg" alt="">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">Total Income</h2>
    <div class="row"><div class="col-3"><h6>Service Number:</h6></div><div class="col-3"><h6 id="id"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    
     

    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        <tr>
            <th>Service Type</th>
            <th>Order Count</th>
            <th>Total Income (LKR)</th>
        </tr>
        <tbody id="mesh_list">
        <tr>
            <td>sele products</td>
            <td id="pcount"></td>
            <td id="ptot"></td>
        </tr>
        <tr>
            <td>sele Service</td>
            <td id="scount"></td>
            <td id="stot"></td>
        </tr>
        <tr>
            <th>Total </th>
            <th id="catot"></th>
            <th id="patot"></th>
        </tr> 
        </tbody>
    </table>
    <br><br><br><br>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <h6>...................................................</h6>
            <h6> Signature</h6>
            <br><br><br>
        </div>
    </div>
</div>
<div class="no-print">
<button type="button" class="btn btn-secondary my-3 mx-5 px-5" onclick="history.back()"><i class="fas fa-arrow-left"></i>   Back</button>
<button type="button" class="btn btn-success my-3 px-5" onclick="window.print();"><i class="fas fa-print"></i>   Print</button>
</div>
<script>
$(document).ready(function(){
    $id=Math.floor((Math.random() * 100) + 1);
    //make id
        $('#id').text("INV00"+$id);
//get date
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
//set date
        $('#date').text(date);

       
//get counts and totels
$.get("../../routes/invoice/getscount.php", function (res) {
      //display data 
      $("#scount").html(res);
      
});

$.get("../../routes/invoice/getpcount.php", function (res) {
      //display data 
      $("#pcount").html(res);
      
});

$.get("../../routes/invoice/getstot.php", function (res) {
      //display data 
      $("#stot").html(res);
      

$.get("../../routes/invoice/getptot.php", function (res) {
      //display data 
      $("#ptot").html(res);
      
});

$("#catot").html(parseInt($('#pcount').text()) + parseInt($('#scount').text()));


$.get("../../routes/invoice/getftot.php", function (res) {
      //display data 
      $("#patot").html(res);
      
});




     })
    })

</script> 