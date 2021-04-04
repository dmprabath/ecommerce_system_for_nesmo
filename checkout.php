<?php
session_start();
//add main Navigation
if(!isset($_SESSION["customer"]["uname"])) {
     header("Location:index.php");       
}
require_once("include/main_nav.php");

//require("lib/mod_invoice.php");

//add script file


?>

<div class="bg-dark text-light row py-3" >
    <div class="col-sm-12 text-center">
        <h3  class=" text-weight-bold " >Checkout</h3>
    </div>
    <div class="col-sm-12 text-center">
        <p  class="font-italic " ><i class="fas fa-1x fa-home"></i> Home <i class="fas fa-chevron-right"></i> Shop <i class="fas fa-chevron-right"></i> Delivery <i class="fas fa-chevron-right"></i> Checkout </p>
    </div>   
    
</div>

<div class="container-fluid  bg-register-image">
<!------------------Order Success Message Start--------------->
            <div class="container d-none animated bounceIn"  id="checkout_body">
                <div class="col-lg-5 mx-auto bg-success  border text-center ">
                    <i class="fas fa-10x fa-check text-light"></i>
                    <h2 class="p text-light text-center">Success !</h2>
                     <p class="p text-light text-center">Your Order was success, Your orde will be deliverd soon</p>
                     <p class="p text-light text-center" >This is Your Invoice ID : <span id="msg_inv_id">invoice id here</span></p> 

<!-- invoice id display here -->
                     <p class="h5 text-weight-bold text-light text-center"><a href="myaccount.php" class="text-light ">Order Details</a></p>
                </div>
                
            </div>
<!------------------Order Success Message End--------------->

            
        <div id="chec_pay_body" class="row pl-5">



<!--------------------------------------Left Side of Checkout Page-->
            <div  class="col-8">
    <!-----------------left Side of payment details box Start--------->

                <div class="card bg-register-image m-4">
                    <div>
                        <div class="card-header">
                            <h4 class="text-dark">Payment Information</h4>
                        </div>
                        <div class="card-body">
                            <form class="p-4" id="pay_form">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-11">
                                        <h5 class=" text-dark">Card Details</h5>
                            <!-- Logged customer ID -->
                                        <input type="hidden" name="cus_id" id="cus_id" value="<?php echo($cusid) ?>">
                            <!-- auto generate Invoice ID -->
                                        <input type="hidden" name="inv_id" id="inv_id" value="<?php getInvId(); ?>">
                            <!--Auto generate Paymenet ID -->
                                        <input type="hidden" name="pay_id" id="pay_id" value="<?php getPayId(); ?>">
                            
                             <!-- product ID -->           
                                        <input type="hidden" name="prod_id" id="prod_id" >
                              <!-- batch ID -->           
                                        <input type="hidden" name="bat_id" id="bat_id" >
                             
                             <!-- product cost price -->           
                                        <input type="hidden" name="prod_cprice" id="prod_cprice" >
                             <!-- product Sell price -->            
                                        <input type="hidden" name="prod_price" id="prod_price" >
                             <!-- product quantity -->            
                                        <input type="hidden" name="ord_qty" id="ord_qty" >
                             
                             <!-- No of warrenty days -->            
                                        <input type="hidden" name="warr" id="warr" >

        <!-----------------Warning message --------->
                                        <div id="err_msg" class="d-none  alert alert-danger mt-2">Warning</div>

                                        <div class="form-group row">
                                            <label class="col-form-label text-dark col-4">Card No</label>
                                            <div class="col-8">
                                                <input type="text" class=" form-control form-control-sm check-in" name="txtcno" id="txtcno" size="16" maxlength="16">   
                                            </div>
                                                                    
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-dark col-4">Card Type</label>
                                            <div class="input-group col-8">
                                                <input type="radio" class="custom-radio" name="optctype" id="optmaster" value="1">
                                                <label for="optmaster"><img src="resources/img/web-home/card_sm_masterc.gif"></label>

                                                <input type="radio" class="custom-radio" name="optctype" id="optvisa" value="2">
                                                <label for="optvisa"><img src="resources/img/web-home/card_sm_visa.gif"></label>
                                            </div>
                                                                    
                                        </div>
            <!-----------------Expire Date--------->
                                        <div class="form-group row">
                                            <label class="col-form-label text-dark col-5">Expire date </label>
                                            
                                                <input type="text" class="form-control form-control-sm col-2 check-in" name="txtmonth" id="txtmonth" size="2" maxlength="2" placeholder="mm">&nbsp;/&nbsp;
                                                 <input type="text" class="form-control form-control-sm col-2 check-in" name="txtyear" id="txtyear" size="2" maxlength="2" placeholder="yy">                    
                                        </div>
            <!-----------------CVV Number--------->
                                        <div class="form-group row">
                                            <label class="col-form-label text-dark col-5">CVV No</label>
                                            <input type="text" class="col-2 form-control form-control-sm check-in"name="txtcvc" id="txtcvc" size="3" maxlength="3">                     
                                        </div>
<!--------------------- Payment ------------------------------>
                                        <div class="form-group row">
                                        
                                            <label class="col-form-label text-dark col-5">Total (Rs)</label>
                                <!-- Total Price -->            
                                        <input type="text" readonly="readonly" class="col-4 text-right form-control form-control-plaintext check-in bg-transparent" name="total_price" id="total_price"  value="0.00" >
                                                                                           
                                        </div>
                                        <div class="form-group row">
                                        
                                            <label class="col-form-label text-dark col-5">Pay amount(Rs.)</label>
                                <!-- Paid  Price -->             
                                            <input type="text"  class="col-4 text-right form-control form-control-sm check-in" name="amount" id="amount" value="0.00" >                                                             
                                        </div>
                                        <div class="alert alert-info" id="pay_alert" role="alert">
                                            <span class="text-info">You need to Pay More than &nbsp; Rs.</span> <output id="show_price" class="text-info" name="show_price"></output>
                                           
                                        </div>
                                        
                                        <div>
                                            <input type="button" name="btnpay" id="btnpay" class="btn btn-danger btn-sm" value="PAY NOW">

                                        </div>
                                                                                
                                    </div>

                                    <div class="col-lg-6 col-sm-11">
                                        <img src="resources/img/web-home/creditcard.png" class="w-100" >
                                    </div>
                                    
                                </div>
                                
                            </form>

                        </div>

                    </div>
                </div>
                <!--------left Side of payment details box End--------->

                <!-------Left Side of Delivery details box start------------>


                <div class="card bg-register-image m-4">
                    <div>
                        <div class="card-header">
                            <h4 class="text-dark">Delivery Information</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" readonly="readonly" class="form-control form-control-plaintext"  value="" id="cus_fname" name="cus_fname">

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" readonly="readonly" class="form-control"  placeholder="" value="" id="cus_lname" name="cus_lname" >

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email
                                    
                                </label>
                                <input type="email" readonly="readonly" class="form-control" id="cus_email" name="cus_email">

                            </div>
                            <div class=" row col-md-6 mb-3">
                                <label for="lastName">Contact Number</label>
                                <input type="text" readonly="readonly" class="form-control"  id="cus_number" name="cus_number" value="">

                            </div>
                            <div class="mb-3">
                                <label for="address">Address Line 1</label>
                                <input type="text" readonly="readonly" class="form-control" id="add_line1" name="add_line1">

                            </div>
                            <div class="mb-3 ">
                                <label for="address">Address Line 2</label>
                                <input type="text" class="form-control" readonly="readonly" id="add_line2" name="add_line2">

                            </div>
                            <div class="mb-3 ">
                                <div class="row mx-auto">
                                    <div class="col-3">
                                        <div class="form-group row">
                                            <label for="address" class="col-4 col-form-label">City</label>
                                            <input type="text" readonly="readonly" class=" col form-control" name="cus_city" id="cus_city">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="address" class="col-4 col-form-label" >District</label>
                                            <select name="cus_district" readonly="readonly" id="cus_district" disabled class="col custom-select">
                                                <?php getDestrict() ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label for="address" class="col-5 col-form-label">Province</label>
                                            <select name="cus_province" disabled id="cus_province" class="col custom-select">
                                                <?php getProvince() ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--------------------------------------Left Side of Delivery details box start--------------->


            </div>

            <!--------------------------------------Right Side of Checkout Page--------------->
            <div class="col-3 card bg-register-image mt-4" style="">

                <div class="card-header">
                    <h4>Order Summary</h4>

                </div>

                <div class="content ">
                    <div  id="prod_details">
                        <div class="row py-3">
                            <div class="col-lg-5 text-dark" id="prod_img">
                                <!--- product image here --->
                            </div>
                            <div class="col-lg-7">                            
                                <p id="prod_name" name="prod_name"></p>
                                
                                
                            </div>

                            
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-6"> product Price (Rs.)</label>
                        <div class="col">
                            <input type="text" readonly="readonly" class="form-control text-right" id="prod_dprice">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-6"> Quantity</label>
                        <div class="col">
                            <input type="text" readonly="readonly" class="form-control text-right" id="ord_dqty" name="ord_dqty">
                        </div>
                    </div>
                    
                    <hr class="bg-light" style="border: 0.5px solid black">
                    <div class="form-group row">
                        <label for="" class="col-lg-6">Total (Rs.)</label>
                        <div class="col">
                            <input type="text" readonly="readonly" class="form-control text-right" id="total" name="total">
                        </div>

                    </div>
                    <hr class="bg-light" style="border: 1px solid black">
                    
                    
                </div>
            </div>
        </div>
    

</div>
<script>
    $(document).ready(function () {
        var cusid = sessionStorage.getItem("cusid"); //customer id
        var prodid = sessionStorage.getItem("prod_id"); //product id
        var prod_sprice = sessionStorage.getItem("prod_sprice"); //product id
        var ordqty = sessionStorage.getItem("ordqty");    // request quantity
        var warrnodate = sessionStorage.getItem("warrnodate"); //no of date for warrenty

        $("#prod_id").val(prodid); 
        $("#ord_qty").val(ordqty);
        $("#warr").val(warrnodate);

        /* ------------ product Details ------------- */
        var url3 ="lib/mod_invoice.php?type=getProduct";
        $.ajax({
            method:"POST",
            url:url3,
            data:{prod_id:prodid},
            dataType:"json",
            success:function (result) {

               $("#prod_img").html("<img src='resources/img/products/"+result.prod_img+"' class='w-100'>");
               $("#prod_name").html(result.prod_name);  // product name to summery
               $("#ord_dqty").val(ordqty); //ord quantity to order summery
               $("#prod_cprice").val(result.bat_cprice); //product sell price to order summery
               $("#prod_dprice").val(prod_sprice); //product price to order summery
               $("#prod_price").val(prod_sprice); //product price to payment
               $("#bat_id").val(result.bat_id); // bat id to payment box


               var total = parseInt(ordqty)*parseFloat(prod_sprice);
               total = parseFloat(total).toFixed(2);
               $("#total").val(total); //total in order suppery
               $("#total_price").val(total); //total in payment
               $("#amount").val(total); //total in amount payment
               total = (total/100)*20;
               total = parseFloat(total).toFixed(2);
               
               $("#show_price").html(total); //total in amount payment
            },
            error:function (eobj, err, etxt ) {
                console.log(etxt);
            }
        });
        /* ------------ Load Customer Details ------------- */


         var urlcus ="lib/mod_invoice.php?type=getCustomerDetails";
        $.ajax({
            method:"POST",
            url:urlcus,
            data:{cusid:cusid},
            dataType:"json",
            success:function (result) {
                $("#cus_fname").val(result.cus_fname);
                $("#cus_lname").val(result.cus_lname);
                $("#cus_email").val(result.cus_email);
                $("#cus_number").val(result.cus_mobile);
                $("#add_line1").val(result.line1);
                $("#add_line2").val(result.line2);
                $("#cus_city").val(result.city);
                $("#cus_district").val(result.district);
                $("#cus_province").val(result.province);
               
            },
            error:function (eobj, err, etxt ) {
                console.log(etxt);
            }
        });

        $(".check-in").click(function(){
            $("#err_msg").addClass('d-none');
        })
        /* ------------ Load Customer Details ------------- */
        $("#btnpay").click(function(){
            var cno = $("#txtcno").val();
            var month = $("#txtmonth").val();
            var year = $("#txtyear").val();
            var cvc = $("#txtcvc").val();
                  


            // validate card number 
            var cpattern = /^[4-5]{1}[\d]{15}$/; // start from 4 or 5 and maximum 16 number
            if(!cno.match(cpattern)){
                
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("Invalied Card No");
                return;
            }

            //validate month
            var mopattern = /^[0-1]{1}[\d]{1}$/; 
            if(!month.match(mopattern)){
               
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("Invalied Month");
                return;
            }

            // validate month between 1 to 12
            month =parseInt(month);
            if((month<1)|| month>12){
                /*alert("Invalied Month");*/
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("Invalied Month");
            }

            // validate year 
            var cdate = new Date(); //current date
            var cyear = cdate.getFullYear();
            var cmonth = cdate.getMonth()+1;
            year = parseInt("20"+year);
            //check before current year
            if(year<cyear){
                
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("Invalied Year");
                return;
            }
            // current year next month
            if((year==cyear) && (month<cmonth)){
                /*alert("Invalied Expiry date");*/
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("Invalied Expiry date");
                return;
            }
            // cvv pattern 3 numbers
            var cvcpattern = /^[\d]{3}$/;
            if(!cvc.match(cvcpattern)){
                /*alert("invid CVC No");*/
                $("#err_msg").removeClass('d-none');
                $("#err_msg").html("invid CVC No");
                return;
            }

            var min_price = $("#show_price").val();
            var amount = $("#amount").val();
            
            if(parseInt(min_price)>parseInt(amount)){
                swal("Sorry","Please pay more than Rs. "+min_price,"error");
                return;
            }
       

            
            var data = $('#pay_form').serialize();
            var url  = "lib/mod_invoice.php?type=addNewInv";
            $("#loadingImage").modal();

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function (result) {       
                    $("#loadingImage").modal('hide');
                    res = result.split(",");
                    if(res[0]=="0"){
                        swal("Error",res[1],"error")
                    }
                    else if(res[0]=="1"){
                        $("#checkout_body").removeClass('d-none');
                        $("#chec_pay_body").addClass('d-none');
                        $("#msg_inv_id").html($("#inv_id").val());

                        sessionStorage.clear();
                    }
                }

            });
        });


    });
</script>


<?php require_once ("include/footer.php")?>



