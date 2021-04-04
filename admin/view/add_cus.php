<?php
require ("../lib/mod_cus.php");
$newid = getCusId();

?>
<style>

</style>

<script>
    $(document).ready(function(e){

        //                  ------------------ input Validation Start ---------------------------
        var $regexname=/^([a-zA-Z]{3,})$/;
        $('#txtfname').on('keypress keydown keyup',function(){            // first name validation
            if (!$(this).val().match($regexname)) {
                // there is a mismatch, hence show the error message
                $('#fname_error').removeClass('hidden');
                $('#fname_error').show();
            }
            else{
                // else, do not display message
                $('#fname_error').addClass('hidden');
            }
        });


        $("#bdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"-6575"
        });


        // Submit form data via Ajax
        $("#fupForm").on('submit', function(e){
            e.preventDefault();
            var bdate = $("#bdate").val();
            var jdate = $("#jdate").val();
            var gender = $("input[name='gender']:checked").length;
            $.ajax({
                type: 'POST',
                url: 'lib/file-upload.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){

                },
                success: function(response){ //console.log(response);

                    $('.statusMsg').html('');
                    if(response.status == 1){
                        $('#fupForm')[0].reset();
                        swal("success","successfully","success");
                    }else{
                        $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                    }
                    $('#fupForm').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");
                }
            });
        });
    });





</script>
<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark text-uppercase"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" onclick="funViewCus()" class="text-dark text-uppercase"> Customer Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-dark text-uppercase"> add Customer</a> </li>

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
                                    <label for="txt-id" class="col-sm-4 col-form-label-sm">Customer ID</label>
                                    <div class="col-sm-7">
                                        <input type="text" disabled class="form-control-plaintext form-control-sm" id="txt-id" name="txt-id" value="<?= $newid ?>"  />
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td width="50%">
                                <div class="form-group row">
                                    <label for="txtfname" class= " col-sm-3 col-form-label-sm">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="txtfname" name="txtfname" >
                                    </div>
                                </div>
                            </td>
                            <td width="50%">
                                <div class="form-group row">
                                    <label for="staticmail" class= " col-sm-3  col-form-label-sm">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="txtlname" name="txtlname">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group row">
                                    <label for="staticmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control form-control-sm" id="txt-email" name="txt-email">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group row">
                                    <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Contact No</label>
                                    <div class=" input-group col-sm-6 ">
                                        <input type="tel" class="form-control form-control-sm" id="con_num" name="con_num">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <div class="form-group row">
                                    <label for="staticm8il" class= " col-sm-3 col-form-label-sm">Address</label>
                                    <div class="col-sm-8">

                                        <textarea rows="2" class="form-control" id="address" name="address">

                            </textarea>
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
                                        <input type="text" class="form-control form-control-sm" id="bdate"  name="bdate" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group row">
                                    <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Nic NO</label>
                                    <div class=" input-group col-sm-6 ">
                                        <input type="text" class="form-control form-control-sm" id="txt-nic" name="txt-nic">
                                    </div>
                            </td>
                        </tr>
                        <tr>

                            <td>

                                <div class="form-group row">
                                    <label for="staticEmail" class=" col-sm-3  col-form-label-sm">Gender</label>
                                    <div class="form-check form-check-inline"> <!-- for align button and label -->
                                        <input type="radio" class="form-check-input ml-3" name="gender" id="optmale" value="1" >
                                        <label for="optmale" class="form-check-label-sm">Male</label>
                                        <!-- for align button and label -->
                                        <input type="radio" class="form-check-input ml-4" name="gender" id="optfemale" value="0" >
                                        <label for="optfemale" class="form-check-label-sm" >Female</label>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="">
                                <input type="submit" name="submit" class="btn btn-success submitBtn align-content-end" value="SUBMIT"/>
                            </td>
                        </tr>



                    </table>
                </form>


            </div>
        </div>
    </div>

