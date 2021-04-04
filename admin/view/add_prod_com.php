<?php
require ("../lib/mod_product.php");

$prod_id = getProdId();
require ("../lib/mod_categories.php");
$catid =getCatId();
require ("../lib/common.php");

?>
<style>

</style>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="#" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" onclick="funViewProd()" class="text-dark"> Products Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>

    <li><a href="#" class="text-primary"> add Products</a> </li>

</div>


<!-- Content Row -->

<div class="animated zoomIn fast"   >
  <div class="modal-dialog modal-xl" role=document>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="h3" >Add Commercial Products</h3>
        </div>
        <div class="modal-body">
            <form id="prodForm" enctype="multipart/form-data">
            <div class="row" >
                <div class="col-lg-6 col-sm-10">
                    <div class="row ">
                        <label class="col-form-label-sm col-3">Product ID </label>:
                        <div class="form-group col">
                            <input type="text"  class="form-control-plaintext " readonly="readonly" name="prod_id" id="prod_id" value="<?php echo($prod_id) ?>">
                        </div>

                    </div>
                    <div class="form-group row d-none ">
                        <label for="staticEmail" class=" col-3 col-sm-3  col-form-label-sm">Category</label>:
                        <div class="col-7" >
                            <input readonly class="col-sm-4 form-control form-control-sm" id="prod_cat" name="prod_cat" value="CAT00002">
                        </div>
                        
                    </div>

                    <div class="form-group row" >
                        <label class="col-form-label-sm col-3 ">Product Image</label>:
                        <div class="col">
                            <input type="file" class=" form-control-file" id="prod_img" name="prod_img" >
                        </div>

                    </div>
                    <div class="form-group row  ">
                        <label class="col-form-label-sm col-3 ">Product Name</label>:
                        <div class="  col">
                            <input type="text" class=" emp-select form-control  form-control-sm" name="prod_name" id="prod_name">

                        </div>
                    </div>
                    <div class="form-group row  ">
                        <label class="col-form-label-sm col-3 ">Product Modal</label>:
                        <div class="  col">

                            <input type="text" class=" emp-select form-control  form-control-sm" name="prod_modal" id="prod_modal">
                        </div>
                    </div>
                    <div class="form-group row  ">
                        <label class="col-form-label-sm col-3 ">Color</label>:
                        <div class="  col-4">
                            <input type="text" class=" emp-select form-control  form-control-sm" name="prod_color" id="prod_color">
                        </div>
                    </div>

                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-3">Default price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text"  class="emp-select form-control  form-control-sm" name="prod_price" id="prod_price">
                        </div>
                    </div>

                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-3">Discount price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text"  class="emp-select form-control  form-control-sm" name="prod_dprice" id="prod_dprice">
                        </div>
                    </div>


                    <div class=" row">
                        <label class="col-form-label-sm col-3">Discription </label>:
                        <div class="form-group col">
                            <textarea  class=" emp-select form-control" name="prod_desc" id="prod_desc" rows="5"></textarea>

                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6 col-sm-10 ">


                    <div class=" row">
                        <label class="col-form-label-sm col-3">Reach level </label>:
                        <div class="form-group col-2">
                            <input type="number"  class="emp-select form-control form-control-sm" name="prod_rlevel" id="prod_rlevel">
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3">Capacity </label>:
                        <div class="form-group col-3">
                            <input type="text"  class="emp-select form-control form-control-sm" name="prod_capacity" id="prod_capacity">
                        </div>
                        <div class="col-3">
                             <small>Gallons</small>
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3">Voltage </label>:
                        <div class="form-group col-3">
                            <input type="text"  class="emp-select  form-control form-control-sm" name="prod_voltage" id="prod_voltage" value="220">
                        </div>

                        <div class="col-3">
                             <small>V</small>
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3">Power </label>:
                        <div class="form-group col-3">
                            <input type="text" class="emp-select form-control form-control-sm" name="prod_power" id="prod_power" value="50">
                        </div>

                        <div class="col-3">
                             <small>Hz</small>
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3">Tank Capacity </label>:
                        <div class="form-group col-3">
                            <input type="text" class="emp-select form-control form-control-sm" name="prod_tank" id="prod_tank">
                        </div>

                        <div class="col-3">
                             <small>Liters</small>
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3"> Material </label>:
                        <div class="form-group col">
                            <input type="text"  class="emp-select form-control  form-control-sm" name="prod_material" id="prod_material">
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3"> Dimension </label>:
                        <div class="form-group col-4">
                            <input type="text"  class="emp-select form-control form-control-sm" name="prod_dimension" id="prod_dimension" placeholder="20 x 20 x 50">
                        </div>

                        <div class="col-3">
                             <small>CM</small>
                        </div>
                    </div>
                    <div class=" row">
                        <label class="col-form-label-sm col-3"> Contains </label>:
                        <div class="form-group col">
                            <input type="text"  class="emp-select form-control form-control-sm" name="prod_contains" id="prod_contains">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class=" col-3 col-sm-3  col-form-label-sm">Warranty</label>:
                        <div class="col-4" >
                            <select readonly class="col emp-select  custom-select custom-select-sm" id="prod_warr" name="prod_warr">
                                <?php getWarranty() ?>

                            </select>
                        </div>
                    </div>

                    <div class=" row">
                        <label class="col-form-label-sm col-3"> Filter Stages </label>:
                        <div class="form-group col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pp" name="pp" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">PP Sediment</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="cto" name="cto" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">CTO Filter</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="post" name="post" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Post Carbon</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="ro" name="ro" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">RO Membrane</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="udf" name="udf" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">UDF Filter</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="mineral" name="mineral" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Minaral</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <input type="button" class="btn btn btn-danger" name="btn-back" id="btn-back" value="Back">
            <input type="button" class="btn btn btn-success" name="btn_add" id="btn_add" value="Add">

        </div>
        </form>
         
    </div>
   
</div>
</div>

<!-- Add Category Form END-->
<script>
    $(document).ready(function(){

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

         $('#btn-back').click(function(){
            swal({
                title: "Are you Sure ?",
                text: "You are trying to cancel ",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                     funViewProd();    
                }
            });

        });



        $("#btn_add").click(function(){

            var prod_img = $("#prod_img").val();
            var prod_name = $("#prod_name").val();
            var prod_modal = $("#prod_modal").val();
            var prod_desc = $("#prod_desc").val();
            var prod_color = $("#prod_color").val();
            var prod_price = $("#prod_price").val();
            var prod_rlevel = $("#prod_rlevel").val();

            if(prod_img =="" || prod_name =="" || prod_modal =="" || prod_desc =="" || prod_color =="" || prod_price =="" || prod_rlevel =="" ){
                swal("warning","Please Fill all fields","warning");
                return;
            }
            var modalPattern = /\s/g;
            if(prod_modal.match(modalPattern)){
                swal("warning","Please Remove empty space in Product modal","warning");
                return;
            }
            
            var fdata = new FormData($('#prodForm')[0]);
            var url = "lib/mod_product.php?type=addNewProd";

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
                   funViewProd();
                }
              },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }

            });  
        });

        

}); 



// File type validation
$("#prod_img").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['image/jpeg', 'image/png', 'image/jpg'];
   var filesize = 5242880;
    
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
       swal('Sorry',' only JPG, JPEG, & PNG Image files are allowed .','error');
        $("#prod_img").val('');
        exit;
    }else if(file.size>filesize){
        swal("Sorry"," Maximum Image size should be 5MB ","error");
        $("#prod_img").val('');
        exit;
    }
});

</script>