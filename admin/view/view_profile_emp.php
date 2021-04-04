<?php
if(isset($_GET["empid"])){
    $emp_id = $_GET["empid"];
    
}
?>

 
 <div>
     <div class="breadcrumb bg-gray-200 text-uppercase">
         <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a href="#" onclick="funViewEmp()" class="text-dark"> User Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a  class="text-primary"> View profile</a> </li>

     </div>

<div class="modal-dialog modal-xl" role=document>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="h3">View Profile</h3>
        </div>
        <div class="modal-body">
            <form  id="form-emp" enctype="multipart/form-data">
            <div class="row" >
                <div class="col-lg-3 col-sm-10">
                    <div class="form-group" id="image">
                        <img src="" id="imageEmp" alt="" width="200px" >
                    </div>
                    <div class="form-group" >
                        <input type="file" class="form-control-file-sm " id="emp_img" name="emp_img"  style="display: none" >
                    </div>
                    
                    
                </div>
                <div class="col-lg-8 col-sm-10 ">

                    <div class="row ">
                        <label class="col-form-label-sm col-2">Employee ID </label>:
                        <div class="form-group col-lg-2">
                            <input type="text"  readonly="readonly" class="form-control-plaintext form-control-sm " name="emp_id" id="emp_id" value="<?php echo($emp_id)  ?>">
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
                            <input type="email" readonly="readonly" class=" form-control-plaintext form-control-sm" name="emp_email" id="emp_email">
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-2">Address </label>:
                        <div class="form-group col-lg-8">
                            <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" name="emp_address" id="emp_address">
                        </div>
                    </div>
                    <div class="row ">
                        <label class="col-form-label-sm col-2">Contact No </label>:
                        <div class="form-group col-lg-4">
                            <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" name="emp_mobile" id="emp_mobile">
                        </div>
                    </div>
                    <div class=" row">
                        <label for="staticEmail" class="col-form-label-sm col-2">Gender</label>:
                        <div class="form-group ml-3 radio-inline"> <!-- for align button and label -->
                            <label class="radio-inline col-form-label-sm">
                                    <input type="radio" class="emp-select" disabled name="emp_gender"  id="male" checked value="1"> Male
                            </label>
                            <label class="radio-inline ml-2 col-form-label-sm">
                                    <input type="radio" class="emp-select" disabled name="emp_gender" id="female" value="0"> Female
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-form-label-sm col-2">Nic No</label>:
                        <div class=" form-group col-sm-4 ">
                        <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" id="emp_nic" name="emp_nic">
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
        <div class="modal-footer justify-content-center">
            <input type="button" class="btn btn btn-danger" name="btn-back" id="btn-back" value="Back">
            <input type="button" class="btn btn btn-success" name="btn-edit" id="btn-edit" value="Change">
            <input type="button" class="btn btn btn-success" name="btn-change" id="btn-change" value="Update" style="display: none;">
            <input type="button" class="btn btn btn-secondary" name="btn-cancel" id="btn-cancel" value="Cancel" style="display: none;">
        </div>
        </form>
         
    </div>
   
</div>
 </div>
 <script type="text/javascript">
     $(document).ready(function(){
        $("#bdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"-6575",
            dateFormat:"yy-mm-dd"
        });
        $("#jdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
            
        });
        /*------------------------------- Load employee details------------------------------*/

         var empid = $("#emp_id").val(); //employee id
         var url = "lib/mod_emp.php?type=viewEmpProfile";

         $.ajax({
            method:"POST",
            url:url,
            data:{empid:empid},
            dataType:"json",

            success:function(result){
                $("#fname").val(result.emp_fname);
                $("#lname").val(result.emp_lname);
                $("#emp_email").val(result.emp_email);
                $("#emp_address").val(result.emp_address);
                $("#emp_mobile").val(result.emp_mobile);
                var gender =result.emp_gender;
                
                if(gender=="1"){
                    $("#male").attr('checked',true);
                }else {
                    $("#female").attr('checked',true);
                }
                $("#emp_nic").val(result.emp_nic);
                $("#bdate").val(result.emp_birth);
                $("#jdate").val(result.emp_join);
                $("#role").val(result.emp_role);
                 var profile = result.emp_img;
                 if (profile !== ""){
                     $("#imageEmp").attr('src','../resources/img/profile/'+profile);
                 }else{
                     $("#imageEmp").attr('src','../resources/img/profile/user.png');
                 }


            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
         });
         /*------------------------------- Function for back button ------------------------------*/
         $("#btn-back").click(function () {
            $("#view_emp").click();
         });/*------------------------------- Function for back button ------------------------------*/
         $("#btn-cancel").click(function () {
            $("#view_emp").click();
         });

         /*------------------------------- to change employee buttons ----------------------------*/

         $("#btn-edit").click(function () {
                 $empName = $('#fname').val();
             swal({
                 title:" Confirmation",
                 text : "Do you want to change details of "+$empName+" ?",
                 icon : "warning",
                  buttons : true,
                 dangerMode:true
             }).then((willDelete)=> {
                if(willDelete){
                    $('.emp-select').prop("disabled", false);
                    $('.form-control-sm').switchClass("form-control-plaintext","form-control",10);
                    $('#btn-edit').css("display","none");
                    $('#btn-back').css("display","none");
                    $('#btn-change').css("display","block");
                    $('#btn-cancel').css("display","block");
                    $('#emp_img').css("display","block");
                }
             });

         });


         /*-------------------------------Update new Details ------------------------------*/

         $("#btn-change").click(function () {
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var address = $("#emp_address").val();

            var emp_nic = $("#emp_nic").val();
            var emp_email =$("#emp_email").val();
            var emp_mobile = $("#emp_mobile").val();

            var name = /^[a-zA-z]{2,}$/; 
            var email_pattern =  /[^@]{1,64}@[^@]{4,253}$/;
            var mobile_pattern =/^([0-9]){10}$/;
            var nic_pattern = /[0-9]{9}[x|X|v|V]$/;
            var nic_pattern2 = /[0-9]{12}$/;
            if(!fname.match(name) || fname ==""){
                swal("Error","Enter Valid first name","error");
            }else if(!lname.match(name) || lname ==""){
                swal("Error","Enter Valid Last name","error");
            }else if(address == ""){
                swal("Error","Please Enter address","error");
            }else if(!emp_email.match(email_pattern)){
                swal("Error","Enter Valid email","error");
            }else if(!emp_mobile.match(mobile_pattern)){
                swal("Error","Enter Valid Contact Nmber","error");
            }else if(!emp_nic.match(nic_pattern) ||  emp_nic=="" ){
                if(!emp_nic.match(nic_pattern2) ){
                    swal("Error","Enter Valid  Nic","error");
                }
                
            }else{
                var fdata = new FormData($('#form-emp')[0]);
                 var url = "lib/mod_emp.php?type=updateEmployee";

                 $.ajax({
                     type:"POST",
                     url:url,
                     data:fdata,
                     dataType:"text",
                     contentType:false,
                     cache:false,
                     processData:false,

                     success:function(result){
                         
                         res = result.split(",");                
                         msg = res[0].trim();
                        if(msg=="0"){
                          swal("Error",res[1],"error")
                        }
                        else if(msg=="1"){
                          swal("Success",res[1],"success");
                             funViewEmp();
                         }
                     },
                     error:function(eobj,etxt,err){
                         console.log(etxt);
                     }

                 });

            }
             
         });
     });
 </script>
