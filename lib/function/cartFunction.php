<?php
//we need to start the sessions 
session_start();

//include main.php
include_once('main.php');

//include auto number module 
include_once('auto_id.php');


class cart extends Main{

      //view all Products
      function ViewCartItems(){
          $sqlSelect = "SELECT * FROM product_tbl ORDER BY product_Name DESC;";
           //lets check the errors 
            if($this->dbResult->error){
            echo($this->dbResult->error);
            exit;
           }
         //sql execute 
         $sqlResult = $this->dbResult->query($sqlSelect);

          //check the number of rows
          $nor = $sqlResult->num_rows;

          $total=0;

          //get the session stord product ID array
          if (isset($_SESSION['cart'])){
          $product_id = array_column($_SESSION['cart'], 'product_Id');

          if($nor > 0){
            while($rec = $sqlResult->fetch_assoc()){
                foreach ($product_id as $id){
                    if ($rec['product_Id'] == $id){
                            $total= $total+(int)$rec['product_Price'];
                            $_SESSION['total'] = $total;
                echo('<form action="cart.php" method="post">
                     <div class="border rounded mt-3">
                        <div class="row">
                            <div class="col-md-3 pl-0">
                                <img src="../'.$rec['procut_Image'].'" alt="Image1" style="width:180; height:180" class="img-fluid">
                            </div>
                            <div class="col-md-5">
                                <h5 class="pt-2">'.$rec['product_Name'].'</h5>
                                <small class="text-secondary">'.$rec['product_Category'].'</small>
                                <h5 class="pt-2">LKR'.$rec['product_Price'].'</h5>
                                <button type="submit" class="btn btn-danger mx-2" name="remove"><i class="far fa-trash-alt"></i>  Remove</button>
                                <input type="hidden" name="product_Id" value='.$rec['product_Id'].'>
                            </div>
                            <div class="col-md-4  py-5">
                                <div>
                                    <button type"button" class="btn bg-dark border"><i class="fas fa-minus"></i></button>
                                    <input type="text" value="1" class="form-control w-25 d-inline">
                                    <button type"button" class="btn bg-dark border"><i class="fas fa-plus"></i></button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>'
                );
            }
          }
        }
    }
          else {
            $_SESSION['total'] = 0;
            echo('
            <div class="alert alert-danger" role="alert">
            No Products Are Found!
          </div>');
          }
      }
      else {
        $_SESSION['total'] = 0;echo('
        <div class="alert alert-danger" role="alert">
        No Products Are Found!
      </div>');
      }
      
    }
    }



    ?>