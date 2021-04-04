<?php
//require_once("lib/common.php");
if(isset($_GET["cusid"])){
    $cus_id = $_GET["cusid"];
    
}
?>
<script type="text/javascript">
     $(document).ready(function(){
         // ---------------------------- Date Select
        $("#bdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"-6575"
        });
         // ---------------------------- Customer profile details loading

         var cusid = $("#cus_id").val();
         var url = "lib/mod_cus.php?type=viewCusProfile";


         $.ajax({
            method:"POST",
            url:url,
            data:{cusid:cusid},
            dataType:"json",

            success:function(result){

                $("#fname").val(result.cus_fname);
                 $("#lname").val(result.cus_lname);
                 $("#email").val(result.cus_email);
                 $("#cus_address").html(result.line1+"<br> "+result.line2+"<br> "+result.city+" <br>"+result.district+"<br> "+result.province);
                 $("#mobile").val(result.cus_mobile);
                 var gender =result.cus_gender;
                 if(gender=="1"){
                     $("#male").attr('checked',true);
                 }else {
                     $("#female").attr('checked',true);
                 }
                 //$("#txt-nic").val(result.emp_nic);
                 $("#bdate").val(result.cus_dob);

            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
         });

         // ---------------------------- Function for back button to load view
         $("#btn-back").click(function () {
            $("#view_cus").click();
         });

         // ---------------------------- Edit function

         
         // ---------------------------- cancel profile view
         $("#btn-cancel").click(function () {
             $("#view_cus").click();
         });
     });
 </script>
 
 <div>
     <div class="breadcrumb bg-gray-200 ">
         <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a href="#" onclick="funViewCus()" class="text-dark"> Customers Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a  class="text-primary"> View profile</a> </li>

     </div>

<div class="modal-dialog modal-xl" role=document>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="h3">View Profile</h3>
        </div>
        <div class="modal-body">
            <form>
            <div class="row" >

                <div class="col-lg-8 col-sm-10 ">

                    <div class="row ">
                        <label class="col-form-label-sm col-2">Employee ID </label>:
                        <div class="form-group col-lg-2">
                            <input type="text"  disabled class="form-control-plaintext form-control-sm " name="cus_id" id="cus_id" value="<?php echo($cus_id)  ?>">
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-form-label-sm col-2">Full Name</label>:
                        <div class="form-group col-lg-3">
                            <input type="text" disabled class=" emp-select form-control-plaintext form-control-sm" name="fname" id="fname">
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="text" disabled class="emp-select readonly form-control-plaintext form-control-sm" name="lname" id="lname">
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-2">Email </label>:
                        <div class="form-group col-lg-8">
                            <input type="email" disabled class="emp-select form-control-plaintext form-control-sm" name="email" id="email"> 
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-2">Address </label>:
                        <div class="form-group col-lg-8">
                            <!-- <textarea id="cus_address" class="emp-select form-control-plaintext form-control-sm">
                                
                            </textarea> -->
                            <div id="cus_address">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-form-label-sm col-2">Contact No </label>:
                        <div class="form-group col-lg-4">
                            <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" name="mobile" id="mobile">
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-form-label-sm col-2">Gender</label>:
                        <div class="form-group ml-3 radio-inline"> <!-- for align button and label -->
                            <label class="radio-inline col-form-label-sm">
                                    <input type="radio" class="emp-select" disabled name="optradio" id="male" checked> Male
                            </label>
                            <label class="radio-inline ml-2 col-form-label-sm">
                                    <input type="radio" class="emp-select" disabled name="optradio" id="female"> Female
                            </label>
                        </div>
                    </div>

                    <div class=" row">
                        <label for="bdate" class="col-form-label-sm col-2">Birth Day</label>:
                        <div class=" input-group col-sm-3 ">
                            <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" id="bdate"  name="bdate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>


                </div>
                
            </div>

        </div>
        <div class="modal-footer justify-content-start">
            <input type="button" class="btn btn btn-danger" name="btn-back" id="btn-back" value="Back">
            
        </div>
        </form>
         
    </div>
   
</div>
 </div>
