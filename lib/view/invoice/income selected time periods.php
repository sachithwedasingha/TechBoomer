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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
<div class="container">
<div class="no-print">
        <div class="col-7 border my-2">
        <div class="form-group row">
                <div class="col-4 py-3 px-4">
                    <label>Enter start and end date</label>
                </div>
                <div class="col-4 py-3">
                <input class="form-control" type="text" name="daterange" />
                </div>
                <div class="col-2 px-4 py-2">
                    <button type="button" class="btn btn-success" id="genarate">Genarate</button>
                </div>
            </div>
        </div>
</div>
</div>
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../../upload/invoice/head.jpg" alt="">
    </div>
    <hr style="height: 6px; text-color: black;">
    <h2 class="py-3" style="text-align:center">Custom Genareted Report-Service</h2>
    <div class="row"><div class="col-3"><h6>Invoice Id:</h6></div><div class="col-3"><h6 id="id"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Type:</h6></div><div class="col-3"><h6></h6>Sell Service</div></div>
    <div class="row"><div class="col-3"><h6>Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Started Date:</h6></div><div class="col-3"><h6 id="sdate"></h6></div></div>
    <div class="row"><div class="col-3"><h6>End date:</h6></div><div class="col-3"><h6 id="edate"></h6></div></div>
    
     

    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        <tr>
            <th>Order Id</th>
            <th>date</th>
            <th>Total (LKR)</th>
        </tr>
        <tbody id="mesh_list">
        
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

$(document).ready(function() {

let start_date = '';
let end_date = '';

$(function() {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        start_date = start.format('YYYY-MM-DD');
        end_date = end.format('YYYY-MM-DD');

    });

    $('#genarate').click(function (e) {

        $id=Math.floor((Math.random() * 100) + 1);
    //make id
    $('#sdate').text(start_date);
    $('#edate').text(end_date);
        $('#id').text("INV00"+$id);
//get date
        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
//set date
        $('#date').text(date);

        $.get("../../routes/invoice/cusmonthlys.php",{start:start_date,end:end_date}, function (res) {
                //display data 
                $("#mesh_list").html(res);
        })
    })
});
})
// $(document).ready(function(){
//     $id=Math.floor((Math.random() * 100) + 1);
//     //make id
//         $('#id').text("INV00"+$id);
// //get date
//         var today = new Date();
//         var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
// //set date
//         $('#date').text(date);

       
// //get counts and totels
// $.get("../../routes/invoice/getscount.php", function (res) {
//       //display data 
//       $("#scount").html(res);
      
// });

// $.get("../../routes/invoice/getpcount.php", function (res) {
//       //display data 
//       $("#pcount").html(res);
      
// });

// $.get("../../routes/invoice/getstot.php", function (res) {
//       //display data 
//       $("#stot").html(res);
      

// $.get("../../routes/invoice/getptot.php", function (res) {
//       //display data 
//       $("#ptot").html(res);
      
// });

// $("#catot").html(parseInt($('#pcount').text()) + parseInt($('#scount').text()));


// $.get("../../routes/invoice/getftot.php", function (res) {
//       //display data 
//       $("#patot").html(res);
      
// });




//      })
//     })

</script> 