<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../upload/invoice/head.jpg" alt="">
    </div>
    <hr style="height: 3px;">
    <h5 class="py-3" style="text-align:center">Customer Recipt</h5>
    <?php
// $id=$_GET['id'];
// echo($id);
// ?>
    <div class="row"><div class="col-3"><h6>Order Number:</h6></div><div class="col-3"><h6 id="id"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    <div class="row"><div class="col-3"><h6>User Id:</h6></div><div class="col-3"><h6 id="name"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Payment:</h6></div><div class="col-3"><h6>Online</h6></div></div>
     
     
     

    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
        <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Quentity</th>
            <th>Price</th>
        </tr>
        <tbody id="mesh_list">
        <!-- <tr>
            <td>PRO0001</td>
            <td>Table</td>
            <td>2</td>
            <td>50000</td>
        </tr>
        <tr>
            <th colspan="3">Total (LKR)</th>
            <th>100000</th>
        </tr> -->
        </tbody>
    </table>
    <br><br><br><br>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <h6>.......................</h6>
            <h6> Signature</h6>
            <br><br><br>
        </div>
    </div>
</div>
<div class="no-print">
<button type="button" class="btn btn-secondary my-3" onclick="window.print();"><i class="fas fa-print"></i>Print</button>
</div>
<script>
     $(document).ready(function(){
         FetchAll();
            function FetchAll() {
            var meshResult = document.getElementById('mesh_list');
            var meshs = JSON.parse(localStorage.getItem('cart'));
            meshResult.innerHTML = "";
            $total= 0;

            for (var i = 0; i < meshs.length; i++) {
            var id = meshs[i].productid;
            var name = meshs[i].productname;
            var count = meshs[i].productcount;
            var price = meshs[i].productprice;
            

            
            meshResult.innerHTML += 
                '<tr>' +
                '<td>' + id + '</dh>' +
                '<td>' + name + '</td>' +
                '<td>' + count + '</td>' +
                '<td>' + price + '</td>'+
                '</tr>';
            // total.innerHTML = parseInt(total.innerHTML)+stl;
            $total= $total + (parseInt(count)*parseInt(price));

            }
            meshResult.innerHTML += 
                '<tr>' +
                '<th colspan="3">Total (LKR)</th>' +
                '<td>' + $total + '</td>'+
                '</tr>';

                var today = new Date();
                var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                    $('#id').text(localStorage.getItem('orderido'));

                    var data = JSON.parse(localStorage.getItem('order'));
                    $('#name').text(data[0].userid);
                    $('#date').text(date);
            }

     })



</script>