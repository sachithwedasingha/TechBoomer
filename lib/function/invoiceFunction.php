<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class invoice extends Main{

      function pcount(){
        $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_Id DESC; ";

         //lets check the errors 
         if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

          //check the number of rows
          $nor = $sqlResult->num_rows;

          return($nor);
      }


      function scount(){
        $sqlSelect = "SELECT * FROM order_service_tbl WHERE d_status = 0 ORDER BY os_Id DESC; ";

         //lets check the errors 
         if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

          //check the number of rows
          $nor = $sqlResult->num_rows;

          return($nor);
      }
   

      function ptot(){
        $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_Id DESC; ";

         //lets check the errors 
         if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

         $tot=0;
          //check the number of rows
          $nor = $sqlResult->num_rows;

           if($nor > 0){
          while($rec =  $sqlResult -> fetch_assoc()){
              $tot=$tot+$rec['order_price'];
          }
        }
          return($tot);
      }

      function stot(){
        $sqlSelect = "SELECT * FROM order_service_tbl WHERE d_status = 0 ORDER BY os_Id DESC; ";

         //lets check the errors 
         if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

         $tot=0;
          //check the number of rows
          $nor = $sqlResult->num_rows;

           if($nor > 0){
          while($rec =  $sqlResult -> fetch_assoc()){
              $tot=$tot+$rec['price'];
          }
        }
          return($tot);
      }
    

    function ftot(){
        $sqlSelect = "SELECT * FROM order_service_tbl WHERE d_status = 0 ORDER BY os_Id DESC; ";

         //lets check the errors 
         if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

         $tot=0;
          //check the number of rows
          $nor = $sqlResult->num_rows;

           if($nor > 0){
          while($rec =  $sqlResult -> fetch_assoc()){
              $tot=$tot+$rec['price'];
          }
        }

        $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 ORDER BY order_Id DESC; ";

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
          while($rec =  $sqlResult -> fetch_assoc()){
              $tot=$tot+$rec['order_price'];
          }
        }
          return($tot);
      }

  //get service data to service page
  function orderdata($sid){

    $sqlSelect = "SELECT * FROM order_tbl INNER JOIN delivery_tbl ON order_tbl.dilevery_Id = delivery_tbl.delivery_Id WHERE order_Id = '$sid';";
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
   
 //get service data to service page
 function orderdatas($sid){

  $sqlSelect = "SELECT * FROM order_service_tbl INNER JOIN service_status_tbl ON order_service_tbl.status_Id = service_status_tbl.status_Id WHERE os_Id = '$sid' AND order_service_tbl.d_status=0;";
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

function orderitems($sid){

  $sqlSelect = "SELECT order_item_tbl.product_Id, order_item_tbl.quantity, product_tbl.product_Price FROM order_item_tbl INNER JOIN product_tbl ON order_item_tbl.product_Id = product_tbl.product_Id   WHERE order_Id = '$sid';";
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
    echo('
    <tr>
      <th >'.$rec['product_Id'].'</th>
      <td>'.$rec['quantity'].'</td>
      <td>'.$rec['product_Price'].'</td>
   </tr>
          ');
}
  }
 
}

function orderitemss($sid){

  $sqlSelect = "SELECT * FROM order_service_tbl INNER JOIN service_mesh_tbl ON order_service_tbl.os_Id = service_mesh_tbl.os_Id   WHERE order_service_tbl.os_Id = '$sid';";
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
    echo('
    <tr>
      <th >'.$rec['design_Id'].'</th>
      <td>'.$rec['width'].'</td>
      <td>'.$rec['height'].'</td>
   </tr>
          ');
}
  }
 
}

function pcountm($date){

  $start=$date+"-2";
  $end=$date+"-31";
  $sqlSelect = "SELECT * FROM order_tbl WHERE d_status = 0 AND order_date LIKE '$end%' ORDER BY order_Id DESC";

   //lets check the errors 
   if($this->dbResult->error){
      echo($this->dbResult->error);
      exit;
     }
   //sql execute 
   $sqlResult = $this->dbResult->query($sqlSelect);

    //check the number of rows
    $nor = $sqlResult->num_rows;

    return($nor);
}


function cusmonthly($start,$end){

  if($start==$end){
    echo('error');
  }
  else{

  $sqlSelect = "SELECT * FROM order_tbl WHERE (order_date BETWEEN '$start' AND '$end') AND d_status=0;";
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
 $tot=0;
 while($rec = $sqlResult->fetch_assoc()){
   echo('
   <tr>
     <th >'.$rec['order_Id'].'</th>
     <td>'.$rec['order_date'].'</td>
     <td>'.$rec['order_price'].'</td>
  </tr>
         ');
         $tot=$tot+$rec['order_price'];
 }
 echo('
   <tr>
     <th colspan="2">Total</th>
     
     <td>'.$tot.'</td>
  </tr>');

}}

    }


    
function cusmonthlys($start,$end){
  $sqlSelect = "SELECT * FROM order_service_tbl WHERE (date BETWEEN '$start' AND '$end') AND d_status=0;";
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
 $tot=0;
 while($rec = $sqlResult->fetch_assoc()){
   echo('
   <tr>
     <th >'.$rec['os_Id'].'</th>
     <td>'.$rec['date'].'</td>
     <td>'.$rec['price'].'</td>
  </tr>
         ');
         $tot=$tot+$rec['price'];
 }
 echo('
   <tr>
     <th colspan="2">Total</th>
     
     <td>'.$tot.'</td>
  </tr>');

}

    }
  }

    ?>