$(document).ready(function(){
  
    //lode user image, name and jobtitel
    $.get("../routes/emp/show_current_user.php", function (res) {
        //display data 
        $("#show_current_user").html(res);
      });
    //lode product Count
    $.get("../routes/products/productcount.php", function (res) {
        //display data 
        $("#admin_product_count").html(res);
      });
      //load user count
    $.get("../routes/users/usercount.php", function (res) {
         //display data 
        $("#admin_user_count").html(res);
      });
    $.get("../routes/users/servicecount.php", function (res) {
        //display data 
       $("#admin_service_count").html(res);
     });
    $.get("../routes/users/ordercount.php", function (res) {
      //display data 
     $("#admin_order_count").html(res);
   });



    //load content to page
    $('#add_employer').click(function(){
        $('#adminloadContent').load('emp/addemployer.php');
    });
    
    $('#edit_employer').click(function(){
      $('#adminloadContent').load('emp/editemployer.php');
     });

    $('#edit_product').click(function(){
        $('#adminloadContent').load('product/editproduct.php');
    });

    $('#add_product').click(function(){
      $('#adminloadContent').load('product/addproducts.php');
    });

    $('#add_Customer').click(function(){
        $('#adminloadContent').load('user/adduser.php');
    });

    $('#edit_Customer').click(function(){
      $('#adminloadContent').load('user/edit_user.php');
    });

    $('#activate_Customer').click(function(){
      $('#adminloadContent').load('user/activate_user.php');
    });

    $('#add_service').click(function(){
      $('#adminloadContent').load('service/addnewservice.php');
   });

   $('#add_service_design').click(function(){
    $('#adminloadContent').load('service/addservicedesign.php');
    });

    $('#cardadmin02').click(function(){
      $('#adminloadContentSide').load('user/userlist.php');
    });
  
    $('#viewallorders').click(function(){
      $('#adminloadContent').load('order/view_all_Orders.php');
    });
    
    $('#deliveryifo').click(function(){
      $('#adminloadContent').load('order/deliveryinfo.php');
    });
  
    $('#offlinepay').click(function(){
      $('#adminloadContent').load('order/offline_payment.php');
    });

    $('#ordercontamation').click(function(){
      $('#adminloadContent').load('order/order_conform.php');
    });

    $('#storrady').click(function(){
      $('#adminloadContent').load('order/Rady_to_transport.php');
    });

    $('#deliverd').click(function(){
      $('#adminloadContent').load('order/deliverd.php');
    });

    $('#bin').click(function(){
      $('#adminloadContent').load('design/bin.php');
    });

});

