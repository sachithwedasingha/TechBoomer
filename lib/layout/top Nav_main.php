<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top navbar-scrooll" data-spy="affix"
  data-offset-top="197">
  <div class="container-fluid">
    <img src="lib/upload/ui/logo.png" style="height:62px">
    <a class="navbar-brand" href="#" style="color:blue"><b>TECH BOOMER</b></a>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
        </li>
        <li class="nav-item" id="btn_sign">
          <a class="nav-link" href="lib/view/login.php">Sign In</a>
        </li>
        <li class="nav-item" id="btn_reg">
          <a class="nav-link" href="lib/view/register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lib/view/about.php">About</a>
        </li>
        <!-- Drop Down List in Navigation Bar -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false"> All Categories</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#" id="catselect">Yard,Garden & Outdoor Living Items</a>
            <a class="dropdown-item" href="#" id="catselect1" >Kitchen, Dining & Bar Supplies</a>
            <a class="dropdown-item" href="#" id="catselect2">furniture</a>
            <a class="dropdown-item" href="#" id="catselect3">Lamp,Lighting & Ceiling Fans</a>
            <a class="dropdown-item" href="#" id="catselect4">Plumbing & Fixtures</a>
            <a class="dropdown-item" href="#" id="catselect5">Flowrings</a>
            <a class="dropdown-item" href="#" id="catselect6">Bedding</a>
            <a class="dropdown-item" href="#" id="catselect7">curtains</a>
            <a class="dropdown-item" href="#" id="catselect8">Home Arts</a>
          </div>
        </li>
      </ul>
      <!-- Search bar in Navigation Bar -->  
        <form class="d-flex my-0 mx-1">
          <input class="form-control mx-1 my-0" type="search" name="searchData" id="searchData" placeholder="search">
        </form>
        <a href="lib/view/cart.php" class=" my-0 mx-0">
          <button type="submit" name="cart" id="cart" class="btn btn-warning my-0 mx-1">
            <i class="fas fa-shopping-cart"></i>
            <span id='cart_count' style="text-color:white; font-size:20px;" class=''></span>
          </button>
        </a>
        <ul class="navbar-nav">
        <li class="nav-item dropdown" id="btn_user">
          <a class="nav-link dropdown-toggle dropstart" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false"><i class="far fa-user" style="color:#47DBF3"></i></a>
            <div class="dropdown-menu" id="drop0001">
            <!-- style="top: 55;right: -40; margin-top: 0.25rem; margin-right: 2rem;" -->
            <a class="dropdown-item" href="#">My Account</a>
            <a class="dropdown-item" href="lib/view/design.php">My Orders</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="lib/function/logout.php" style="color:red"><i
                class="fas fa-sign-out-alt"></i>Sign Out</a>        
          </div>
        </li>     
      </ul>
    </div>
  </div>
</nav>