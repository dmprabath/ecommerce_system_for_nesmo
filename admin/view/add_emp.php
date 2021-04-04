<?php
require ("../lib/mod_emp.php");
require ("../lib/common.php");
$newid = getEmpId();

?>
<style>

</style>


<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark text-uppercase"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" onclick="funViewEmp()" class="text-dark text-uppercase"> User Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary text-uppercase"> Add Employee</a> </li>

</div>


<!-- Content Row -->

<div class="animated zoomIn fast"   >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="statusMsg">
        
    </div>
     
      <div class="modal-body">


    <form id="fupForm" enctype="multipart/form-data">
        <table width="100%" border="0" align="justify-content-left" >
            <tr>
                <td width="50%" >
                    <div class="form-group row">
                        <label for="txt-id" class="col-sm-4 col-form-label-sm">Employee ID</label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control-plaintext form-control-sm" id="txt_id" name="txt_id" value="<?php echo($newid) ?>" />
                        </div>
                    </div>
                </td>

            </tr>
            <tr>
                <td width="50%">
                    <div class="form-group row">
                        <label for="txtfname" class= " col-sm-3 col-form-label-sm">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" required id="txtfname" name="txtfname" >
                            <span id="fname_error" class="text-danger d-none"> Characters only Allowd</span>
                        </div>

                    </div>
                </td>
                <td width="50%">
                    <div class="form-group row">
                        <label for="staticmail" class= " col-sm-3  col-form-label-sm">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm"  id="txtlname" name="txtlname">
                            <span id="lname_error" class="text-danger d-none">Characters only Allowd</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group row">
                        <label for="staticmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control form-control-sm"  id="txt-email" name="txt-email">
                             <span id="email_error" class="text-danger d-none"> Enter Valied Email</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Contact No</label>
                        <div class="col-sm-6 ">
                             <input type="tel" class="form-control form-control-sm"  id="con_num" name=" con_num" maxlength="10" size="10"> 
                             <div id="con_error" class="text-danger d-none"> Enter valid contact number</div>
                           
                             
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <div class="form-group row">
                        <label for="staticm8il" class= " col-sm-3 col-form-label-sm">Address</label>
                        <div class="col-sm-8">
                            
                            <textarea rows="2" class="form-control" id="address"  name="address">

                            </textarea>
                             <span id="add_error" class="text-danger d-none"> Only characters</span>
                        </div>
                    </div>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group row">
                        <label for="bdate" class=" col-sm-3  col-form-label-sm">Birth Day</label>
                        <div class=" input-group col-sm-6 ">
                            <input type="text" class="form-control form-control-sm"  id="bdate"  name="bdate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Nic NO</label>
                        <div class=" input-group col-sm-6 ">
                            <input type="text" class="form-control form-control-sm"  id="txt-nic" name="txt-nic" maxlength="12">

                        </div>
                        <span id="nic_error" class="text-danger d-none col-sm-3 "> <small>Enter Valid NIC</small></span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group row">
                        <label for="jdate" class=" col-sm-3  col-form-label-sm">Join Date</label>
                        <div class=" input-group col-sm-6 ">
                            <input type="text" class="form-control form-control-sm"  id="jdate" name="jdate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </td>
                <td>

                    <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Gender</label>
                        <div class="form-check form-check-inline"> <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-3"  name="gender" id="optmale" value="1" checked>
                            <label for="optmale" class="form-check-label-sm ">Male</label>
                            <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-4"  name="gender" id="optfemale" value="0" >
                            <label for="optfemale" class="form-check-label-sm" >Female</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-3  col-form-label-sm"  >Role</label>
                        <div >
                            <select class="form-control" id="role" name="role" >
                                <?php getSupRole() ?>
                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" id="emp_file" name="emp_file" />
                        <span id="file_error" class="text-danger "> </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    
                    <input type="button" id="btn_add" class="btn btn-primary" name="btn_add" value="Register">
                    
                </td>
            </tr>



        </table>
</form>


    </div>
  </div>
</div>

<script>
    $(document).ready(function(){

            //                  ------------------ input Validation Start ---------------------------
        var $patname=/([a-zA-Z\s])$/;
        $('#txtfname').on('keypress keydown keyup',function(){
            if (!$(this).val().match($patname)) {
                $('#fname_error').removeClass('d-none');
            }
            else{
                $('#fname_error').addClass('d-none');
            }
        });

        $('#txtlname').on('keypress keydown keyup',function(){
            if (!$(this).val().match($patname)) {
                $('#lname_error').removeClass('d-none');
            }
            else{
                $('#lname_error').addClass('d-none');
            }
        });
        $email_pat = /[^@]{1,64}@[^@]{4,253}$/;
        $('#txt-email').on('keypress keydown keyup',function(){
            if (!$(this).val().match($email_pat)) {
                $('#email_error').removeClass('d-none');
            }
            else{
                $('#email_error').addClass('d-none');
            }
        });

        $connum = /([0-9]).{10}$/;
        $('#con_num').on('keypress keydown keyup',function(){
            if (!$(this).val().match($connum)) {
                $('#con_error').removeClass('d-none');
            }
            else{
                $('#con_error').addClass('d-none');
            }
        });
        $addpat =/[,#-\/\s\!\@\$.....]$/;
        $('#address').on('keypress keydown keyup',function(){
            if (!$(this).val().match($addpat)) {
                $('#add_error').removeClass('d-none');
            }
            else{
                $('#add_error').addClass('d-none');
            }
        });
        $nicPat1 = /[1-9]{9}[vVxX]$/;
        $nicPat2 = /[1-9]{12}$/;
        $('#txt-nic').on('keypress keydown keyup',function(){
            if (!$(this).val().match($nicPat1) && !$(this).val().match($nicPat2)) {
                $('#nic_error').removeClass('d-none');
            }
            else{
                $('#nic_error').addClass('d-none');
            }
        });


        $("#bdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"-6575"
        });
        $("#jdate").datepicker({
            changeMonth:true,
            changeYear:true,

        });
        $('#con_num').on('keypress click',function(){
            var useemail = $("#txt-email").val();
            if(useemail ==""){
                swal("Sorry","Please Enter Email First","warning");
            }else{
                
                var url = "lib/mod_emp.php?type=chekEmail";

                $.ajax({
                    type:"POST",
                    url:url,
                    data:{email:useemail},
                    dataType:"text",
                    success:function(result){                                   
                       result =result.trim();
                        if(result=="1"){
                          swal("Sorry","this Email already in the system","warning");
                        }
                        
                    },
                    error:function(eobj,etxt,err){
                      console.log(etxt);
                    }

                }); 

            }
        });
        $("#btn_add").click(function(){
            var fname = $("#txtfname").val();
            var lname = $("#txtlname").val();
            var email = $("#txt-email").val();
            var num = $("#con_num").val();
            var address = $("#address").val();
            var bdate = $("#bdate").val();
            var jdate = $("#jdate").val();
            var role = $("#role").val();
            var file = $("#emp_file").val();

            if(fname=="" || lname=="" || email =="" || num =="" || address=="" || bdate == "" || jdate =="" || role =="" || file ==""){
               swal("Sorry","Please Fill the All fields correctly","warning");
               exit; 
            }


            var fdata = new FormData($('#fupForm')[0]);
            var url = "lib/mod_emp.php?type=addNewEmp";

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
                  getSupRole();
                }
              },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }

            });  
        });

}); 


// File type validation
$("#emp_file").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = [ 'image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
        swal("Sorry","JPG, JPEG, & PNG files are allowed to upload.","error");
        $("#emp_file").val('');
        return false;
    }
});


</script>