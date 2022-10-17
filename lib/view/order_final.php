<?php
//star the session
session_start();
//chek its logd in?
if(empty($_SESSION['user_id'])){
  header('location:login.php');
}
include_once('../layout/app.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

    <title class='no-print'>add Your Adderss and pay</title>
</head>

<body >
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 pt-5" id="Oder_page_content">

                <!-- load content to this page -->

            </div>
            <div class="no-print">
            <div class="form-group px-5 py-2">
                <button type="" class="btn btn-secondary" style="align:right" id="back1">Back</button>
                <!-- <button type="" class="btn btn-secondary" style="align:right" id="back2">Back</button> -->
                <button type="" class="btn btn-success disabled" style="align:right" id="next1">Confirm Delivey
                    Details</button>
                <button type="" class="btn btn-success disabled" id="next2">chekout</button>
                <button type="" class="btn btn-success" id="next4">chekout</button>
                <button type="" class="btn btn-success noprint"  id="next3">back to Shoppimg</button>

            </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    </div>
</body>
<script>
    //first view address line input
    $(document).ready(function () {
        $('#Oder_page_content').load('order/address.php');
        $('#next2').hide();
        $('#next3').hide();
        $('#next4').hide();
        $('#back2').hide();
       
        //back to cart
        $('#back1').click(function () {
            window.location.href = 'cart.php';
        });


        //load payment page
        $("#next1").click(function () {
            //address form data send to localstorage

            var item = {
                addname: $("#address_Name").val(),
                addnumber: $("#address_Number").val(),
                addlane: $("#address_Lane").val(),
                addtown: $("#address_Town").val(),
                adddis: $("#address_Dis").val(),
            }

            if (localStorage.getItem('address') === null) {
                //careate java script array
                var address = [];
                //push data to array
                address.push(item);
                //set the locsl storage
                localStorage.setItem('address', JSON.stringify(address));

                sendaddress();

            } else {
                //remover address local storage
                localStorage.removeItem("address");
                //careate java script array
                var address = [];
                //push data to array
                address.push(item);
                //set the locsl storage
                localStorage.setItem('address', JSON.stringify(address));

                sendaddress();
            }

            function sendaddress() {

                var order = JSON.parse(localStorage.getItem('order'));
                var userid = order[0].userid;
                var addname = $("#address_Name").val();
                var addnumber = $("#address_Number").val();
                var addlane = $("#address_Lane").val();
                var addtown = $("#address_Town").val();
                var adddis = $("#address_Dis").val();

                $.post("../routes/address/addnewaddress.php", {
                        userid: userid,
                        name: addname,
                        number: addnumber,
                        lane: addlane,
                        town: addtown,
                        dis: adddis,
                    },
                    function (data) {
                        // alert(data);
                    })
            }

            //popup payment pethord
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-success',
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Select Payment Methord',
                showCancelButton: true,
                confirmButtonText: 'online Payment',
                cancelButtonText: 'Offline Payment',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#Oder_page_content').load('payment/on_payment.php');
                    $('#back1').hide();
                    $('#back2').show();
                    $('#next1').hide();
                    $('#next2').show();
                    $('#next3').hide();
                    $('#next4').hide();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {

                    $('#Oder_page_content').load('payment/off_payment.php');
                    $('#back1').hide();
                    $('#back2').show();
                    $('#next1').hide();
                    $('#next3').hide();
                    $('#next4').show();
                    $('#next3').hide();


                }
            })
        });

        //load final page for online payment
        $("#next2").click(function () {

            $('#next1').hide();
            $('#next3').show();
            $('#next2').hide();

            sendOrderData();
            makeorder();
            // $('#Oder_page_content').load('invoice/invoive_bill_online.php.');
            function sendOrderData() {


                var address = JSON.parse(localStorage.getItem('address'));
                var order = JSON.parse(localStorage.getItem('order'));
                var cart = JSON.parse(localStorage.getItem('cart'));
                var tempid = Math.floor(Math.random() * (1000 - 1 + 1) + 1);

                for (var i = 0; i < cart.length; i++) {

                    var item = {
                        tempid: tempid,
                        userid: order[0].userid,
                        total: order[0].total,
                        productid: cart[i].productid,
                        productcount: cart[i].productcount,
                        address: address[0].addname + ', ' + address[0].addnumber + ', ' + address[
                            0].addlane + ', ' + address[0].addtown + ', ' + address[0].adddis,
                    };

                    if (localStorage.getItem('forder') === null) {
                        //careate java script array
                        var forder = [];
                        //push data to array
                        forder.push(item);
                        //set the locsl storage
                        localStorage.setItem('forder', JSON.stringify(forder));
                    } else {
                        var forder = JSON.parse(localStorage.getItem('forder'));
                        for (var i = 0; i < forder.length; i++) {
                            var proid_demo = forder[i].productid;

                            if (proid_demo === item.productid) {
                                forder.splice(i, 1);
                            }
                        }
                        forder.push(item);
                        //Re-set localstorage
                        localStorage.setItem('forder', JSON.stringify(forder));
                    }
                }
            }

            function makeorder() {

                var today = new Date();
                var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                var forder = JSON.parse(localStorage.getItem('forder'));
                for (var i = 0; i < forder.length; i++) {

                    var tempid = forder[i].tempid;
                    var userid = forder[i].userid;
                    var total = forder[i].total;
                    var productid = forder[i].productid;
                    var productcount = forder[i].productcount;
                    var address = forder[i].address;

                    //send ajax request
                    $.post("../routes/order/makeorder.php", {
                            tempid: tempid,
                            date: date,
                            userid: userid,
                            total: total,
                            productid: productid,
                            productcount: productcount,
                            address: address,

                        },
                        function (data) {
                            localStorage.setItem('orderido', data);
                            // setInterval(function(){
                            //                invoiceon(data);
                            //            },3000);         
                            invoiceon();
                            // alert(data);
                        })
                }
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your Order has been Placed',
                    showConfirmButton: false,
                    timer: 1500
                    })
                    
            }

        });


               //load final page for offline payment
               $("#next4").click(function () {

                        $('#next1').hide();
                        $('#next3').show();
                        $('#next2').hide();
                        $('#next4').hide();

                        sendOrderData();
                        makeorderoff();
                        
                        function sendOrderData() {


                            var address = JSON.parse(localStorage.getItem('address'));
                            var order = JSON.parse(localStorage.getItem('order'));
                            var cart = JSON.parse(localStorage.getItem('cart'));
                            var tempid = Math.floor(Math.random() * (1000 - 1 + 1) + 1);

                            for (var i = 0; i < cart.length; i++) {

                                var item = {
                                    tempid: tempid,
                                    userid: order[0].userid,
                                    total: order[0].total,
                                    productid: cart[i].productid,
                                    productcount: cart[i].productcount,
                                    address: address[0].addname + ', ' + address[0].addnumber + ', ' + address[
                                        0].addlane + ', ' + address[0].addtown + ', ' + address[0].adddis,
                                };

                                if (localStorage.getItem('forder') === null) {
                                    //careate java script array
                                    var forder = [];
                                    //push data to array
                                    forder.push(item);
                                    //set the locsl storage
                                    localStorage.setItem('forder', JSON.stringify(forder));
                                } else {
                                    var forder = JSON.parse(localStorage.getItem('forder'));
                                    for (var i = 0; i < forder.length; i++) {
                                        var proid_demo = forder[i].productid;

                                        if (proid_demo === item.productid) {
                                            forder.splice(i, 1);
                                        }
                                    }
                                    forder.push(item);
                                    //Re-set localstorage
                                    localStorage.setItem('forder', JSON.stringify(forder));
                                }
                            }
                        }

                        function makeorderoff() {

                            var today = new Date();
                            var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                            var forder = JSON.parse(localStorage.getItem('forder'));
                            for (var i = 0; i < forder.length; i++) {

                                var tempid = forder[i].tempid;
                                var userid = forder[i].userid;
                                var total = forder[i].total;
                                var productid = forder[i].productid;
                                var productcount = forder[i].productcount;
                                var address = forder[i].address;

                                //send ajax request
                                $.post("../routes/order/makeorderoff.php", {
                                        tempid: tempid,
                                        date: date,
                                        userid: userid,
                                        total: total,
                                        productid: productid,
                                        productcount: productcount,
                                        address: address,

                                    },
                                    function (data) {
                                    localStorage.setItem('orderid', data);
                                    invoiceoff();
                                        // alert(data);
                                    });
                                    
                            }
                            
                                Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your Order has been Placed',
                                showConfirmButton: false,
                                timer: 1500
                                });
                                

        
}

});


        $("#back2").click(function () {
            location.reload();

        });

        //place order and reload to home
        $("#next3").click(function () {
                            localStorage.removeItem('forder');
                            localStorage.removeItem('cart');
                            localStorage.removeItem('address');
                            localStorage.removeItem('order');
                            localStorage.removeItem('orderid');
                            localStorage.removeItem('orderido');

            window.location.href = '../../index.php';
        });

        function invoiceoff(){

            $('#Oder_page_content').load('invoice/oinvoive_bill_offline.php');
         }

         function invoiceon(){
            $('#Oder_page_content').load('invoice/invoive_bill_online.php');
         }

    });

    function myFunction() {
  var checkBox = document.getElementById("flexCheckDefault");
  $("#next1").attr('class', "btn btn-success disabled");
  if (checkBox.checked == true){
    $("#next1").attr('class', "btn btn-success");
    
  } else {
     
  }
}
</script>

</html>