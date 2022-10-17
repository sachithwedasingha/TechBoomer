<?php
//start the session
session_start();


//link app/php file
include_once('../layout/app.php');
//link navBar
include_once('../layout/top Nav_cart.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cart</title>
</head>

<body onload="FetchAll()">
    <div class="container">
        <div class="row">
            <div class="col-md-9" id="cartItem" style="margin-top:20px">
                <h6>My Cart</h6>
                <img src="../upload/ui/07.png" width="200px" style="display: block; margin-left: auto; margin-right: auto; margin-top:100px; margin-bottom:20px;" alt="">

            </div>
            <div class="col-md-3 mt-5" style="margin-top:20px;border-radius:10px">
                <div class="card border-success mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title px-2">Order Summary</h4>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group list-group-flush">
                                    <!-- <li class="list-group-item"><h6>Subtotal</h6></li> -->
                                    <li class="list-group-item my=1"><h6>Delivery</h6></li>
                                    <li class="list-group-item"><h6>Total</h6></li>
                            </div>
                            <div class="col-6">
                                <ul class="list-group list-group-flush">
                                    <!-- <li class="list-group-item"><h6 id="carttotal" style="display: inline;"></h6 style="display: inline;"> LKR</li> -->
                                    <li class="list-group-item"><h6 style="color: green;">FREE</h6></li>
                                    <li class="list-group-item"><h6 id="carttotal" style="display: inline;"></h6 style="display: inline;"> LKR</li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row py-3 px-3">
                            <button type="button" class="" id="buy">BUY</button>
                        </div>

                    </div>
                </div>
            </div>
            <input class="form-control mx-1 my-1" type="hidden" value="<?php
                                    //chek the user session
                                  if(empty($_SESSION['user_id'])){}

                                  else{print_r($_SESSION['user_id']);}?>" id="input_user_id">
            <div class="row text-center py-5" id="cart">
            </div>

        </div>
</body>

</html>

<script>
    //login status
    //user accunt handeling
    $userid = $("#input_user_id").val();

    //chek user loged or not
    if ($userid == "") {
        $("#btn_user").hide();
    } else {
        $("#btn_sign").hide();
    }

    //display all items in the cart

    function FetchAll() {

        buy_button();

        var cartResult = document.getElementById('cartItem');
    
        var carttotal = document.getElementById('carttotal');
        var cart = JSON.parse(localStorage.getItem('cart'));
        cartResult.innerHTML = "";
        carttotal.innerHTML = "0";

        for (var i = 0; i < cart.length; i++) {
            var name = cart[i].productname;
            var id = cart[i].productid;
            var image = cart[i].productimage;
            var price = cart[i].productprice;
            var dis = cart[i].productprice;
            var count = cart[i].productcount;
            //add one more

            cartResult.innerHTML +=
                '<div class="border rounded mt-3"> <div class="row"> <div class="col-3">' +
                '<img src="../' + image + '" alt="Image1" style="width:180; height:180" class="img-fluid">' +
                '</div> <div class="col-5">' +
                '<h5 class="pt-2">' + name + '</h5>' +
                '<small class="text-secondary">' + dis + '</small>' +
                '<h5 class="pt-2">LKR' + price + '</h5>' +
                '<button type="submit" onclick="deleteitem(\'' + id +
                '\')" class="btn btn-danger mx-2"><i class="far fa-trash-alt"></i>  Remove</button>' +
                '</div> <div class="col-4  py-5">' +
                '<div>' +
                '<button type="button" onclick="minusitem(\'' + id +
                '\')" class="btn bg-dark border"><i class="fas fa-minus"></i></button>' +
                '<input type="text" style="text-align:center;" value="' + count + '" class="form-control w-25 d-inline mx-2">' +
                '<button type="button" onclick="plusitem(\'' + id +
                '\')" class="btn bg-dark border"><i class="fas fa-plus"></i></button>' +

                '</div></div></div></div></div>';
            carttotal.innerHTML = (parseInt(carttotal.innerHTML) + parseInt(price) * parseInt(count)).toFixed(2);
        };

    }

    function buy_button() {
        //if cart items are empty desable the buy button
        var tempcart = JSON.parse(localStorage.getItem('cart'));

        if (localStorage.getItem('cart') === null) {
            $("#buy").attr('class', "btn btn-danger disabled");
        } else if (tempcart.length == 0) {
            $("#buy").attr('class', "btn btn-danger disabled");
        } else {
            $("#buy").attr('class', "btn btn-danger");
        }
    }

    //delete cart items
    function deleteitem(id) {
        var cart = JSON.parse(localStorage.getItem('cart'));
        for (let i = 0; i < cart.length; i++) {
            if (cart[i].productid == id) {
                cart.splice(i, 1);
            }

        }
        localStorage.setItem('cart', JSON.stringify(cart));
        FetchAll();
    }

    //increes the item count
    function plusitem(id) {

        
        var cart = JSON.parse(localStorage.getItem('cart'));
        for (let i = 0; i < cart.length; i++) {
            if (cart[i].productid == id) {
                //create object
//chek databace balance
$.get("../routes/products/getquent.php", {
pid: id
}, function (res1) {
$check=res1;
})

if((parseInt(cart[i].productcount) + 1)<$check){

                var item = {
                    productid: cart[i].productid,
                    productname: cart[i].productname,
                    productimage: cart[i].productimage,
                    productprice: cart[i].productprice,
                    productdis: cart[i].productprice,
                    productcount: parseInt(cart[i].productcount) + 1,

                }
            }else{
                var item = {
                    productid: cart[i].productid,
                    productname: cart[i].productname,
                    productimage: cart[i].productimage,
                    productprice: cart[i].productprice,
                    productdis: cart[i].productprice,
                    productcount: cart[i].productcount,

                }
                Swal.fire('There are no moreitems in our Stock!');
            }
                cart.splice(i, 1);
            
            }

        }
        localStorage.setItem('cart', JSON.stringify(cart));


        cart.push(item);
        //Re-set localstorage
        localStorage.setItem('cart', JSON.stringify(cart));
        FetchAll();
        
    }

    //decrees the item count
    function minusitem(id) {
        var cart = JSON.parse(localStorage.getItem('cart'));
        for (let i = 0; i < cart.length; i++) {
            if (cart[i].productid == id) {

                if (cart[i].productcount > 1) {
                    var item = {
                        productid: cart[i].productid,
                        productname: cart[i].productname,
                        productimage: cart[i].productimage,
                        productprice: cart[i].productprice,
                        productdis: cart[i].productprice,
                        productcount: parseInt(cart[i].productcount) - 1,
                    }
                } else {
                    var item = {
                        productid: cart[i].productid,
                        productname: cart[i].productname,
                        productimage: cart[i].productimage,
                        productprice: cart[i].productprice,
                        productdis: cart[i].productprice,
                        productcount: cart[i].productcount,
                    }
                }

                cart.splice(i, 1);
            }

        }
        localStorage.setItem('cart', JSON.stringify(cart));


        cart.push(item);
        //Re-set localstorage
        localStorage.setItem('cart', JSON.stringify(cart));
        FetchAll();
    }

    //press buy button
    $('#buy').click(function () {
        $userid = $("#input_user_id").val();
        $total = $("#carttotal").text();

        //chek user loged or not
        if ($userid == "") {
            //set rederect location
            document.cookie = "location='location:../view/cart'";

            window.location.href = 'login.php';

        } else {
            //add user detail to local storage
            var item = {
                userid: $userid,
                total: $total,
            }
            if (localStorage.getItem('order') === null) {
                //careate java script array
                var order = [];
                //push data to array
                order.push(item);
                //set the locsl storage
                localStorage.setItem('order', JSON.stringify(order));
            } else {
                var order = JSON.parse(localStorage.getItem('order'));
                for (var i = 0; i < order.length; i++) {
                    var userid = order[i].userid;

                    if (userid === item.userid) {
                        order.splice(i, 1);
                    }
                }
                order.push(item);
                //Re-set localstorage
                localStorage.setItem('order', JSON.stringify(order));
            }

            //rederect the nect page
            window.location.href = 'order_final.php';
        }


    });
</script>