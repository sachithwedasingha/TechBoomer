<?php
//star the session
session_start();
//chek its logd in?
if(empty($_SESSION['user_id'])){
  header('location:login.php');
}
  
else{}

include_once('../layout/top Nav_design.php');
include_once('../layout/app.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Your Orders</title>
  <style>
    /* #list{
     
   
   overflow-y:scroll;
   height:70vh;  
    }

    #details{
      position: fixed;
      margin-left:225px;
    } */
  </style>
  
</head>

</body>
<input class="form-control mx-1 my-1" type="hidden" value="<?php
                                        //chek the user session
                                      if(empty($_SESSION['user_id'])){}

                                      else{print_r($_SESSION['user_id']);}?>" id="input_user_id">
 <input class="form-control mx-1 my-1" type="hidden" value="" id="orderid">
  <input class="form-control mx-1 my-1" type="hidden" value="" id="deliveryid">
<div class="container-fluid" style="display: flex; flex-direction: row;">
  
    <div class="col-2 px-2 py-2" style="border-Right: 3px solid red;    height:590px;   display: block; overflow-y: scroll; " id="list">

    </div>
    <div class="col-10 px-2" style=" display: block;    height: 590px; overflow-y: scroll;" id="details">
      
     

      <div class="card border-secondary mb-3 mt-2" id="empty" style="max-width: 70rem; max-height: 200rem;">
        <div class="card-body">
          <img src="../upload/ui/01.png" width="200px" style="display: block; margin-left: auto; margin-right: auto; margin-top:100px; margin-bottom:20px;" alt="">
          <h4 class="card-title" style="text-align:center;  margin-bottom:100px;">Select order to get more Details</h4>
        </div>
      </div>

     
      <div class="card border-secondary mb-3 mt-2" id="notempty" style="max-width: 70rem; max-height: 200rem;">
        <div class="card-body">
          <h4 class="card-title">Order Details</h4>
          <h6>Delivery Details</h6>
          <hr>
          <div class="col-7" di="orderdelivery">
            <div class="row">
              <div class="col-2">
                <div class=" card border-secondary " id="01"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-check fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Place Order</p>
              </div>
              <div class="col-2">
                <div class=" card border-secondary" id="02"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-hand-holding-usd fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Payment</p>
              </div>
              <div class="col-2">
                <div class=" card border-secondary" id="03"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-clipboard-check fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Order Accepted</p>
              </div>
              <div class="col-2">
                <div class=" card border-secondary" id="04"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-store fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Stors</p>
              </div>
              <div class="col-2">
                <div class=" card border-secondary" id="05"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-truck fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Transport</p>
              </div>
              <div class="col-2">
                <div class=" card border-secondary" id="06"
                  style="text-align: center; width:80; height:80; border-radius: 100%">
                  <i class="fas fa-truck-loading fa-2x my-4 mx-4"></i>
                </div>
                <p class="mx-1">Deliverd</p>
              </div>
            </div>
          </div>
          <div class="row">
            <hr>
            <div class="col-4">
              <p>Order Items</p>
              <div id="order_items">

                <div class="row">
                  <div class="col-2">
                    <img src="" alt="">
                  </div>
                  <div class="col-5">
                    <p></p>
                  </div>
                  <div class="col5">

                  </div>
                </div>

              </div>
            </div>

            <div class="col-3">
              <p>Order Date</p>
              <P id="orderdate"></P>
            </div>

            <div class="col-3">
              <p>Delivery Address</p>
              <p id="address"></p>
            </div>

            <div class="col-2">
              <p>Price</p>
              <h5 id="price"></h5>
              <h5>LKR</h5>
            </div>
            
          </div>
          <div class="row">
            <div class="col-2">
            <button type="button" id="delete_btn" class="btn btn-danger" >Cancel Order</button>
            </div>
         <div class="col-10">
           <p style="color:red;">
             * Only you can cancel the order befo order accept by the company
           </p>
         </div>
          </div>
         
        </div>
      </div>
    </div>

</div>

</html>

<script>
  //first time page load open order details
  $("#order").attr('style', " color: Red;");
  showdata();
  listorder();

    
  $('#service').click(function () 
  {
    $("#service").attr('style', " color: Red;");
    $("#order").attr('style', "");
    $("#design").attr('style', "");
    $("#orderid").val("");
    showdataservice();
    listservice();
  });

 $('#design').click(function () 
  {
    $("#design").attr('style', " color: Red;");
    $("#order").attr('style', "");
    $("#service").attr('style', "");
    $("#orderid").val("");
    showdatadesign();
  });

  $('#order').click(function () 
  {
    $("#order").attr('style', " color: Red;");
    $("#design").attr('style', "");
    $("#service").attr('style', "");
    $("#orderid").val("");
    showdata();
    listorder();

  });


//show order list
  function listorder(){
  //user accunt handeling
  $userid = $("#input_user_id").val();

  //load order list to list area
  $.get("../routes/order/getorder_data.php", {
    sid: $userid
  }, function (res) {
    $("#list").html(res);
  })
  }

  //show setvice list
  function listservice(){
  //user accunt handeling
  $userid = $("#input_user_id").val();

  //load order list to list area
  $.get("../routes/order/getservice_data.php", {
    sid: $userid
  }, function (res) {
    $("#list").html(res);
  })
  }

  //load more details about order
  function moredetails(orderid) {
    $("#orderid").val(orderid);
    $orderid = orderid;

    //show order products to detail sheet.
    $.get("../routes/order/getproductlist.php", {
      iid: $orderid
    }, function (res3) {
      $("#order_items").html(res3);
    })

    showdata();
  }

  //load more detaila about servicers
  function moredetailsservice(osid) {
    $("#orderid").val(osid);
    $orderid = osid;

    //show order products to detail sheet.
    $.get("../routes/order/getmeshlist.php", {
      iid: $orderid
    }, function (res3) {
      $("#order_items").html(res3);
    })

    showdataservice();
  }

  //if not select the order desable detail panel
  function showdata() {
    $("#01").attr('class', " card border-secondary");
    $("#02").attr('class', " card border-secondary");
    $("#03").attr('class', " card border-secondary");
    $("#04").attr('class', " card border-secondary");
    $("#05").attr('class', " card border-secondary");
    $("#06").attr('class', " card border-secondary");

    if ($("#orderid").val() === "") {
      $('#empty').show();
      $('#emptyser').hide();
      $('#emptydes').hide();
      $('#notempty').hide();
    } else {
      $('#empty').hide();
      $('#emptyser').hide();
      $('#emptydes').hide();
      $('#notempty').show();
      //anable detail panel and get data from back end

      //load order list to list area
      $.get("../routes/order/getorder_details.php", {
        sid: $orderid
      }, function (res) {
        var jdata = jQuery.parseJSON(res);

        $("#orderdate").text(jdata.order_date);
        $("#address").text(jdata.address);
        $("#price").text(jdata.order_price);
        $("#deliveryid").val(jdata.dilevery_Id);
        $("#delete_btn").attr('onclick',"deleteorder(\'"+jdata.order_Id+"\')");


        $.get("../routes/order/getdelivery_details.php", {
          did: jdata.dilevery_Id
        }, function (res1) {
          var jdata1 = jQuery.parseJSON(res1);
          

          if (jdata1.order_done == 1) {
            $("#01").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger");
          };
          if (jdata1.order_payment == 1) {
            $("#02").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };
          if (jdata1.order_conform == 1) {
            $("#delete_btn").attr('class',"btn btn-danger disabled");
            $("#03").attr('class', " card border-secondary bg-info");
          };
          if (jdata1.order_transport == 1) {
            $("#delete_btn").attr('class',"btn btn-danger disabled");
            $("#04").attr('class', " card border-secondary bg-info");
          };
          if (jdata1.order_deliverd == 1) {
            $("#delete_btn").attr('class',"btn btn-danger disabled");
            $("#05").attr('class', " card border-secondary bg-info");
          };
          if (jdata1.order_deliverd == 1) {
            $("#delete_btn").attr('class',"btn btn-danger disabled");
            $("#06").attr('class', " card border-secondary bg-info");
          };

        })
      })

    }
  }


  function showdataservice() {

    $("#01").attr('class', " card border-secondary");
    $("#02").attr('class', " card border-secondary");
    $("#03").attr('class', " card border-secondary");
    $("#04").attr('class', " card border-secondary");
    $("#05").attr('class', " card border-secondary");
    $("#06").attr('class', " card border-secondary");

    if ($("#orderid").val() === "") {
      $('#empty').hide();
      $('#emptydes').hide();
      $('#emptyser').show();
      $('#notempty').hide();
    } else {
      $('#empty').hide();
      $('#emptydes').hide();
      $('#emptyser').hide();
      $('#notempty').show();
      //anable detail panel and get data from back end

      //load order list to list area
      $.get("../routes/order/getservice_details.php", {
        osid: $orderid
      }, function (res3) {
        var jdata2 = jQuery.parseJSON(res3);

        $("#orderdate").text(jdata2.date);
        $("#address").text(jdata2.address);
        $("#price").text(jdata2.price);
        $("#deliveryid").val(jdata2.dilevery_Id);

        $.get("../routes/order/getservicedelivery_details.php", {
          did: jdata2.status_Id
        }, function (res4) {
          var jdata3 = jQuery.parseJSON(res4);

          if (jdata3.placed == 1) {
            $("#01").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger");
          };
          if (jdata3.payment == 1) {
            $("#02").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };
          if (jdata3.appruwed == 1) {
            $("#03").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };
          if (jdata3.stoers == 1) {
            $("#04").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };
          if (jdata3.proccess == 1) {
            $("#05").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };
          if (jdata3.deliverd == 1) {
            $("#06").attr('class', " card border-secondary bg-info");
            $("#delete_btn").attr('class',"btn btn-danger disabled");
          };

        })
      })

    }
  }

  function showdatadesign() {

$("#01").attr('class', " card border-secondary");
$("#02").attr('class', " card border-secondary");
$("#03").attr('class', " card border-secondary");
$("#04").attr('class', " card border-secondary");
$("#05").attr('class', " card border-secondary");
$("#06").attr('class', " card border-secondary");

if ($("#orderid").val() === "") {
  $('#empty').hide();
  $('#emptydes').show();
  $('#emptyser').hide();
  $('#notempty').hide();
} else {
  $('#empty').hide();
  $('#emptydes').hide();
  $('#emptyser').hide();
  $('#notempty').show();
  //anable detail panel and get data from back end

  //load order list to list area
  $.get("../routes/order/getservice_details.php", {
    osid: $orderid
  }, function (res3) {
    var jdata2 = jQuery.parseJSON(res3);

    $("#orderdate").text(jdata2.date);
    $("#address").text(jdata2.address);
    $("#price").text(jdata2.price);
    $("#deliveryid").val(jdata2.dilevery_Id);

    $.get("../routes/order/getservicedelivery_details.php", {
      did: jdata2.status_Id
    }, function (res4) {
      var jdata3 = jQuery.parseJSON(res4);

      if (jdata3.placed == 1) {
        $("#01").attr('class', " card border-secondary bg-info");
      };
      if (jdata3.payment == 1) {
        $("#02").attr('class', " card border-secondary bg-info");
      };
      if (jdata3.appruwed == 1) {
        $("#03").attr('class', " card border-secondary bg-info");
      };
      if (jdata3.stoers == 1) {
        $("#04").attr('class', " card border-secondary bg-info");
      };
      if (jdata3.complet == 1) {
        $("#05").attr('class', " card border-secondary bg-info");
      };
      if (jdata3.complet == 1) {
        $("#06").attr('class', " card border-secondary bg-info");
      };

    })
  })

}
}

  //this function use to delet the order recode
  function deleteorder(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/order/delete_order.php",{
                oid:oid
            },function (res) {
                if(res="ok"){
                  listorder();
                  showdata();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            
                }
                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not delete order.',
                    'error')
                }
               
            }
            
            )
        }
        });
     }
 

     function homepage(){
      window.location.href = "../../index.php";
    
     }
    //  document.location.reload();
</script>