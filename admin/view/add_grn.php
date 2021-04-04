<?php
require("../lib/mod_grn.php");
require("../lib/common.php");
require ("../lib/mod_supplier.php");
$supid = getSupId();

require ("../lib/mod_categories.php");
$catid =getCatId();
?>

<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark text-uppercase"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" onclick="funViewGrn()" class="text-primary text-uppercase"> GRN Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-dark text-uppercase"> Create GRN</a> </li>

</div>
<div class="animated zoomIn fast">
    <div class="card">
        <form >
        <div class="m-xl-5">
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-2 form-label">Grn No</label>
                        <input type="text" class="col-lg-1 form-control-plaintext "     id="grnid" name="grnid" value="<?php getGrnNo() ?>" >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-2 form-label">Received Date</label>
                        <input type="text" class="col-lg-2 form-control " id="rdate" name="rdate" value="<?php echo(date("Y-m-d")) ; ?>">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-2"> Supplier</label>
                        <select  class= "col-lg-4 custom-select" name="grn_sup" id="grn_sup" readonly='readonly'>
                            <option value="">Select Supplier</option>
                            <?php getSuplier() ?>
                        </select>
                        <input type="hidden" name="selectSup" id="selectSup">
                        
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-2"> Category</label>
                        <select class= "col-lg-4 custom-select " name="grn_cat" id="grn_cat">
                            <option value="">Select Category</option>
                            <?php getCategory() ?>
                        </select>
                        
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-lg-2"> Products</label>
                        <select class= "col-lg-5 custom-select " name="grn_prod" id="grn_prod">
                            <option value="">Select Product</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="grn_img">

                       <!----------------#  Product Image here ----------------->
                    </div>
                </div>

            </div>


            <div class="row mt-2    ">
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 form-label">Quantity *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm" id="grn_qty" name="grn_qty" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-5 form-label">Cost Price(Rs) *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm text-right" id="cost_price" name="cost_price">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-5 form-label">Sell Price(Rs) *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm text-right" id="sell_price" name = "sell_price"  >
                    </div>
                </div>

            </div>
            <div>
                <div class="align-items-end" >
                    <input  type="button" class="btn btn-primary col-1" value="Add" id="btn_grn_add" name="btn_grn_add">
                </div>

            </div>

        </div>
        <div class="container ">
            <table class="table" width="90%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Cost Price(Rs)</th>
                        <th>Selling Price(Rs)</th>
                        <th>Total Price(Rs)</th>

                    </tr>
                </thead>

                <tbody id="grn_content">

                </tbody>
                <tfoot>

                    <tr align="right" >
                        <th colspan="3" >Total Quantity</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="totqty" name="totqty" value="0"> </td>
                        
                        <th colspan="2" >Total(Rs)</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="txtgtot" name="txtgtot" value="0"> </td>
                    </tr>

                    
                    <tr align="right" ><th colspan="6" >Net Total(Rs)</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="txtntot" name="txtntot" value="0"> </td>
                    </tr>
                </tfoot>

            </table>
            <div>
                <div align="right" class="mr-4">
                    <input type="button" class="btn btn-success" value="submit" id="btn_grn_submit" name="btn_grn_submit">
                </div>
            </div>
        </div>

        </form>
    </div>
</div>

<!-- Content Row -->
<!-- Add Category Form-->


<script>
    $(document).ready(function () {
        $("#rdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
        });
        /*-------------------- Add new Supplier   ---------------------*/
        
  

        
        /*-------------------- Load new product according to category   ---------------------*/

        $("#grn_cat").change(function () {

            $("#grn_img").html("");
            var cat_id = $(this).val();
            if(cat_id==""){
                $("#grn_prod").html("<option value=''>Select Category</option>");
            }else{
                url = "lib/mod_grn.php?type=getProuducts";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:{cat_id:cat_id},
                    dataType:"text",
                    success:function (result) {
                        $("#grn_prod").html(result);
                    },
                    error:function (etxt) {
                        console.log(etxt);
                    }

                });
            }

        });

        /*-------------------- Load image according to image   ---------------------*/

        $("#grn_prod").change(function () {
            var prod_id = $(this).val();
            var cat_id  = $("#grn_cat").val();
            if(prod_id==""){
                $("#grn_img").html("<img src='../resources/img/filter2.png' alt='' width='100%' >");
            }else{
                url = "lib/mod_grn.php?type=getProudImage";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:{cat_id:cat_id,prod_id:prod_id},
                    dataType:"text",
                    success:function (result) {
                        $("#grn_img").html(result);
                    },
                    error:function (etxt) {
                        console.log(etxt);
                    }
                });
            }

        });
        /*-------------------- Price format   ---------------------*/

        $("#cost_price").on("change",function () {
            $sprice = $(this).val();
            if($sprice ==""){
                $(this).val("0.00");
            }else{
                $(this).val((parseFloat($sprice)).toFixed(2));
            }
        });
        $("#sell_price").on("change",function () {
            $sprice = $(this).val();
            if($sprice ==""){
                $(this).val("0.00");
            }else{
                $(this).val((parseFloat($sprice)).toFixed(2));
            }
        });

        /*-------------------- Data add to table  ---------------------*/

        $("#btn_grn_add").click(function () {

            $rdate = $("#rdate").val();
            $grn_sup = $("#grn_sup").val();
            $grn_cat = $("#grn_cat").val();
            $cat_name = $("#grn_cat option:selected").text();
            $grn_prod = $("#grn_prod").val();
            $prod_name = $("#grn_prod option:selected").text();
            $grn_qty = $("#grn_qty").val();
            $cost_price = $("#cost_price").val();
            $sell_price = $("#sell_price").val();
            $totqty = $("#totqty").val();


            if($rdate=="" || $grn_sup=="" || $grn_cat=="" || $cat_name=="" || $grn_prod=="" || $prod_name=="" || $grn_qty=="" || $cost_price=="" || $sell_price=="" || $totqty==""){
                swal("Error","Please Fill All inputs","error");
                return;
            }
            //sum of curunt quantity and new quantity
            var totqty = parseInt($totqty)+ parseInt($grn_qty);
            $("#totqty").val(totqty); //add quantity to total quantity input


            var total = parseFloat($cost_price) * parseInt($grn_qty); // calculate toatal using price and quantity
            total = parseFloat(total).toFixed(2);

            $row= "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext '  readonly value='"+$prod_name+"'>" +
                "<input type='hidden' id='tbl_prod' name='tbl_prod[]'  value='"+$grn_prod+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext'  readonly value='"+$cat_name+"' >" +
                "<input type='hidden' id='tbl_cat' name='tbl_cat[]' value='"+$grn_cat+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right qty' id='tbl_qty' name='tbl_qty[]' readonly value='"+$grn_qty+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_cprice' name='tbl_cprice[]' readonly value='"+$cost_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_sprice' name='tbl_sprice[]' readonly value='"+$sell_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right total' id='bat_price' name='bat_price[]' readonly value='"+total+"' > </td>";

            $row += "</tr>";

            var gtot = parseFloat($("#txtgtot").val()); // input convert to currency
            var ntot = parseFloat($("#txtntot").val()); // input convert to currency

            gtot = parseFloat(gtot)+parseFloat(total);
            ntot = parseFloat(ntot)+parseFloat(total);
            gtot= parseFloat(gtot).toFixed(2);
            ntot= parseFloat(ntot).toFixed(2);


            $("#txtgtot").val(gtot); 
            $("#txtntot").val(ntot);
            $("#selectSup").val($("#grn_sup").val());
            $("#grn_sup").prop("disabled",true);

            $("#grn_content").append($row);
            resetinput();

        });
          /*-------------- Data add to database after click submit button  -------------*/
        $("#btn_grn_submit").click(function () {
            var rdate = $("#rdate").val();
            var grn_sup = $("#grn_sup").val();
            var tbl_cat = $("#tbl_cat").val();
            var tbl_prod = $("#tbl_prod").val();
            var tbl_qty = $("#tbl_qty").val();
            var tbl_cprice = $("#tbl_cprice").val();
            var tbl_sprice = $("#tbl_sprice").val();
            var gtot = $("#txtgtot").val();
            var ntot = $("#txtntot").val();

            if(rdate=="" || grn_sup=="" || tbl_cat =="" || tbl_prod=="" || tbl_qty =="" || tbl_cprice=="" || tbl_sprice=="" || gtot=="" || ntot==""){
                swal("Error","Please Fill All inputs","error");
                return;
            }

            var data = $('form').serialize();
            var url  = "lib/mod_grn.php?type=addNewGrn";

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function (result) {
                   
                    res = result.split(",");
                    msg = res[0].trim();
                    if(msg=="0"){
                        swal("Error",res[1],"error")
                    }
                    else if(msg=="1"){
                        swal("Success",res[1],"success");
                        $("#view_grn").click();
                    }
                }

            })

        });
          /*---------------- function for after click remove button on tabale  -----------*/

        $("#grn_content").on("click",".remove",function () {

            var total = parseFloat($(this).parents("tr").find(".total").val()); //product total
            var qty = parseFloat($(this).parents("tr").find(".qty").val());     // product quantity

            var totqty = $("#totqty").val(); //currunn total quntity
            var gtot = $("#txtgtot").val();     // current total 
            var ntot = $("#txtntot").val();     //current net total
            totqty = totqty-qty;
            gtot = gtot-total;
            ntot = gtot;

            gtot = parseFloat(gtot).toFixed(2);
            ntot = parseFloat(ntot).toFixed(2);

            $("#totqty").val(totqty); //total quantity
            $("#txtgtot").val(gtot); // grn total
            $("#txtntot").val(ntot); // grn net total
            
            $(this).parents("tr").remove();
        });

          /*-------------------- Clear inputs  ---------------------*/
        function  resetinput() {

            $("#grn_cat").val("");
            $("#grn_prod").val("");
            $("#grn_qty").val("");
            $("#cost_price").val("");
            $("#sell_price").val("");
            $("#grn_img").html("");
        }

    });


</script>

