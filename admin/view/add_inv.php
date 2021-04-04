<?php
require ("../lib/mod_inv.php");
require ("../lib/mod_cus.php");
$cus_id = getCusId();
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uid"];

}


?>

<div class="animated fadeIn ">

<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark text-uppercase"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" onclick="funViewInv()" class="text-dark text-uppercase"> Invoice Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary text-uppercase"> Create Invoice</a> </li>

</div>
<div>
    <h4 class="h4 text-center text-primary py-3">Create New Invoice</h4>
</div>

<div class="container">
<form id="inv_form">
    <input type="hidden" name="log_user" value="<?php echo ($oper)?>">
    <!-----------------------      Invoice Details                       --------------------->
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="inv_id" class= " col-sm-4 col-form-label-sm">Invoice Number</label>
                <div class="col-sm-7">
                    <input type="text" readonly="readonly" class=" form-control form-control-sm"  id="inv_id" name="inv_id"  value="<?php getInvId(); ?>">
                </div>
            </div>
        </div> 

        <div class="col-lg-5">
            <div class="form-group row">
                <label for="inv_date" class= " col-sm-2 col-form-label-sm">Date</label>
                <div class="col-sm-8">
                    <input type="text"  class=" col-sm-8 form-control form-control-sm"  id="inv_date" name="inv_date" value="<?php echo(date("Y-m-d")) ; ?>" >
                </div>
            </div>
        </div>
    </div>
    <!-----------------------      Customer Details                       --------------------->
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="cus_email" class= " col-sm-4 col-form-label-sm">Customer Email</label>
                <div class="col-sm-8">
                    <input type="email"  class=" form-control form-control-sm"  id="cus_email" name="cus_email" >
                    <label for="" class="alert-warning d-none" id="war_email"> Not a valid email</label>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group row">
                <label for="txtfname" class= " col-sm-3 col-form-label-sm">Name</label>
                <div class="col-sm-8">
                    <input type="hidden"    id="cus_id" name="cus_id" >
                    <input type="text"  class=" form-control form-control-sm"  id="cus_fname" name="cus_fname" >
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group row">
                <label for="txtfname" class= " col-sm-5 col-form-label-sm">Contact No</label>
                <div class="col-sm-7">
                    <input type="text"  class=" form-control form-control-sm"  id="cus_mobile" name="cus_mobile" maxlength="10">
                    <label for="" class="alert-warning d-none" id="war_mobile"> Not a valid number</label>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------      Product Details       --------------------->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="" class= " col-sm-5 col-form-label-sm">Product ID</label>
                <div class="col-sm-7">
                    <input type="text"  class="  form-control form-control-sm"  id="prod_id" name="prod_id" >
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="" class= "col-sm-3 col-form-label-sm pr-1">Product modal</label>
                <div class="col-sm-8">
                    <input type="text" readonly="readonly"  class="  form-control form-control-sm"  id="prod_modal" name="prod_modal" >
                    <input type="hidden" readonly="readonly"  class="  form-control form-control-sm"  id="bat_id" name="bat_id" >
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group row">
                <label for="" class= " col-sm-4 col-form-label-sm pr-1">Remaining</label>
                <div class="col-sm-6">
                    <input type="text" readonly="readonly"  class="  form-control form-control-sm"  id="prod_rem" name="prod_rem" >
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="txtfname" class= " col-sm-5 col-form-label-sm">Product QTY.</label>
                <div class="col-sm-3">
                    <input type="number"  class="form-control  form-control-sm"  id="prod_qty" name="prod_qty" min="1" value="1">
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="form-group row">
                <label for="prod_price" class= " col-sm-4 col-form-label-sm">Product Price</label>
                <div class="col-sm-6">
                    <input type="hidden" readonly="readonly"  class="form-control form-control-sm"  id="prod_cprice" name="prod_cprice" >
                    <input type="text" readonly="readonly"  class="form-control form-control-sm"  id="prod_sprice" name="prod_sprice" >
                    <input type="hidden" readonly="readonly"  class="form-control form-control-sm"  id="prod_tprice" name="prod_tprice" >
                    <input type="hidden" readonly="readonly"  class="form-control form-control-sm"  id="warr" name="warr" >
                </div>
            </div>
        </div>


    </div>
    <input type="button" value="add" class="btn btn-primary" id="add_table" >
    <div class="mt-3">
        <table class="table table-sm" width="90%">
            <thead>
            <tr>
                <th></th>
                <th>Product ID</th>
                <th>Product Modal</th>
                <th>Product Price(Rs)</th>
                <th>Quantity</th>
                <th>Total Price(Rs)</th>

            </tr>
            </thead>

            <tbody id="inv_content">

            </tbody>
            <tfoot>

            <tr align="right" >
                <td colspan="4"></td>
                <td > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right"  size="1" id="totqty" name="totqty" value="0"> </td>

                <td  > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right px-3"  size="1" id="txtgtot" name="txtgtot" value="0.00"> </td>
            </tr>

            <tr align="right" ><th colspan="5" >Discount(%)</th>
                <td  > <input type="text" class="form-control form-control-sm  text-right"  size="2" id="txtdis" name="txtdis" value="0"> </td>
            </tr>
            <tr align="right" ><th colspan="5" >Net Total(Rs)</th>
                <td  > <input type="text" readonly="readonly" class="form-control form-control-sm text-right"  size="2" id="txtntot" name="txtntot" value="0.00"> </td>
            </tr>
            </tfoot>

        </table>
    </div>
        <div>
            <div align="right" class="mr-4">
                <button type="button" class="btn btn-success"  id="btn_inv_submit">Submit</button>
                <button type="reset" class="btn btn-success"  id="btn_inv_cancel">clear</button>
            </div>
        </div>

    </form>

</div>
</div>

<div class="modal  fade" id="addCus" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="addCudForm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add New Customer</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label bold">Customer ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="ncus_id" name="ncus_id" readonly="readonly" value="<?php echo($cus_id);  ?>" >

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Customer Email</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_email" id="ncus_email"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">First Name</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_fname" id="ncus_fname"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Last Name</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_lname" id="ncus_lname"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Customer Contact</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_mobile" id="ncus_mobile"  >
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-4  col-form-label-sm">Gender</label>
                        <div class="form-check form-check-inline"> <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-3 selected" required name="gender" id="optmale" value="1" >
                            <label for="optmale" class="form-check-label-sm">Male</label>
                            <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-4" required name="gender" id="optfemale" value="0" >
                            <label for="optfemale" class="form-check-label-sm" >Female</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="modal_btn_add_cus"> ADD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
         $("#inv_date").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
        });

        /*----------------------check customer email new --------------------------   */
        $("#cus_email").keypress(function (e) {  // check this email register or not
            var email_pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

            if(e.which==13){
                var email = $(this).val();
                if(email==""){
                   swal("warning","email Not valied","warning");
                }else if(!email.match(email_pattern)){
                     swal ("Invalid Input","Please enter your email address","error");
                 }else{

                    var url  = "lib/mod_inv.php?type=checkCustomer";

                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{email:email},
                        dataType:"json",
                        success:function (result) {

                            if(result=="1"){
                                $("#cus_id").val("");
                                $("#cus_fname").val("");
                                $("#cus_mobile").val("");
                                $("#ncus_email").val(email);
                                $("#addCus").modal();
                            }else{
                                $("#cus_id").val(result.cus_id);
                                $("#cus_fname").val(result.cus_fname);
                                $("#cus_mobile").val(result.cus_mobile);
                            }
                        }

                    });
                }
            }
        });

         /*----------------------Add new customer  --------------------------   */

        // add new Customer
        $("#modal_btn_add_cus").click(function () {
            $ncus_id =$("#ncus_id").val();
            $ncus_email =$("#ncus_email").val();
            $ncus_fname =$("#ncus_fname").val();
            $ncus_lname =$("#ncus_lname").val();
            $ncus_mobile =$("#ncus_mobile").val();

            var email_pattern=/^[a-zA-Z\.\s]+$/;
            if( $ncus_email.match(email_pattern)){
                swal ("Invalid Input","Please enter your email address","error");
                return;
            }

            if($ncus_id =="" || $ncus_email == "" || $ncus_fname=="" || $ncus_lname=="" || $ncus_mobile==""){
                swal("warning","Fill All Fieds","warning" );
            }
            var fdata = $("#addCudForm").serialize();
            var url  = "lib/mod_inv.php?type=addNewCustomer";

            $.ajax({
                method:"POST",
                url:url,
                data:fdata,
                dataType:"text",
                success:function (result) {
                    res = result.split(",");
                    if(res[0]=="0"){
                        swal("Error",res[1],"error")
                    }
                    else if(res[0]=="1") {
                        $("#addCus").modal('hide');
                        $("#cus_id").val($ncus_id);
                        $("#cus_fname").val($ncus_fname);
                        $("#cus_mobile").val($ncus_mobile);
                    }
                }

            });
        });

        $("#cus_email").keyup(function(){
            var email = $(this).val();
            var email_pattern=/^[a-zA-Z1-9\n{@}.\s]+$/;
            if(!email.match(email_pattern)){

                $("#war_email").removeClass('d-none');
            }else{
                $("#war_email").addClass('d-none');
            }
        });
        $("#cus_mobile").keyup(function(){
            var phone = $(this).val();
            var phone_pattern = /[^0-9]/;
            if(phone.match(phone_pattern)){

                $("#war_mobile").removeClass('d-none');
            }else{
                $("#war_mobile").addClass('d-none');
            }
        });

         /*----------------------get product details--------------------------   */


         $("#prod_id").keypress(function (e) {  // check this email register or not
            if(e.which==13){
                var prodid = $(this).val();
                 if(prodid==""){
                   swal("warning","Product id not valid","warning");
                }else{

                    var url  = "lib/mod_inv.php?type=getProducts";

                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{prodid:prodid},
                        dataType:"json",
                        success:function (result) {

                            if(result=="1"){
                               swal("warning","Product ID is not valid","warning");
                            }else{
                                $("#prod_id").val(result.prod_id); //product id
                                $("#bat_id").val(result.bat_id);    //batch id
                                $("#prod_modal").val(result.prod_modal);    //modal
                                $("#prod_rem").val(result.prod_qty);    //remaining quantity
                                $("#prod_cprice").val(result.bat_cprice);   //cost price
                                $("#prod_sprice").val(result.bat_sprice);   //sell price
                                $("#prod_tprice").val(result.bat_sprice);   //total price
                                $("#warr").val(result.nodate);      // no of warrenty date
                                
                            }
                        }

                    });
                }
            }
        });

/*----------------------Change price from quantity--------------------------   */

         $("#prod_qty").on("keyup mouseup",function(){
            var qty = $(this).val();
            var price = $("#prod_sprice").val();  //selling price

            var prod_rem = $("#prod_rem").val();

               
            totalProdprice = parseFloat(price)*parseInt(qty);
            totalProdprice = parseFloat(totalProdprice).toFixed(2);
            $("#prod_tprice").val(totalProdprice); 
         
            if(parseInt(qty)> parseInt(prod_rem)){
                    swal("Error","Quantity is more than available","error");
                    $("#prod_qty").val("14");
                    return;
               }

         }) ;
        


        /*----------------------Invoice data add to the Table--------------------------   */

        $("#add_table").click(function () {            

            var date = $("#inv_date").val(); //invoice date
            var cus_email = $("#cus_email").val();  //customer email
            var cus_fname = $("#cus_fname").val(); //customer first name
            var cus_mobile = $("#cus_mobile").val(); // customer mobile
            
            var prod_id = $("#prod_id").val(); // product id
            var bat_id = $("#bat_id").val();    //batch id
            var prod_modal = $("#prod_modal").val(); //model name
            var prod_rem = $("#prod_rem").val(); //remaining quantity
            var prod_qty = $("#prod_qty").val();
            var prod_cprice = $("#prod_cprice").val(); //cost price
            var prod_sprice = $("#prod_sprice").val();  //cost selling price
            var prod_tprice = $("#prod_tprice").val();   // product total price
            var warrentyDate = $("#warr").val();   // product total price
            

            var email_pattern=/[^@]{1,64}@[^@]{4,253}$/;
            var mobile_pattern=/^([0-9]){10}$/;
            if( !cus_email.match(email_pattern)){
                swal ("Invalid Input","Not a valid Email","error");
                return;
            }
            if( !cus_mobile.match(mobile_pattern)){
                swal ("Invalid Input","Not a valid Contact Number","error");
                return;
            }
            if( parseInt(prod_qty) > parseInt(prod_rem)){
                swal ("Invalid Input","Sorry, Quantity is not in stock","error");
                return;
            }

            if(date =="" || cus_email=="" || cus_fname=="" || cus_mobile=="" || prod_id=="" ||
                prod_modal=="" || prod_qty=="" ){
                swal("warning","Please fill All Inputs correctly","warning");
            return;
            }



            var totqty = $("#totqty").val(); // get table total quantity

            var totqty = parseInt(totqty)+ parseInt(prod_qty); // sum of existing quantity and new total quantity
            $("#totqty").val(totqty); // add table total quantity
            
            var gtot = parseFloat($("#txtgtot").val()) ; //get table total price
            var total = parseFloat(parseInt(gtot) + parseInt(prod_tprice)).toFixed(2); //sum of existing price and new price
            $("#txtgtot").val(total); //save total

            

            var ntot = parseFloat($("#txtntot").val());
            var ntotal = parseFloat(parseFloat(ntot) + parseFloat(prod_tprice)).toFixed(2);
            $("#txtntot").val(ntotal);


            $row= "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext ' id='tbl_id' name='tbl_id[]' readonly value='"+prod_id+"'> <input type='hidden' class='form-control-plaintext ' id='bat_id' name='bat_id[]' readonly value='"+bat_id+"'><input type='hidden' class='form-control-plaintext ' id='tbl_cprice' name='tbl_cprice[]' readonly value='"+prod_cprice+"'><input type='hidden' class='form-control-plaintext ' id='warrdate' name='warrdate[]' readonly value='"+warrentyDate+"'>";


            $row += "<td><input type='text' class='form-control-plaintext ' id='tbl_modal' name='tbl_modal[]' readonly value='"+prod_modal+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right  pr-5' id='tbl_sprice' name='tbl_sprice[]' readonly value='"+prod_sprice+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext qty' id='tbl_qty' name='tbl_qty[]' readonly value='"+prod_qty+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right total pr-3' id='tbl_tprice' name='tbl_tprice[]' readonly value='"+prod_tprice+"' > </td>";

            $row += "</tr>";


            
           
            $("#inv_content").append($row);
            $("#txtdis").val("0");
             
             resetinput();

        });

        /*---------------------- cus email change for double click --------------------------   */

        $("#cus_email").dblclick(function(e){
            $(this).prop("readonly","");
            $("#cus_fname").prop('readonly',"");
            $("#cus_mobile").prop('readonly',"");
        });

        /*---------------------- function for remove --------------------------   */

        $("#inv_content").on("click",".remove",function(){ // after load page if click remove run function

            var total =parseFloat($(this).parents("tr").find(".total").val());
            var qty =parseFloat($(this).parents("tr").find(".qty").val());

            var gtot = parseFloat($("#txtgtot").val());
            var gqty = parseFloat($("#totqty").val());

            gtot = parseFloat(gtot-total).toFixed(2);
            $("#txtdiscount").prop("readonly","");
            $("#txtdiscount").val("");
            var ntot = gtot;

            gqty = gqty-qty;

            $("#txtgtot").val(gtot);
            $("#txtntot").val(ntot);
            $("#totqty").val(gqty);

            $(this).parents("tr").remove();
        });

        /*---------------------- add Discount --------------------------   */

        $("#txtdis").keypress(function (e) {
            if(e.which==13){
                if($(this).val()==""){
                    $("#txtntot").val($("#txtgtot").val());
                }else{
                    var dis = parseFloat($(this).val());
                    var gtot = parseFloat($("#txtgtot").val());
                    var ntot = gtot - ((gtot*dis)/100);
                    $("#txtntot").val(ntot);
                    $("#txtdis").prop('readonly',true);
                }
            }
        });

        /*---------------------- Submit Data --------------------------   */

        $("#btn_inv_submit").click(function () {
            var date = $("#inv_date").val();
            var ncus_email =$("#ncus_email").val();
            var ncus_fname =$("#ncus_fname").val();
            var ncus_lname =$("#ncus_lname").val();
            var ncus_mobile =$("#ncus_mobile").val();

            var prodid =$("#prodid").val();
            var pro_modal =$("#prod_modal").val();



            var data = $('#inv_form').serialize();
            var url  = "lib/mod_inv.php?type=addNewInv";

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
                        setTimeout(function() {
                            funAddInv();
                        }, 300);
                    }
                }

            });

        });
        

    });

    function resetinput(){

        $("#prod_id").val("");
        $("#prod_modal").val("");
        $("#prod_rem").val("");
        $("#prod_qty").val("1");
        $("#prod_price").val("");
        // disable customer details
        $("#cus_email").prop('readonly',true);
        $("#cus_fname").prop('readonly',true);
        $("#cus_mobile").prop('readonly',true);
    }
</script>
