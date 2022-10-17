<div class="card border-success">
    <div class="card-body">
        <h5>Add New Product</h5>
        <hr>
        <form id="addProductForm"  enctype="multipart/form-data">
            <div class="form-group mt-2">
                <input type="text" name="productName" id="productName" class="form-control" placeholder="Product Name">
            </div>
            <div class="form-group mt-2" rows="3">
                <textarea class="form-control" name="productDetails" id="productDetails"
                    placeholder="Description About Product" rows="3"></textarea>
            </div>
            <div class="form-group mt-2">
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
            <div class="form-group mt-2">
                <input class="form-control mt2" type="file" id="productImg" name="productImg">
                <img src="" alt="" id="imgPrev" height="200" widh="400">
            </div>
            <div class="form-group col-md-6 mt-2">
                <input type="text" name="productPrice" id="productPrice" class="form-control"
                    placeholder="Selling Price LKR">
            </div>
            <div class="form-group col-md-5 mt-2">
                <input type="text" name="productQuantity" id="productQuantity" class="form-control"
                    placeholder="Quantity">
            </div>
            <h5>Add stock details</h5>
            <hr>
            <div class="form-group col-md-6 mt-2">
                <select class="form-select" name="productSection" id="productSection" placeholder="Add Picture">
                    <option value="0">Select Section</option>
                    <option value="01">Section 1</option>
                    <option value="02">Section 2</option>
                    <option value="03">Section 3</option>
                    <option value="04">Section 4</option>
                    <option value="05">Section 5</option>
                </select>
            </div>
            <div class="form-group col-md-6 mt-2">
                <select class="form-select" name="productRow" id="productRow" placeholder="Add Picture">
                    <option value="0">Select Row</option>
                    <option value="01">Row 01</option>
                    <option value="02">Row 02</option>
                    <option value="03">Row 03</option>
                    <option value="04">Row 04</option>
                </select>
            </div>
            <div class="form-group col-md-6 mt-2">
                <select class="form-select" name="productColume" id="productColume" placeholder="Add Picture">
                    <option value="0">Select Colume</option>
                    <option value="01">Colume 01</option>
                    <option value="02">Colume 02</option>
                    <option value="03">Colume 03</option>
                    <option value="04">Colume 04</option>
                </select>
            </div>
            <div class="form-group col-md-6 mt-2">
                <select class="form-select" name="productLevel" id="productLevel" placeholder="Add Picture">
                    <option value="0">Select Level</option>
                    <option value="01">Level 01</option>
                    <option value="02">Level 02</option>
                    <option value="03">Level 03</option>
                    <option value="04">Level 04</option>
                </select>
            </div>
            <div class="form-group col-md-6 mt-2">
                <input type="text" name="productQuantityWH" id="productQuantityWH" class="form-control"
                    placeholder="How many items in Wearhouse">
            </div>
            <div class="form-group mt-2">
                <button id="btnAddProduct" class="btn btn-success">Add Product</button>
            </div>
        </form>
    </div>
</div>

<script>

    // sample image privive 
    $("#productImg").change(function(){
        var fileRead = new FileReader();
        fileRead.onload = function(e){
            $("#imgPrev").attr('src',e.target.result);
            $("#imgPrev").attr('style',"height:200px;widh:400px");
        }
        fileRead.readAsDataURL(this.files[0]);
    })

    // data submition
    $(document).on('click','#btnAddProduct',function(e){
        e.preventDefault();
        var form = $("#addProductForm")[0];

        var formData = new FormData(form);

        $.ajax({
            url:"../routes/products/addproduct.php",
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                swal.fire(data);
            },
            error: function (data) {
                swal.fire(data);
            }
            
        });
    });

</script>
