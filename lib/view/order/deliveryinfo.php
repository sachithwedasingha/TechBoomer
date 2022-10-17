<div class="card border-success">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h5>View all Order Delivery Info</h5>
            </div>
            <siv class="col-6">
                <input class="form-control mx-1 my-1" type="search" name="searchData" id="search_product" placeholder="Search Order">
            </siv>
        </div>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr class="table-success">
                    <th scope="row">Order Id</th>
                    <td>Date</td>
                    <td>Payment</td>
                    <td>Conformed</td>
                    <td>Transport</td>
                    <td>Deliverd</td>
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
        $.get("../routes/order/viewallorders_delivery.php", function (res) {
        //display data 
        $("#pro_list").html(res);
        })

        //search emp 
        $("#search_product").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/order/viewallserchorders_delivery.php",{searchData:$inputData},function(res){
                $("#pro_list").html(res);
            })
        })

        
    })

   
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
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )

            $.get("../routes/order/viewallorders_delivery.php", function (res) {
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
    
</script>
