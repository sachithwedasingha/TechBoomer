<?php
//lets include suderFunction page
include_once('../function/userFunction.php');
include_once('../layout/app.php');
if(isset($_POST['btnLogin'])){

$userObj = new User();

$result = $userObj -> Authentication($_POST['userName'],$_POST['userPwd']);
 
echo($result);

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
</head>

<body>
    <section class="form my-5 mx-5">   
        <div class="container">    
        <div class="card border-secondary" id="logincard">   
            <div class="row">
                      
                <div class="col-lg-5">
                    <img src="../upload/ui/login.jpg" class="img-fluid" id="lofinImage">
                </div>
                <div class="col-lg-6 px-5 pt-4">
                    <h1 class="font-weught-bold py-3">Sign in</h1>
                    <form action="" method="post">
                        <div class="form-row">
                            <label for="">UserName</label>
                            <input type="email" name="userName" id="userName" class="form-control my-3"
                                placeholder="Email-Address">
                        </div>
                        <div class="form-row">
                            <label for="">Passwprd</label>
                            <input type="password" name="userPwd" id="userPwd" class="form-control my-3"
                                placeholder="******">
                        </div>
                        <div class="form-row">
                            <input type="submit" value="Login" class="btn btn-success" name="btnLogin">
                            <input type="reset" value="Clear" class="btn btn-outline-danger">
                            <a href="../../index.php">
                                <button type="submit" name="add" class="btn btn-secondary ">
                                 <i class="fas fa-home"></i>Home</bitton>
                            </a>
                        </div>
                        <a href="#">Fogot Password?</a>
                        <p>Don't have an account?  <a href="register.php"> Regiter here</a></p>
                    </form>


                </div>
                </div> 
            </div>
            </div>
        
    </section>
</body>

</html>