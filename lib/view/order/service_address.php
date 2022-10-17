<div class="card py-4 px-4" sytle="border-radius:20px;">
  <h4>Add Your Delivery Infomation</h4>
  <form action="">
    <div class="form-group px-5 ">
      <label class="form-label mt-2 ">Name You want to add the Address</label>
      <input type="email" class="form-control" id="address_Name" name="address_Name" placeholder="Name">
    </div>
    <div class="form-group px-5">
      <label class="form-label mt-2 ">Address Number</label>
      <input type="email" class="form-control " id="address_Number" name="address_Name" placeholder="Number">
    </div>
    <div class="form-group px-5">
      <label class="form-label mt-2 ">Address Lane</label>
      <input type="email" class="form-control" id="address_Lane" name="address_Name" placeholder="Lane">
    </div>
    <div class="form-group px-5">
      <label class="form-label mt-2 ">Address Town</label>
      <input type="email" class="form-control" id="address_Town" name="address_Name" placeholder="Town">
    </div>
    <div class="form-group px-5">
      <label class="form-label mt-2 ">District</label>
      <select class="form-select" id="address_Dis">
        <option>Select District</option>
        <option value="Colombo">Colombo</option>
        <option value="Gampaha">Gampaha</option>
        <option value="Kalutara">Kalutara</option>
        <option value="Gampaha">Gampaha</option>
        <option value="Kandy">Kandy</option>
        <option value="Nuwara Eliya">Nuwara Eliya</option>
        <option value="Galle">Galle</option>
        <option value="Matara">Matara</option>
        <option value="Hambantota">Hambantota</option>
        <option value="Jaffna">Jaffna</option>
        <option value="Kilinochchi">Kilinochchi</option>
        <option value="Mannar">Mannar</option>
        <option value="Vavuniya">Vavuniya</option>
        <option value="Mullaitivua">Mullaitivu</option>
        <option value="Batticaloa">Batticaloao</option>
        <option value="Ampara">Ampara</option>
        <option value="Trincomalee">Trincomalee</option>
        <option value="Kurunegala">Kurunegala</option>
        <option value="Puttalam">Puttalam</option>
        <option value="Anuradhapura">Anuradhapura</option>
        <option value="Polonnaruwa">Polonnaruwa</option>
        <option value="Badulla">Badulla</option>
        <option value="Moneragala">Moneragala</option>
        <option value="Ratnapura">Ratnapura</option>
        <option value="Kegalle">Kegalle</option>
      </select>
    </div>

  </form>

</div>

<script>
  $(document).ready(function(){

    loadaddress();

function loadaddress() {
    var service = JSON.parse(localStorage.getItem('service'));
    var userid = service[0].userid;

    $.get("../routes/address/getaddress.php", {
        uid: userid
    }, function (res) {
        var jdata = jQuery.parseJSON(res);

        $("#address_Name").val(jdata.address_Name);
        $("#address_Number").val(jdata.address_Number);
        $("#address_Lane").val(jdata.address_Lane);
        $("#address_Town").val(jdata.address_Town);
        $("#address_Dis").val(jdata.address_district);
        
    })
}



    let input1 = document.querySelector("#address_Name");
    let input2 = document.querySelector("#address_Number");
    let input3 = document.querySelector("#address_Lane");
    let input4 = document.querySelector("#address_Town");
    let input5 = document.querySelector("#address_Dis");

    input1.addEventListener("change", stateHandle);
    input2.addEventListener("change", stateHandle);
    input3.addEventListener("change", stateHandle);
    input4.addEventListener("change", stateHandle);
    input5.addEventListener("change", stateHandle);

    function stateHandle() {
      if (document.querySelector("#address_Name").value === "" ||
          document.querySelector("#address_Number").value === "" ||
          document.querySelector("#address_Lane").value === "" ||
          document.querySelector("#address_Town").value === "" ||
          document.querySelector("#address_Dis").value === "" 
          ) {
        $("#next1").attr('class', "btn btn-success disabled");
      } else {
        $("#next1").attr('class', "btn btn-success");
      }
    }
  })
</script>