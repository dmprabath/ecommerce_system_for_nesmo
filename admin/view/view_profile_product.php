<?php
require_once("../lib/common.php");
if(isset($_GET["prodid"])){
    $prod_id = $_GET["prodid"];
     $proname = $_GET["name"];
    
}


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
      $(this).scrollTop(0);
        var prodid = $("#prod_id").val();
        var url = "lib/mod_product.php?type=viewProdProfile";

        $.ajax({
            method:"POST",
            url:url,
            data:{prodid:prodid},
            dataType:"text",

            success:function(result){                
                $("#prod_box").html(result);
                
            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
        });
        

        
    });
</script>
