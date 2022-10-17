<div class="card border-success">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h5>Rady for Tranport</h5>
            </div>
            <siv class="col-6">
                <input class="form-control mx-1 my-1" type="search" name="searchData" id="search_product" placeholder="Search Order">
            </siv>
        </div>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr class="table-warning">
                    <th scope="row">Order Id</th>
                    <td>Items</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="pro_list">
                
            </tbody>
        </table>
        
    </div>
</div>
<script>
    $(document).ready(function(){
        //send an ajax request at loading products
        $.get("../routes/order/tostore.php", function (res) {
        //display data 
        $("#pro_list").html(res);
        })

        //search emp 
        $("#search_product").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/order/tostoreserch.php",{searchData:$inputData},function(res){
                $("#pro_list").html(res);
            })
        })

        
    })

   
    function rady(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "All Products Or Raw metirials are ready!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/order/ready.php",{
                oid:oid
            },function (res) {
                if(res="ok"){
            Swal.fire(
            'Done!',
            'Your Proccess Done.',
            'success'
            )

            $.get("../routes/order/tostore.php", function (res) {
        //display data 
        $("#pro_list").html(res);
        })
                }
                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not delete order.',
                    'error')
                }
            })
        }
        });
     }

     
    function offlinepay(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to Pay this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Pay it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/order/pay_offline.php",{
                oid:oid
            },function (res) {
                if(res="ok"){
            Swal.fire(
            'Payed!',
            'Your Order payment has been Done.',
            'success'
            )

            $.get("../routes/order/tostore.php", function (res) {
        //display data 
        $("#pro_list").html(res);
        })
                }
                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not pay now.',
                    'error')
                }
            })
        }
        });
     }
    
</script>
