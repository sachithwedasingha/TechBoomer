<?php
//start sessions
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');

//include image upload function
include_once('img_upload.php');


//this function is add new addres in order proccess
class Order extends Main{

  ///////////////////////this function set use to make order service or desin /////////////////////////////////////

  //add address data within order proccess
    public function addaddressdata($userid, $name, $number,$lane,$town,$dis){

  //chek user id is in the db?
  $result = "SELECT * FROM address_tbl WHERE user_Id = '$userid';";
       
        //lets check the errors 
       if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
      }
  
    //we need to execute our sql by query 
    $sqlResult = $this->dbResult->query($result);
     //lets count the number of rows

     $nor =  $sqlResult->num_rows;

     if($nor > 0){

      $ubdate1=" UPDATE address_tbl 
      SET address_Name='$name', 
          address_Number='$number', 
          address_Lane='$lane', 
          address_Town='$town', 
          address_District='$dis' 
          WHERE user_Id='$userid';";

      if($this->dbResult->error){
       echo($this->dbResult->error);
       exit;
      }

     //now we are going to execute the SQL query
     $sqlResult2 = $this->dbResult->query($ubdate1);
      
     }
     else{

          //insert order to databace
          $sqlInsert = "INSERT INTO address_tbl VALUES('$userid','$name','$number','$lane','$town','$dis',0);";

          //lets check the errors 
          if($this->dbResult->error){
          echo($this->dbResult->error);
          exit;
          }

          //we need to execute our sql by query 
          $sqlResult = $this->dbResult->query($sqlInsert);

          //lest check the result is 0 or not 
          if($sqlResult > 0){
            return("done");
            }
          else{
            return("Please Try again later!");
          }
      }    
}



//this function to get address data to address form within areder proccess
public function getaddress($uid){
  $sqlSelect = "SELECT * FROM address_tbl WHERE user_Id = '$uid' AND d_status = 0 ;";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;
 if($nor > 0){
 $rec = $sqlResult->fetch_assoc();

 return json_encode($rec);
 }
}




//this function to place order
public function makeorder($tempid,$date,$userid,$total,$productid,$productcount,$address){

  //check tempid is in the order table then get the order id
  $result = "SELECT * FROM order_tbl WHERE temp_Id = $tempid;";
       
        //lets check the errors 
       if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
        }
  
    //we need to execute our sql by query 
    $sqlResult = $this->dbResult->query($result);
     //lets count the number of rows
     $nor =  $sqlResult->num_rows;


  if($nor > 0){

        $rec = $sqlResult->fetch_assoc();
        $ordid = $rec['order_Id'];
        
        $autonumber = new AutoNumber;
        $oiid = $autonumber -> NumberGeneration("id","order_item_tbl","OI");

        //insert data to table
        $sqlInsert = "INSERT INTO order_item_tbl VALUES('$oiid','$ordid','$productid','$productcount',0);";

        //lets check the errors 
        if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }

        //we need to execute our sql by query 
        $sqlResult = $this->dbResult->query($sqlInsert);

        $sqlupdate = "UPDATE store_tbl SET product_Quantity = (product_Quantity-'$productcount') WHERE product_Id='$productid'";
        
        $sqlResult = $this->dbResult->query($sqlupdate);

        //lest check the result is 0 or not 
        if($sqlResult > 0){
          return($ordid);
          }
          else{
            return("error");
          }
    }
  else{
      //ganaratr new id to delivery
      $autonumber = new AutoNumber;
      $orderid = $autonumber -> NumberGeneration("order_Id","order_tbl","ORD");
      //ganaratr new id to delivery
      $autonumber = new AutoNumber;
      $deliveryid = $autonumber -> NumberGeneration("delivery_Id","delivery_tbl","DLR");
 
       //insert data to user table
       $sqlInsert = "INSERT INTO delivery_tbl VALUES('$deliveryid',1,1,0,0,0,0,0);";

       //lets check the errors 
       if($this->dbResult->error){
           echo($this->dbResult->error);
           exit;
       }
       //we need to execute our sql by query 
       $sqlResult = $this->dbResult->query($sqlInsert);

    
     //insert data to user table
     $sqlInsert1 = "INSERT INTO order_tbl VALUES('$orderid','$tempid','$userid','$date','$address','$total','$deliveryid',0);";

     //lets check the errors 
     if($this->dbResult->error){
         echo($this->dbResult->error);
         exit;
     }
 
     //we need to execute our sql by query 
     $sqlResult = $this->dbResult->query($sqlInsert1);
 
     //lest check the result is 0 or not 
     if($sqlResult > 0){

                  $autonumber = new AutoNumber;
                  $oiid = $autonumber -> NumberGeneration("id","order_item_tbl","OI");

                      //insert data to user table
                  $sqlInsert = "INSERT INTO order_item_tbl VALUES('$oiid','$orderid','$productid','$productcount',0);";

                  //lets check the errors 
                  if($this->dbResult->error){
                      echo($this->dbResult->error);
                      exit;
                  }
              
                  
                  $sqlupdate = "UPDATE store_tbl SET product_Quantity = (product_Quantity-'$productcount') WHERE product_Id='$productid'";
        
                  $sqlResult = $this->dbResult->query($sqlupdate);
          

                  //we need to execute our sql by query 
                  $sqlResult = $this->dbResult->query($sqlInsert);
              
                  //lest check the result is 0 or not 
                  if($sqlResult > 0){
                      return($orderid);
                     }
                     else{
                       return("error");
                     }
      }
      else{
      return("error");
      }
}
}


//this function to place order
public function makeorderoff($tempid,$date,$userid,$total,$productid,$productcount,$address){

  //check tempid is in the order table then get the order id
  $result = "SELECT * FROM order_tbl WHERE temp_Id = $tempid;";
       
        //lets check the errors 
       if($this->dbResult->error){
        echo($this->dbResult->error);
        exit;
        }
  
    //we need to execute our sql by query 
    $sqlResult = $this->dbResult->query($result);
     //lets count the number of rows
     $nor =  $sqlResult->num_rows;


  if($nor > 0){

        $rec = $sqlResult->fetch_assoc();
        $ordid = $rec['order_Id'];
        
        $autonumber = new AutoNumber;
        $oiid = $autonumber -> NumberGeneration("id","order_item_tbl","OI");

        //insert data to table
        $sqlInsert = "INSERT INTO order_item_tbl VALUES('$oiid','$ordid','$productid','$productcount',0);";

        //lets check the errors 
        if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
        }

        //we need to execute our sql by query 
        $sqlResult = $this->dbResult->query($sqlInsert);

        $sqlupdate = "UPDATE store_tbl SET product_Quantity = (product_Quantity-'$productcount') WHERE product_Id='$productid'";
        
        $sqlResult = $this->dbResult->query($sqlupdate);


        //lest check the result is 0 or not 
        if($sqlResult > 0){
          return($ordid);
          }
          else{
            return("error");
          }
    }
  else{
      //ganaratr new id to delivery
      $autonumber = new AutoNumber;
      $orderid = $autonumber -> NumberGeneration("order_Id","order_tbl","ORD");
      //ganaratr new id to delivery
      $autonumber = new AutoNumber;
      $deliveryid = $autonumber -> NumberGeneration("delivery_Id","delivery_tbl","DLR");
 
       //insert data to user table
       $sqlInsert = "INSERT INTO delivery_tbl VALUES('$deliveryid',1,0,0,0,0,0,0);";

       //lets check the errors 
       if($this->dbResult->error){
           echo($this->dbResult->error);
           exit;
       }
       //we need to execute our sql by query 
       $sqlResult = $this->dbResult->query($sqlInsert);

    
     //insert data to user table
     $sqlInsert1 = "INSERT INTO order_tbl VALUES('$orderid','$tempid','$userid','$date','$address','$total','$deliveryid',0);";

     //lets check the errors 
     if($this->dbResult->error){
         echo($this->dbResult->error);
         exit;
     }
 
     //we need to execute our sql by query 
     $sqlResult = $this->dbResult->query($sqlInsert1);
 
     //lest check the result is 0 or not 
     if($sqlResult > 0){

                  $autonumber = new AutoNumber;
                  $oiid = $autonumber -> NumberGeneration("id","order_item_tbl","OI");

                      //insert data to user table
                  $sqlInsert = "INSERT INTO order_item_tbl VALUES('$oiid','$orderid','$productid','$productcount',0);";

                  //lets check the errors 
                  if($this->dbResult->error){
                      echo($this->dbResult->error);
                      exit;
                  }
              
                  //we need to execute our sql by query 
                  $sqlResult = $this->dbResult->query($sqlInsert);

                  $sqlupdate = "UPDATE store_tbl SET product_Quantity = (product_Quantity-'$productcount') WHERE product_Id='$productid'";
        
                   $sqlResult = $this->dbResult->query($sqlupdate);

              
                  //lest check the result is 0 or not 
                  if($sqlResult > 0){
                    return($orderid);
                     }
                     else{
                       return("error");
                     }
      }
      else{
      return("error");
      }
}
}


 //get service data to Order page
 function orderlist($sid){

  $sqlSelect = "SELECT * FROM order_tbl WHERE user_Id = '$sid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;
  if($nor > 0){
  while($rec = $sqlResult->fetch_assoc())
          {
            $orderid = $rec['order_Id'];

            $sqlSelect1 = "SELECT * FROM order_Item_tbl WHERE order_Id = '$orderid' AND d_status = 0;";
          //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);

          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
          if($nor1 > 0){
          while($rec1 = $sqlResult1->fetch_assoc())
                  {
                    $productid = $rec1['product_Id'];

                    $sqlSelect2 = "SELECT * FROM product_tbl WHERE product_Id = '$productid' AND d_status = 0;";
                    //lets check the errors 
                    if($this->dbResult->error){
                    echo($this->dbResult->error);
                    exit;
                    }
                  //sql execute 
                  $sqlResult2 = $this->dbResult->query($sqlSelect2);
                
                  //check the number of rows
                  $nor2 = $sqlResult2->num_rows;
                  if($nor2 > 0){
                    while($rec2 = $sqlResult2->fetch_assoc())
                    {
                      $productimage = $rec2['procut_Image'];
                    }
                  }
                }
                      echo('<div class="card border-danger mb-3" id="sellItems" onclick="moredetails(\''.$rec['order_Id'].'\')" style="max-width: 20rem;">
                      <div class="card-header">'.$rec['order_Id'].'</div>
                      <div class="card-body">
                        <h4 class="card-title py-0">'.$rec['order_price'].' LKR</h4>
                        <div class="row">
                        <div class="col-5">
                        <p>'.$nor1.' Items</p>
                        
                        </div>
                        <div class="col-7">
                        <img src="../'.$productimage.'" width="80px" height="80px">
                        </div>
                        </div>
                      </div>
                    </div>');
                }
                
        }
}
else{
  echo('<div class="card border-danger mb-3" id="sellItems" onclick="homepage()" style="max-width: 20rem; max-height:20rem">
  <img src="../upload/ui/04.png" width="100px" style="display: block; margin-left: auto; margin-right: auto; margin-top:40px; margin-bottom:5px;" >
  <p style="text-align:center;margin-bottom:20px;">Add New Order<p>
</div>');
}
}


///////////////////////////////////this function set use to order details view //////////////////////////////

  //this function use to get order data to oetail form
  function orderdata($sid){

    $sqlSelect = "SELECT * FROM order_tbl WHERE order_Id = '$sid' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);

    //check the number of rows
    $nor = $sqlResult->num_rows;
    if($nor > 0){
    $rec = $sqlResult->fetch_assoc();

    return json_encode($rec);
    }
   
}

 //this function use to get delivery data to oetail form
 function deliverydata($sid){

  $sqlSelect = "SELECT * FROM delivery_tbl WHERE delivery_Id = '$sid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;
  if($nor > 0){
  $rec = $sqlResult->fetch_assoc();
      
  return json_encode($rec);
  }
 
}

//this function use to get ordered products to detail sheet
function productlist($iid){

  $sqlSelect = "SELECT * FROM order_item_tbl WHERE order_Id ='$iid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;
  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc())
    {
      $pid = $rec['product_Id'];

              $sqlSelect1 = "SELECT * FROM product_tbl WHERE product_Id ='$pid' AND d_status = 0;";
          //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);

          //check the number of rows
          $nor = $sqlResult1->num_rows;
          if($nor > 0){
          $rec1 = $sqlResult1->fetch_assoc();
    {
      echo('<div class="row py-1">
      <div class="col-4">
          <img src="../'.$rec1['procut_Image'].'"  width="80px" height="80px" alt="">
      </div>
      <div class="col-4">
          <p>'.$rec1['product_Name'].'</p>
      </div>
      <div class="col-4">
          <p>'.$rec1['product_Category'].'</p>
      </div>
    </div>');
    }
  }
  }
}
}




 //get service data to Order page
 function servicelist($sid){

  $sqlSelect = "SELECT * FROM order_service_tbl WHERE user_Id = '$sid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;
  if($nor > 0){
  while($rec = $sqlResult->fetch_assoc())
          {
            $osid = $rec['os_Id'];
            $serviceid = $rec['service_Id'];

            $sqlSelect1 = "SELECT * FROM service_tbl WHERE service_ID = '$serviceid' AND d_status = 0;";
          //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);

          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
          if($nor1 > 0){
          while($rec1 = $sqlResult1->fetch_assoc())
                  {
                    $image = $rec1['service_Image'];
                    
                    $sqlSelect2 = "SELECT * FROM service_mesh_tbl WHERE os_Id = '$osid' AND d_status = 0;";
                    //lets check the errors 
                    if($this->dbResult->error){
                    echo($this->dbResult->error);
                    exit;
                    }
                  //sql execute 
                  $sqlResult2 = $this->dbResult->query($sqlSelect2);
                
                  //check the number of rows
                  $nor2 = $sqlResult2->num_rows;
                  
                }
                      echo('<div class="card border-danger mb-3" id="sellItems" onclick="moredetailsservice(\''.$rec['os_Id'].'\')" style="max-width: 20rem;">
                      <div class="card-header">'.$rec['os_Id'].'</div>
                      <div class="card-body">
                        <h4 class="card-title py-0">'.$rec['price'].' LKR</h4>
                        <div class="row">
                        <div class="col-5">
                        <p>'.$nor2.' Meshurments</p>
                        
                        </div>
                        <div class="col-7">
                        <img src="../'.$image.'" width="80px" height="80px">
                        </div>
                        </div>
                      </div>
                    </div>');
                }
        }
}
else{
  echo('<div class="card border-danger mb-3" id="sellItems" onclick="homepage()" style="max-width: 20rem; max-height:20rem">
  <img src="../upload/ui/04.png" width="100px" style="display: block; margin-left: auto; margin-right: auto; margin-top:40px; margin-bottom:5px;" >
  <p style="text-align:center;margin-bottom:20px;">Add New Order<p>
</div>');
}
}

//this function use to get ordered products to detail sheet
function meshlist($iid){

              $sqlSelect1 = "SELECT * FROM service_mesh_tbl WHERE os_Id ='$iid' AND d_status = 0;";
          //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);

          //check the number of rows
          $nor = $sqlResult1->num_rows;
          if($nor > 0){
            while($rec1 = $sqlResult1->fetch_assoc())
            
    {
      echo('<div class="row py-1">
      <div class="col-4">
          <p>'.$rec1['width'].'</p>
      </div>
      <div class="col-4">
          <p>'.$rec1['height'].'</p>
      </div>
      <div class="col-4">
          <p>'.$rec1['unit_Price'].'</p>
      </div>
    </div>');
    }
  
  }
  }

  //this function use to get sevice data to oetail form
  function servicedata($osid){

    $sqlSelect = "SELECT * FROM order_service_tbl WHERE os_Id = '$osid' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
  
    //check the number of rows
    $nor = $sqlResult->num_rows;
    if($nor > 0){
    $rec = $sqlResult->fetch_assoc();
        
    return json_encode($rec);
    }
   
  }


  //this function to get delivery data to order details form
  function deliverydataservice($did){

    $sqlSelect = "SELECT * FROM service_status_tbl WHERE status_Id = '$did' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);
  
    //check the number of rows
    $nor = $sqlResult->num_rows;
    if($nor > 0){
    $rec = $sqlResult->fetch_assoc();
        
    return json_encode($rec);
    }
   
  }


  //this funtion to delete order details
  function deleteorder($oid){

    $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($sqlSelect);
  
   //check the number of rows
   $nor = $sqlResult->num_rows;
  
   if($nor > 0){
     while($rec = $sqlResult->fetch_assoc()){
       $delid=$rec['dilevery_Id'];
  
    $update1 = "UPDATE delivery_tbl SET d_status = 1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
  
   $update1 = "UPDATE order_tbl SET d_status = 1 WHERE  order_Id = '$oid' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
       return("ok"); 
    
    }
  }
    
  }


   //this funtion to pay offline
   function payoffline($oid){

    $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
    //lets check the errors 
     if($this->dbResult->error){
     echo($this->dbResult->error);
     exit;
    }
  //sql execute 
  $sqlResult = $this->dbResult->query($sqlSelect);
 
   //check the number of rows
   $nor = $sqlResult->num_rows;
 
   if($nor > 0){
     while($rec = $sqlResult->fetch_assoc()){
       $delid=$rec['dilevery_Id'];

    $update1 = "UPDATE delivery_tbl SET order_payment=1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
     //lets check the errors 
      if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($update1);
       return("ok"); 
    
    }
  }
}


function conformorder($oid){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor > 0){
   while($rec = $sqlResult->fetch_assoc()){
     $delid=$rec['dilevery_Id'];

  $update1 = "UPDATE delivery_tbl SET order_conform = 1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($update1);
     return("ok"); 
  
  }
}
}




function ready($oid){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor > 0){
   while($rec = $sqlResult->fetch_assoc()){
     $delid=$rec['dilevery_Id'];

  $update1 = "UPDATE delivery_tbl SET order_transport = 1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($update1);
     return("ok"); 
  
  }
}
}


function deliverd($oid){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor > 0){
   while($rec = $sqlResult->fetch_assoc()){
     $delid=$rec['dilevery_Id'];

  $update1 = "UPDATE delivery_tbl SET order_deliverd = 1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($update1);
     return("ok"); 
  
  }
}
}


function declareorder($oid){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_Id ='$oid';";
  //lets check the errors 
   if($this->dbResult->error){
   echo($this->dbResult->error);
   exit;
  }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

 //check the number of rows
 $nor = $sqlResult->num_rows;

 if($nor > 0){
   while($rec = $sqlResult->fetch_assoc()){
     $delid=$rec['dilevery_Id'];

  $update1 = "UPDATE delivery_tbl SET d_status = 1 WHERE  delivery_Id = '$delid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($update1);

 $update1 = "UPDATE order_tbl SET d_status = 1 WHERE  order_Id = '$oid' AND d_status = 0;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($update1);
     return("ok"); 
  
  }
}
}

  //this function use to get order list to admin panel or employees
public function showorderlist(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];

            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              $os=$rec1['order_conform'];
              if($os==0){
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['user_Id'].'</th>
          <td>'.$rec['order_date'].'</td>
          <td>'.$rec['order_price'].'</td>
          <td>'.$rec['dilevery_Id'].'</td>
          <td><button type="button" class="btn btn-danger" onclick="deleteorder(\''.$rec['order_Id'].'\')">Delete</button></td>
       </tr>
              ');
              }
              else{
                echo('
                <tr>
                  <th>'.$rec['order_Id'].'</th>
                  <th>'.$rec['user_Id'].'</th>
                  <td>'.$rec['order_date'].'</td>
                  <td>'.$rec['order_price'].'</td>
                  <td>'.$rec['dilevery_Id'].'</td>
                  <td><button type="button" class="btn btn-secondary disabled" >Delete</button></td>
               </tr>
                      ');
              }
       }}
       else
       {echo('
        <div class="alert alert-danger" role="alert">
        No Orders Are Found!
      </div>');
      }
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//lets create search employer methord for previous function
public function Searchorderlist($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE (order_Id LIKE '$searchData%' OR user_Id  LIKE '$searchData%') AND d_status = 0";
 //lets check the errors 
 if($this->dbResult->error){
  echo($this->dbResult->error);
  exit;
 }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;

if($nor > 0){
  while($rec = $sqlResult->fetch_assoc()){
    $delid=$rec['dilevery_Id'];

          
          $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0;";
          //lets check the errors 
          if($this->dbResult->error){
          echo($this->dbResult->error);
          exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);
      
        //check the number of rows
        $nor1 = $sqlResult1->num_rows;
      
        if($nor1 > 0){
          while($rec1 = $sqlResult1->fetch_assoc()){
            $os=$rec1['order_conform'];
            if($os==0){
      echo('
      <tr>
        <th>'.$rec['order_Id'].'</th>
        <th>'.$rec['user_Id'].'</th>
        <td>'.$rec['order_date'].'</td>
        <td>'.$rec['order_price'].'</td>
        <td>'.$rec['dilevery_Id'].'</td>
        <td><button type="button" class="btn btn-danger" onclick="deleteorder(\''.$rec['order_Id'].'\')">Delete</button></td>
     </tr>
            ');
            }
            else{
              echo('
              <tr>
                <th>'.$rec['order_Id'].'</th>
                <th>'.$rec['user_Id'].'</th>
                <td>'.$rec['order_date'].'</td>
                <td>'.$rec['order_price'].'</td>
                <td>'.$rec['dilevery_Id'].'</td>
                <td><button type="button" class="btn btn-secondary disabled" >Delete</button></td>
             </tr>
                    ');
            }
     }}
     else
     {echo('
      <div class="alert alert-danger" role="alert">
      No Orders Are Found!
    </div>');
    }
  }
}
else {echo('
  <div class="alert alert-danger" role="alert">
  No Orders Are Found!
</div>');
}
}


//this function use to get detail to employers about delivery information
public function showorderlistdelivery(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];

            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              if($rec1['order_payment']==1)
                  { $s1=('<span class="badge bg-success">Success</span>');}
                    else
                    {$s1=('<span class="badge bg-warning">Warning</span>');}

              if($rec1['order_conform']==1)
                    { $s2=('<span class="badge bg-success">Success</span>');}
                      else
                      {$s2=('<span class="badge bg-warning">Warning</span>');}

              if($rec1['order_transport']==1)
                      { $s3=('<span class="badge bg-success">Success</span>');}
                        else
                        {$s3=('<span class="badge bg-warning">Warning</span>');}

              if($rec1['order_deliverd']==1)
                        { $s4=('<span class="badge bg-success">Success</span>');}
                          else
                          {$s4=('<span class="badge bg-warning">Warning</span>');}
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['order_date'].'</th>
          <td>'.$s1.'</td>
          <td>'.$s2.'</td>
          <td>'.$s3.'</td>
          <td>'.$s4.'</td>
       </tr>
              ');
              
              
       }}
       else
       {echo('
        <div class="alert alert-danger" role="alert">
        No Orders Are Found!
      </div>');
      }
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//lets create search delivery details for privous function
public function Searchorderlistdelivery($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE (order_Id LIKE '$searchData%' OR user_Id  LIKE '$searchData%') AND d_status = 0";
//lets check the errors 
if($this->dbResult->error){
  echo($this->dbResult->error);
  exit;
 }
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;

if($nor > 0){
  while($rec = $sqlResult->fetch_assoc()){
    $delid=$rec['dilevery_Id'];

          
          $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0;";
          //lets check the errors 
          if($this->dbResult->error){
          echo($this->dbResult->error);
          exit;
          }
        //sql execute 
        $sqlResult1 = $this->dbResult->query($sqlSelect1);
      
        //check the number of rows
        $nor1 = $sqlResult1->num_rows;
      
        if($nor1 > 0){
          while($rec1 = $sqlResult1->fetch_assoc()){
            if($rec1['order_payment']==1)
                { $s1=('<span class="badge bg-success">Success</span>');}
                  else
                  {$s1=('<span class="badge bg-warning">Warning</span>');}

            if($rec1['order_conform']==1)
                  { $s2=('<span class="badge bg-success">Success</span>');}
                    else
                    {$s2=('<span class="badge bg-warning">Warning</span>');}

            if($rec1['order_transport']==1)
                    { $s3=('<span class="badge bg-success">Success</span>');}
                      else
                      {$s3=('<span class="badge bg-warning">Warning</span>');}

            if($rec1['order_deliverd']==1)
                      { $s4=('<span class="badge bg-success">Success</span>');}
                        else
                        {$s4=('<span class="badge bg-warning">Warning</span>');}
      echo('
      <tr>
        <th>'.$rec['order_Id'].'</th>
        <th>'.$rec['order_date'].'</th>
        <td>'.$s1.'</td>
        <td>'.$s2.'</td>
        <td>'.$s3.'</td>
        <td>'.$s4.'</td>
     </tr>
            ');
            
            
     }}
     else
     {echo('
      <div class="alert alert-danger" role="alert">
      No Orders Are Found!
    </div>');
    }
  }
}
else {echo('
  <div class="alert alert-danger" role="alert">
  No Orders Are Found!
</div>');
}
}



//this function use to  update offline payment form
public function offlinepayment(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];

            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_payment = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              
              
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['user_Id'].'</th>
          <td>'.$rec['order_date'].'</td>
          <td>'.$rec['order_price'].'</td>
          <td><button type="button" class="btn btn-success" onclick="offlinepay(\''.$rec['order_Id'].'\')">Payed Now</button></td>
          <td><button type="button" class="btn btn-warning" onclick="deleteorder(\''.$rec['order_Id'].'\')">Delete</button></td>
       </tr>
              ');
              
       }}
       else
       {}
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//lets create search employer methord
public function offlinepaymentserch($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE (order_Id LIKE '$searchData%' OR user_Id  LIKE '$searchData%') AND d_status = 0";

//lets check the errors 
 if($this->dbResult->error){
 echo($this->dbResult->error);
 exit;
}
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;

if($nor > 0){
 while($rec = $sqlResult->fetch_assoc()){
   $delid=$rec['dilevery_Id'];

         
         $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_payment = 0;";
         //lets check the errors 
         if($this->dbResult->error){
         echo($this->dbResult->error);
         exit;
         }
       //sql execute 
       $sqlResult1 = $this->dbResult->query($sqlSelect1);
     
       //check the number of rows
       $nor1 = $sqlResult1->num_rows;
     
       if($nor1 > 0){
         while($rec1 = $sqlResult1->fetch_assoc()){
           
           
     echo('
     <tr>
       <th>'.$rec['order_Id'].'</th>
       <th>'.$rec['user_Id'].'</th>
       <td>'.$rec['order_date'].'</td>
       <td>'.$rec['order_price'].'</td>
       <td><button type="button" class="btn btn-success" onclick="offlinepay(\''.$rec['order_Id'].'\')">Payed Now</button></td>
       <td><button type="button" class="btn btn-warning" onclick="deleteorder(\''.$rec['order_Id'].'\')">Delete</button></td>
    </tr>
           ');
           
    }}
    else
    {}
 }
}
else {echo('
 <div class="alert alert-danger" role="alert">
 No Orders Are Found!
</div>');
}
}



//this function use to  update offline payment form
public function conformorderlist(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];

            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_conform = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              
              
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['user_Id'].'</th>
          <td>'.$rec['order_date'].'</td>
          <td>'.$rec['order_price'].'</td>
          <td><button type="button" class="btn btn-success" onclick="conferm(\''.$rec['order_Id'].'\')">Confirm Order</button></td>
          <td><button type="button" class="btn btn-warning" onclick="declare(\''.$rec['order_Id'].'\')">Declare</button></td>
       </tr>
              ');
              
       }}
       else
       {}
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//lets create search employer methord
public function conformorderlist_serch($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE (order_Id LIKE '$searchData%' OR user_Id  LIKE '$searchData%') AND d_status = 0";

//lets check the errors 
 if($this->dbResult->error){
 echo($this->dbResult->error);
 exit;
}
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;

if($nor > 0){
 while($rec = $sqlResult->fetch_assoc()){
   $delid=$rec['dilevery_Id'];

         
         $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_conform = 0;";
         //lets check the errors 
         if($this->dbResult->error){
         echo($this->dbResult->error);
         exit;
         }
       //sql execute 
       $sqlResult1 = $this->dbResult->query($sqlSelect1);
     
       //check the number of rows
       $nor1 = $sqlResult1->num_rows;
     
       if($nor1 > 0){
         while($rec1 = $sqlResult1->fetch_assoc()){
           
          
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['user_Id'].'</th>
          <td>'.$rec['order_date'].'</td>
          <td>'.$rec['order_price'].'</td>
          <td><button type="button" class="btn btn-success" onclick="conferm(\''.$rec['order_Id'].'\')">Confirm Order</button></td>
          <td><button type="button" class="btn btn-warning" onclick="declare(\''.$rec['order_Id'].'\')">Declare</button></td>
       </tr>
              ');
           
    }}
    else
    {}
 }
}
else {echo('
 <div class="alert alert-danger" role="alert">
 No Orders Are Found!
</div>');
}
}



//this function use to  update offline payment form
public function  tostore(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
  
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];
      $oid=$rec['order_Id'];
            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_transport = 0 AND order_conform = 1 AND order_payment = 1 AND order_deliverd = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              
              $sqlSelect2 = "SELECT * FROM order_item_tbl WHERE d_status = 0 AND order_Id = '$oid' ORDER BY id ASC;";
              //lets check the errors 
               if($this->dbResult->error){
               echo($this->dbResult->error);
               exit;
              }
            //sql execute 
            $sqlResult2 = $this->dbResult->query($sqlSelect2);
           
             //check the number of rows
             $nor2 = $sqlResult2->num_rows;
           
             $item="";
             if($nor2 > 0){
               while($rec2 = $sqlResult2->fetch_assoc()){
                $proid=$rec2['product_Id'];

                $sqlSelect3 = "SELECT * FROM store_tbl WHERE d_status = 0 AND product_Id = '$proid';";
                //lets check the errors 
                 if($this->dbResult->error){
                 echo($this->dbResult->error);
                 exit;
                }
              //sql execute 
              $sqlResult3 = $this->dbResult->query($sqlSelect3);
             
               //check the number of rows
               $nor3 = $sqlResult3->num_rows;
            
              $rec3 = $sqlResult3->fetch_assoc();
                

               $item =$item.'<tr><th>'.$rec2['product_Id'].'</th><th>'.$rec2['quantity'].'</th><td>sec'.$rec3['product_Sec'].', Row'.$rec3['product_Rpw'].', Col'.$rec3['product_Col'].', Lev'.$rec3['product_Lev'].'</td></tr>';
              }

        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>
          <table class="table table-hover">
            <thead>
                <tr class="table-secondary">
                    <th scope="row">Pro Id</th>
                    <td>Quentity</td>
                    <td>Location</td>
                </tr>
            </thead>
            <tbody">
                '.$item.'
            </tbody>
        </table>
          </th>
          <td><button type="button" class="btn btn-success" onclick="rady(\''.$rec['order_Id'].'\')">Order Rady</button></td>
       </tr>
              ');
              
       }
      else{}
    }}
       else{}
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//this function to get data for stors and admin about orders
public function tostoreserch($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE order_Id LIKE '$searchData%'  AND d_status = 0";

   //lets check the errors 
   if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];
      $oid=$rec['order_Id'];
            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_store = 0 AND order_conform = 1 AND order_payment = 1 AND order_deliverd = 0;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              
              $sqlSelect2 = "SELECT * FROM order_item_tbl WHERE d_status = 0 AND order_Id = '$oid' ORDER BY id ASC;";
              //lets check the errors 
               if($this->dbResult->error){
               echo($this->dbResult->error);
               exit;
              }
            //sql execute 
            $sqlResult2 = $this->dbResult->query($sqlSelect2);
           
             //check the number of rows
             $nor2 = $sqlResult2->num_rows;
           
             $item="";
             if($nor2 > 0){
               while($rec2 = $sqlResult2->fetch_assoc()){
                $proid=$rec2['product_Id'];

                $sqlSelect3 = "SELECT * FROM store_tbl WHERE d_status = 0 AND product_Id = '$proid';";
                //lets check the errors 
                 if($this->dbResult->error){
                 echo($this->dbResult->error);
                 exit;
                }
              //sql execute 
              $sqlResult3 = $this->dbResult->query($sqlSelect3);
             
               //check the number of rows
               $nor3 = $sqlResult3->num_rows;
            
              $rec3 = $sqlResult3->fetch_assoc();
                

               $item =$item.'<tr><th>'.$rec2['product_Id'].'</th><th>'.$rec2['quantity'].'</th><td>sec'.$rec3['product_Sec'].', Row'.$rec3['product_Rpw'].', Col'.$rec3['product_Col'].', Lev'.$rec3['product_Lev'].'</td></tr>';
              }

        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>
          <table class="table table-hover">
            <thead>
                <tr class="table-secondary">
                    <th scope="row">Pro Id</th>
                    <td>Quentity</td>
                    <td>Location</td>
                </tr>
            </thead>
            <tbody">
                '.$item.'
            </tbody>
        </table>
          </th>
          <td><button type="button" class="btn btn-success" onclick="rady(\''.$rec['order_Id'].'\')">Order Rady</button></td>
       </tr>
              ');
              
       }
      else{}
    }}
       else{}
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}



//this function use to  update offline payment form
public function deliverlist(){

  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_date ASC;";
   //lets check the errors 
    if($this->dbResult->error){
    echo($this->dbResult->error);
    exit;
   }
 //sql execute 
 $sqlResult = $this->dbResult->query($sqlSelect);

  //check the number of rows
  $nor = $sqlResult->num_rows;

  if($nor > 0){
    while($rec = $sqlResult->fetch_assoc()){
      $delid=$rec['dilevery_Id'];
      $userid=$rec['user_Id'];

            
            $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_deliverd = 0 AND order_transport = 1 ;";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult1 = $this->dbResult->query($sqlSelect1);
        
          //check the number of rows
          $nor1 = $sqlResult1->num_rows;
        
          if($nor1 > 0){
            while($rec1 = $sqlResult1->fetch_assoc()){
              
              $sqlSelect2 = "SELECT * FROM user_tbl WHERE user_id ='$userid' AND d_status = 0";
            //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
            }
          //sql execute 
          $sqlResult2 = $this->dbResult->query($sqlSelect2);
        
          //check the number of rows
          $nor2 = $sqlResult2->num_rows;
          $rec2 = $sqlResult2->fetch_assoc();
        echo('
        <tr>
          <th>'.$rec['order_Id'].'</th>
          <th>'.$rec['user_Id'].'</th>
          <td>'.$rec['order_date'].'</td>
          <td>'.$rec2['user_phone'].'</td>
          <td>'.$rec['address'].'</td>
          <td><button type="button" class="btn btn-warning" onclick="deliverd(\''.$rec['order_Id'].'\')">Deliverd</button></td>
       </tr>
              ');
              
       }}
       else
       {}
    }
  }
  else {echo('
    <div class="alert alert-danger" role="alert">
    No Orders Are Found!
  </div>');
  }
}


//lets create search employer methord
public function deliverlist_serch($searchData){

//sqlSearchData
$sqlSelect = "SELECT * FROM order_tbl WHERE (order_Id LIKE '$searchData%' OR user_Id  LIKE '$searchData%') AND d_status = 0";

//lets check the errors 
 if($this->dbResult->error){
 echo($this->dbResult->error);
 exit;
}
//sql execute 
$sqlResult = $this->dbResult->query($sqlSelect);

//check the number of rows
$nor = $sqlResult->num_rows;

if($nor > 0){
 while($rec = $sqlResult->fetch_assoc()){
   $delid=$rec['dilevery_Id'];

         
         $sqlSelect1 = "SELECT * FROM delivery_tbl WHERE delivery_Id ='$delid' AND d_status = 0 AND order_payment = 0;";
         //lets check the errors 
         if($this->dbResult->error){
         echo($this->dbResult->error);
         exit;
         }
       //sql execute 
       $sqlResult1 = $this->dbResult->query($sqlSelect1);
     
       //check the number of rows
       $nor1 = $sqlResult1->num_rows;
     
       if($nor1 > 0){
         while($rec1 = $sqlResult1->fetch_assoc()){
           
           
     echo('
     <tr>
       <th>'.$rec['order_Id'].'</th>
       <th>'.$rec['user_Id'].'</th>
       <td>'.$rec['order_date'].'</td>
       <td>'.$rec['order_price'].'</td>
       <td><button type="button" class="btn btn-success" onclick="offlinepay(\''.$rec['order_Id'].'\')">Payed Now</button></td>
       <td><button type="button" class="btn btn-warning" onclick="deleteorder(\''.$rec['order_Id'].'\')">Delete</button></td>
    </tr>
           ');
           
    }}
    else
    {}
 }
}
else {echo('
 <div class="alert alert-danger" role="alert">
 No Orders Are Found!
</div>');
}
}





}
?>