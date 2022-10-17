
<div class="container" style="background-color:white;  color: black;">
    <div class="row pt-3">
        <br>
        <img src="../upload/invoice/head.jpg" alt="">
    </div>
    <hr style="height: 3px;">
    <h5 class="py-3" style="text-align:center">Customer Recipt</h5>
<!-- <input type="text" value=""> -->

<div class="row"><div class="col-3"><h6>Service Number:</h6></div><div class="col-3"><h6 id="id"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Date:</h6></div><div class="col-3"><h6 id="date"></h6></div></div>
    <div class="row"><div class="col-3"><h6>User Id:</h6></div><div class="col-3"><h6 id="name"></h6></div></div>
    <div class="row"><div class="col-3"><h6>Payment:</h6></div><div class="col-3"><h6>Online</h6></div></div>
     
     
     

    <table class="center mt-5" style="text-align:center; width:80%; border: 1px solid;margin-left: auto; margin-right: auto;">
    <tr>
            <th>Design Id</th>
            <th>width</th>
            <th>height</th>
            <th>unit price</th>
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
            <h6>...............................</h6>
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
                var data = JSON.parse(localStorage.getItem('service'));
                    $total = (data[0].total);

            var meshResult = document.getElementById('mesh_list');
            var meshs = JSON.parse(localStorage.getItem('meshs'));
            meshResult.innerHTML = "";
           

            for (var i = 0; i < meshs.length; i++) {
            var did = meshs[i].designid;
            var width = meshs[i].width;
            var height = meshs[i].height;
            var uniprice = meshs[i].unitprice;
            

            
            meshResult.innerHTML += 
                '<tr>' +
                '<td>' + did + '</dh>' +
                '<td>' + width + '</td>' +
                '<td>' + height + '</td>' +
                '<td>' + uniprice + '</td>'+
                '</tr>';
            // total.innerHTML = parseInt(total.innerHTML)+stl;
            

            }
            meshResult.innerHTML += 
                '<tr>' +
                '<th colspan="3">Total (LKR)</th>' +
                '<td>' + $total + '</td>'+
                '</tr>';

                var today = new Date();
                var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                    $('#id').text(localStorage.getItem('orderid'));

                    var data = JSON.parse(localStorage.getItem('meshs'));
                    $('#name').text(data[0].userid);
                    $('#date').text(date);
            }

     })



</script>