<?php
require ("../lib/mod_product.php");
if(isset($_GET["prodid"])){
    $prod_id = $_GET["prodid"];
     $proname = $_GET["name"];
    
}

require_once("../lib/common.php");

?> 
 
<div>
     <div class="breadcrumb bg-gray-200 text-uppercase">
         <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a href="#"  onclick="funViewProd()" class="text-dark"> Product Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
         <li><a  class="text-primary"> View product</a> </li>

     </div>

<div class="modal-dialog modal-xl" role=document>
    <div class="modal-content">
         <input type="hidden"  readonly class="form-control-plaintext form-control-sm  " name="prod_id" id="prod_id" value="<?php echo($prod_id)  ?>">
        <div class="modal-header">
            <h3 class="h3" id="head_name"><?php echo($proname)  ?></h3>
        </div>
        <div class="modal-body">
            <!------------------------- Form Start------------------------------>
        <form enctype="multipart/form-data" id="tbl-produpdate">
          <div>
            <div class="row" id="prod_box" >
                

            </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn btn-danger" onclick="funViewProd()" name="btn-back" id="btn-back" value="Back">
                    <input type="button" class="btn btn btn-success "  name="btn-update" id="btn-update" value="Update">
                </div>

          </div> 
        </form>
         <!------------------------- Form End------------------------------>
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



        var prodid = $("#prod_id").val();
        var url = "lib/mod_product.php?type=viewProdProfile";

        $.ajax({
            method:"POST",
            url:url,
            data:{prodid:prodid},
            dataType:"text",
            success:function(result){                
                $("#prod_box").html(result);  
                 $('.emp-select').removeClass("form-control-plaintext");
                 $('.emp-select').prop("disabled", false);                           
                 $('#prod_img').removeClass("d-none");            
            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
        });

        $("#btn-update").click(function () {
            var name =$("#prod_name").val();
            var modal =$("#prod_modal").val();
            var color =$("#prod_color").val();
            var sprice = $("#prod_sprice").val();
            var dprice = $("#prod_dprice").val();
            var desc = $("#prod_desc").val();
            var qty = $("#prod_qty").val();
            var rlevel = $("#prod_rlevel").val();
            var capacity = $("#prod_capacity").val();
            var voltage = $("#prod_voltage").val();
            var power = $("#prod_power").val();
            var material = $("#prod_material").val();
            var dimension = $("#prod_dimension").val();
            var contains =$("#prod_contains").val();
            if(name=="" || modal=="" || color=="" || sprice=="" || dprice=="" || desc=="" || qty=="" || rlevel=="" || capacity=="" || voltage=="" || power=="" || material=="" || dimension=="" || contains=="" ){
                swal("Sorry","Please fill all inputs","error");
                
            }else{
                var fdata = new FormData($('#tbl-produpdate')[0]);
                var url = "lib/mod_product.php?type=updateProduct";

                $.ajax({
                    type:"POST",
                    url:url,
                    data:fdata,
                    dataType:"text",
                    contentType:false,
                    cache:false,
                    processData:false,

                    success:function(result){
                        alert(result);
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
            }
            



        });
    });
</script>
