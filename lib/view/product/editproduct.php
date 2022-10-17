<div class="card border-danger">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h5>Edit product data</h5>
            </div>
            <siv class="col-6">
                <input class="form-control mx-1 my-1" type="search" name="searchData" id="search_product" placeholder="Search product">
            </siv>
        </div>
        <hr>
        <div id="edit">
        <form id="addProductForm"  enctype="multipart/form-data">
            <input type="hidden"id="pid" class="form-control "> 
            <div class="form-group mt-2">
                <label>Name</label>
                <input type="text" name="productName" id="productName" class="form-control" placeholder="Product Name">
            </div>
            <div class="form-group mt-2" rows="3">
            <label>Details</label>
                <textarea class="form-control" name="productDetails" id="productDetails"
                    placeholder="Description About Product" rows="3"></textarea>
            </div>
            <div class="form-group mt-2">
            <label>Category</label>
                <select class="form-select" name="productCategory" id="productCategory" placeholder="Add Picture">
                    <option value="0">Select Category</option>
                    <option value="Yard,Garden & Outdoor Living Items">Yard,Garden & Outdoor Living Items</option>
                    <option value="Kitchen, Dining & Bar Supplies">Kitchen, Dining & Bar Supplies</option>
                    <option value="Major Electric Appliances">Major Electric Appliances</option>
                    <option value="furniture">furniture</option>
                    <option value="Lamp,Lighting & Ceiling Fans">Lamp,Lighting & Ceiling Fans</option>
                    <option value="Plumbing & Fixtures">Plumbing & Fixtures</option>
                    <option value="Flowrings">Flowrings</option>
                    <option value="Bedding">Bedding</option>
                    <option value="curtains">curtains</option>
                    <option value="Home Arts">Home Arts</option>
                </select>
            </div>
            
            <div class="form-group col-md-6 mt-2">
            <label>Price</label>
                <input type="text" name="productPrice" id="productPrice" class="form-control"
                    placeholder="Selling Price LKR">
            </div>
            <div class="form-group my-2">
                            <button class="btn btn-success" onclick="editit()">Edit Data</button>

                            <button class="btn btn-secondary" onclick="backlist()">Product List</button>
                        </div>
        </form>
        </div>

        <div id="list">
        <table class="table table-hover">
            <thead>
                <tr class="table-success outline-primary">
                    <th scope="row">Pro Id</th>
                    <td>product pic</td>
                    <td>product Name</td>
                    <td>Product price</td>
                    <td>product category</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="pro_list">
                
            </tbody>
        </table>
    </div>  
    </div>
</div>
<script>
    $(document).ready(function(){
        //hide edit part
        $('#edit').hide();
    
        //send an ajax request at loading products
        $.get("../routes/products/pro_list.php", function (res) {
        //display data 
        $("#pro_list").html(res);
        })

        //search emp 
        $("#search_product").on('input',function(){
            $inputData = $(this).val();

            //send an ajax request 
            $.get("../routes/products/prosearch.php",{searchData:$inputData},function(res){
                $("#pro_list").html(res);
            })
        })
    })

    function delete_pro(oid){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do You want to delete this Item permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/products/delete_pro.php",{
                uid:oid
            },function (res) {
                if(res="ok"){
            Swal.fire(
            'Successful!',
            'Your Deleted Product.',
            'success'
            )
            //reload list
            $.get("../routes/products/pro_list.php", function (res) {
                //display data 
                $("#pro_list").html(res);
                })
                }
                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not delete Product.',
                    'error')
                }
            })
        }
        });
     }


     //this is product edit function
     function edit(uid){
         $userid = uid;

        $('#list').hide();
        $('#edit').show();

        $.get("../routes/products/getprodata.php", {
        uid:uid
        }, function (res) {
        var jdata = jQuery.parseJSON(res);
            $("#pid").val(jdata.product_Id);
            $("#productName").val(jdata.product_Name);
            $("#productDetails").val(jdata.product_Details);
            $("#productCategory").val(jdata.product_Category);
            $("#productPrice").val(jdata.product_Price);
          
           
        })
     }

     function backlist(){
        $('#list').show();
        $('#edit').hide();
     }

     function editit(){
            $uid = $("#pid").val();
            $name = $("#productName").val();
            $details = $("#productDetails").val();
            $cat = $("#productCategory").val();
            $price = $("#productPrice").val();

        Swal.fire({
        title: 'Are you sure?',
        text: "Did You want to edit this Product details!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Edit it!'
        }).then((result) => {
        if (result.isConfirmed) 
        {
            $.get("../routes/products/editdata.php",{
                id: $uid,
                un: $name,
                de: $details,
                ca: $cat,
                pc: $price
            },function (res) {
                if(res="ok"){
            Swal.fire(
            'Successful!',
            'Your Edit Done.',
            'success'
            )
            $('#list').show();
            $('#edit').hide();
            
            //reload product list
            $.get("../routes/products/pro_list.php", function (res) {
                //display data 
                $("#pro_list").html(res);
                })
                }

                else{
                    Swal.fire(
                    'Somethin Wrong',
                    'Can not edit data.',
                    'error')

                    $('#list').show();
                    $('#edit').hide();
                }
               
            })
        }
        });
    }

</script>
