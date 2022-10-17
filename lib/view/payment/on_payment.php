<div class="card py-4 px-4" sytle="border-radius:20px;">
    <h4>Add Your Card Details</h4>
    <img src="../../upload/paymentLogo.png" style="height:40px; width:300px; margin-left: auto;
  margin-right: auto;">
    <div class="form-group px-5">
      <label class="form-label mt-2 ">Card Number</label>
      <input type="card_Number" class="form-control" id="card_Number" name="card_Number" placeholder="1234 5678 9012 3456">
    </div>
    <div class="form-group px-5">
      <label class="form-label mt-2 ">Name On Card</label>
      <input type="card_Name" class="form-control" id="card_Name" name="card_Name" placeholder="Ex  Jone Smith">
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group px-5">
                <label class="form-label mt-2 ">Expiry date</label>
                <input type="card_Ed" class="form-control" id="card_Exd" name="card_Exd" placeholder="01/23">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group px-5">
                <label class="form-label mt-2 ">Security code</label>
                <input type="password" class="form-control" id="card_key" name="card_Key" placeholder="***">
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function(){
    let input1 = document.querySelector("#card_Number");
    let input2 = document.querySelector("#card_Name");
    let input3 = document.querySelector("#card_Exd");
    
    input1.addEventListener("change", stateHandle);
    input2.addEventListener("change", stateHandle);
    input3.addEventListener("change", stateHandle);

    
    function stateHandle() {
      if (document.querySelector("#card_Number").value === "" ||
          document.querySelector("#card_Name").value === "" ||
          document.querySelector("#card_Exd").value === ""
          ) {
        $("#next2").attr('class', "btn btn-success disabled");
      } else {
        $("#next2").attr('class', "btn btn-success");
      }
    }
   });
</script>