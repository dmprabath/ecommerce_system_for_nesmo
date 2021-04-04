<?php
session_start();
$emp_id = $_SESSION["user"]["uid"];
?>



<div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card animated zoomIn fast" >
            <div class="content">
                <div class="card-header">
                    <h3 class="h3 title"> Profile</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row" >
                            <div class="col-lg-4 col-sm-10  border-right border-dark">
                                <div class="form-group text-center" id="image">
                                    <img src="" id="imageEmp" alt="" width="150px" >
                                </div>
                                <div class="form-group" >
                                    <input type="file" class="form-control-file-sm" id="emp-img" name="emp-img" style="display: none;">
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Role</label>
                                    <div >
                                        <fieldset disabled>
                                            <select readonly class=" form-control-plaintext custom-select-sm" id="role" name="role">
                                                <option value="1">Admin</option>
                                                <option value="2">Sales Person</option>
                                                <option value="3">Technision</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-sm-10 ">

                                <div class="row ">
                                    <label class="col-form-label-sm col-3">Employee ID </label>:
                                    <div class="form-group col-lg-4">
                                        <input type="text"  disabled class="form-control-plaintext form-control-sm " name="emp_id" id="emp_id" value="<?php echo($emp_id)  ?>">
                                    </div>

                                </div>
                                <div class="row ">
                                    <label class="col-form-label-sm col-3">Full Name</label>:
                                    <div class="form-group col-lg-3">
                                        <input type="text" disabled class=" emp-select form-control-plaintext form-control-sm" name="fname" id="fname">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <input type="text" disabled class="emp-select readonly form-control-plaintext form-control-sm" name="lname" id="lname">
                                    </div>
                                </div>
                                <div class=" row">
                                    <label class="col-form-label-sm col-3">Email </label>:
                                    <div class="form-group col-lg-8">
                                        <input type="email" disabled class="emp-select form-control-plaintext form-control-sm" name="email" id="email">
                                    </div>
                                </div>
                                <div class=" row">
                                    <label class="col-form-label-sm col-3">Address </label>:
                                    <div class="form-group col-lg-8">
                                        <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" name="address" id="address">
                                    </div>
                                </div>
                                <div class="row ">
                                    <label class="col-form-label-sm col-3">Contact No </label>:
                                    <div class="form-group col-lg-4">
                                        <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" name="mobile" id="mobile">
                                    </div>
                                </div>
                                <div class=" row">
                                    <label for="staticEmail" class="col-form-label-sm col-3">Gender</label>:
                                    <div class="form-group ml-3 radio-inline"> <!-- for align button and label -->
                                        <label class="radio-inline col-form-label-sm">
                                            <input type="radio" class="emp-select" disabled name="optradio" id="male" checked> Male
                                        </label>
                                        <label class="radio-inline ml-2 col-form-label-sm">
                                            <input type="radio" class="emp-select" disabled name="optradio" id="female"> Female
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="staticEmail" class="col-form-label-sm col-3">Nic No</label>:
                                    <div class=" form-group col-sm-4 ">
                                        <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" id="txt-nic" name="txt-nic">
                                    </div>
                                </div>
                                <div class=" row">
                                    <label for="bdate" class="col-form-label-sm col-3">Birth Day</label>:
                                    <div class=" input-group col-sm-3 ">
                                        <input type="text" disabled class="emp-select form-control-plaintext form-control-sm" id="bdate"  name="bdate" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                                <div class=" row">
                                    <label for="jdate" class="col-form-label-sm col-3">Join Date</label>:
                                    <div class=" input-group col-sm-3 ">
                                        <input type="text" disabled  class=" emp-select form-control-plaintext form-control-sm" id="jdate" name="jdate" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>

                            </div>

                        </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn btn-success" name="btn-edit" id="btn-edit" value="EDIT">
                    <input type="button" class="btn btn btn-success" name="btn-update" id="btn-update" value="Update" style="display: none;">
                    <input type="button" class="btn btn btn-secondary" name="btn-cancel" id="btn-cancel" value="Cancel" style="display: none;">
                </div>
                </form>

            </div>
        
        </div>

        </div>
        <div class="col-lg-4">

        
         </div>        
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#bdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"-6575"
        });
        $("#jdate").datepicker({
            changeMonth:true,
            changeYear:true,

        });

        var empid = $("#emp_id").val();
        var url = "lib/mod_emp.php?type=viewEmpProfile";

        $.ajax({
            method:"POST",
            url:url,
            data:{empid:empid},
            dataType:"json",

            success:function(result){
                $("#fname").val(result.emp_fname);
                $("#lname").val(result.emp_lname);
                $("#email").val(result.emp_email);
                $("#address").val(result.emp_address);
                $("#mobile").val(result.emp_mobile);
                var gender =result.emp_gender;
                if(gender=="1"){
                    $("#male").attr('checked',true);
                }else {
                    $("#female").attr('checked',true);
                }
                $("#txt-nic").val(result.emp_nic);
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
                    $('#btn-update').css("display","block");
                    $('#btn-cancel').css("display","block");
                    $('#emp-img').css("display","block");
                }
            });

        });
        $("#btn-cancel").click(function () {
            viewProfile();
        });
    });
</script>