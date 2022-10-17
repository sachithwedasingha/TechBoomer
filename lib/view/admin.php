<?php
session_start();

if(empty($_SESSION['login_email'])){
//redirect user backto login
header('location:login.php');

}

//link app/php file
include_once('../layout/app.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <Table> TECH BOOMER Admin</Table>
  </title>
</head>

<body onload="myFunction()">
  <!-- start side bar -->
  <div class="page-wrapper chiller-theme toggled">
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="" #style="color:red">TECH BOOMER</a>
          <div id="close-sidebar">
            <i class="fas fa-chevron-left"></i>
          </div>
        </div>
        <!-- show user Details  -->
        <div class="sidebar-header" id="show_current_user">
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
          <div>
            <!-- <div class="input-group">
              <input type="text" class="form-control search-menu" placeholder="Search...">
              
            </div> -->
          </div>
        </div>
        <!-- sidebar-Content  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>Manage</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-users"></i>
                <span>customer</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a id="add_Customer">Add Customer</a>
                  </li>
                  <li>
                    <a id="edit_Customer">Edet Customer</a>
                  </li>
                  <li>
                    <a id="activate_Customer">Activate Customer</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-user-md"></i>
                <span>Employer</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a id="add_employer">Add Employer</a>
                  </li>
                  <li>
                    <a id="edit_employer">Edet Employer</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="far fa-gem"></i>
                <span>Products</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a id="add_product">Add Product</a>
                  </li>
                  <li>
                    <a id="add_product_more">Add More Product Details</a>
                  </li>
                  <li>
                    <a id="edit_product">Edit Product</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
              <i class="fas fa-shopping-bag"></i>
                <span>Manage Order</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#" id="viewallorders">All Orders</a>
                  </li>
                  <li>
                    <a href="#" id="deliveryifo">Delivery Information</a>
                  </li>
                  <li>
                    <a href="#" id="offlinepay">Offline Payment</a>
                  </li>
                  <li>
                    <a href="#" id="ordercontamation">Order Confamation</a>
                  </li>
                  <li>
                    <a href="#" id="storrady">Rady to Tranport</a>
                  </li>
                  <li>
                    <a href="#" id="deliverd">Deliverd</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fas fa-project-diagram"></i>
                <span>Reports</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="invoice/Total income.php">Total Income</a>
                  </li>
                  <li>
                    <a href="invoice/income selected time period.php">Product Income (selected time)</a>
                  </li>
                  <li>
                    <a href="invoice/order report.php">Order Report</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="header-menu">
              <span>Extra</span>
            </li>
            <li>
              <a href="../../index.php">
                <i class="fa fa-home"></i>
                <span>Visit Home Page</span>
              </a>
            </li>

            <li>
              <a id="bin">
              <i class="fas fa-trash"></i>
                <span>Trash</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- End sidebar-menu  -->
      </div>
    </nav>
    <!-- rop Nav bar -->
    <main class="page-content pt-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-0">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
              <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fas fa-bars"></i>
              </a>
            </ul>
          </div>
          <div class="col-2" id="navbarColor02">
            <ul class="navbar-nav me-auto">
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                  aria-haspopup="true" aria-expanded="false"><i class="far fa-user" style="color:#47DBF3"></i></a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">My Account</a>
                  <!-- <a class="dropdown-item" href="#">Settings</a> -->
                  <a class="dropdown-item" href="../function/logout.php" style="color:red"><i
                      class="fas fa-sign-out-alt"></i>Sign Out</a>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- content top 4 cardsS -->
      <div class="container-fluid">
        <div class="row">
          <div class="row py-0 px-3">
            <div class="col-3">
              <div class="card shadow card border-shadow h-100 py-3 px-2 " id="cardadmin01">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Products Count
                    </div>
                    <div class="h5 mb-0 text-gray-800" id="admin_product_count"></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-box fa-2x"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card shadow card border-shadow h-100 py-3 px-2" id="cardadmin02">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User Count
                    </div>
                    <div class="h5 mb-0 text-gray-800" id="admin_user_count"></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users  fa-2x"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card shadow card border-shadow h-100 py-3 px-2" id="cardadmin03">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Onging Projects
                    </div>
                    <div class="h5 mb-0 text-gray-800" id="admin_service_count">12</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-drafting-compass fa-2x"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card shadow card border-shadow h-100 py-3 px-2" id="cardadmin04">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending
                      Orders
                    </div>
                    <div class="h5 mb-0 text-gray-800" id="admin_order_count">12</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-8 py-0 my-0" id="adminloadContent" style=" display: block;    height: 450px; overflow-y: scroll;">
        <img src="../upload/ui/05.png" width="400px" style="display: block; margin-left: auto; margin-right: auto; margin-top:100px; margin-bottom:20px;" alt="">
          
        </div>
        <div class="col-4" id="adminloadContentSide">

        </div>
      </div>
  </div>
  </main>
  </div>
</body>
    <script>
      // $('#adminloadContentSide').load('user/userlist.php');

    
    </script>
</html>