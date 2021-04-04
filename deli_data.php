<?php
session_start();
//add main Navigation
if(!isset($_SESSION["customer"]["uname"])) {
     header("Location:index.php");       
}

require_once("include/main_nav.php");

?>

<div class="bg-dark breadcrumb text-light " >
    <h3  class="my-3 mx-auto font-italic " >Information</h3>
</div>

<div class="container-fluid  bg-register-image">
    <form >
    <div class="row pl-5">
        <!--------------------------------------Left Side of Checkout Page-->
        <div class="col-8">

            <div class="card bg-register-image m-4">
                <!--------------------------------------Delivery details Box Start--------------->

                <div>
                    <div class="card-header">
                        <h4 class="text-secondary">Delivery Information</h4>
                    </div>
                    <small class="text-danger ml-2">* Required Fields</small>
                    <div class="card-body">
                        <input type="hidden" value="<?php echo($cusid) ?>" id="cus_id" name="cus_id">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name <strong class="text-danger ">* </strong></label>
                                    <input type="text" class="form-control"  value="" id="cus_fname" name="cus_fname">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name <strong class="text-danger ">* </strong></label>
                                    <input type="text" class="form-control"  placeholder="" value="" id="cus_lname" name="cus_lname" >
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email
                                    <strong class="text-danger ">* </strong>
                                </label>
                                <input type="email" class="form-control" id="cus_email" name="cus_email">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class=" row col-md-6 mb-3">
                                <label for="lastName">Contact Number <strong class="text-danger ">* </strong></label>
                                <input type="text" class="form-control"  id="cus_number" name="cus_number" value="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address Line 1 <strong class="text-danger ">* </strong></label>
                                <input type="text" class="form-control" id="add_line1" name="add_line1">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <label for="address">Address Line 2 <strong class="text-danger ">* </strong></label>
                                <input type="text" class="form-control" id="add_line2" name="add_line2">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="mb-3 ">
                                <div class="row mx-auto">
                                    <div class="col-3">
                                        <div class="form-group row">
                                            <label for="address" class="col-5 col-form-label">City <strong class="text-danger ">* </strong></label>
                                            <input type="text" class=" col-7 form-control" name="cus_city" id="cus_city">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group row">
                                            <label for="address" class="col-5 col-form-label" >District <strong class="text-danger ">* </strong></label>
                                            <select name="cus_district" id="cus_district" class="col-7 custom-select">
                                                <?php getDestrict() ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label for="address" class="col-4 col-form-label">Province <strong class="text-danger ">* </strong></label>
                                            <select name="cus_province" id="cus_province" class="col custom-select">
                                                <?php getProvince() ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>

                    </div>

                </div>
            </div>
            <!--------------------------------------Delivery details Box End--------------->



        </div>

        <!--------------------------------------Right Side of Checkout Page----------------->
        <div class="col-3 card bg-register-image mt-4" style="">
            <!--------------------------------------Order Summery Start----------------->

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
                            <input type="text" readonly="readonly" class="form-control text-right" id="prod_price">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-6"> Quantity</label>
                        <div class="col">
                            <input type="text" readonly="readonly" class="form-control text-right" id="ord_qty" name="ord_qty">
                        </div>
                    </div>
                    
                    <hr class="bg-light" style="border: 0.5px solid black">
                    <div class="form-group row">
                        <label for="" class="col-lg-6">Total</label>
                        <div class="col">
                            <input type="text" readonly="readonly" class="form-control text-right" id="total" name="total">
                        </div>

                    </div>
                    <hr class="bg-light" style="border: 1px solid black">
                    
                    <div class="text-right pr-2">
                        <input type="button" class="btn btn-primary " value="Confirm"  name="confirm" id="confirm">
                    </div>
                </div>
            <!--------------------------------------Order Summery End----------------->
        </div>
        </div>
    </form>


</div>
<script>
    $(document).ready(function () {        
        var cusid = sessionStorage.getItem("cusid"); //customer id
        var prodid = sessionStorage.getItem("prod_id"); //product id
        var prod_sprice = sessionStorage.getItem("prod_sprice"); //product id
        var ordqty = sessionStorage.getItem("ordqty");    // request quantity
        var warrnodate = sessionStorage.getItem("warrnodate"); //no of date for warrenty
       

        /* ------------ product Details ------------- */
        var url3 ="lib/mod_invoice.php?type=getProduct";
        $.ajax({
            method:"POST",
            url:url3,
            data:{prod_id:prodid},
            dataType:"json",
            success:function (result) {

               $("#prod_img").html("<img src='resources/img/products/"+result.prod_img+"' class='w-100'>");
               $("#prod_name").html(result.prod_name);
               $("#ord_qty").val(ordqty);
               $("#prod_price").val(prod_sprice);
               var total = parseInt(ordqty)*parseFloat(prod_sprice);
               total = parseFloat(total).toFixed(2);
               $("#total").val(total);
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


        $("#confirm").click(function(){
            var fname = $("#cus_fname").val();
            var lname =$("#cus_lname").val();
            var email = $("#cus_email").val();
            var phone = $("#cus_number").val();
            var line1 = $("#add_line1").val();
            var line2 = $("#add_line2").val();
            var city = $("#cus_city").val();
            var district = $("#cus_district").val();
            var provin = $("#cus_province").val();

            var namePattern=/^([a-zA-Z ]{2,})$/;
            var emailpattern = /[^@]{1,64}@[^@]{4,253}$/;
            var number=/^([0-9]{10})$/;

            if(!fname.match(namePattern)){
                swal("Error","First name is not valied","error");
                return;
            }
            if(!lname.match(namePattern)){
                swal("Error","Last name is not valied","error");
                return;
            }
            if(!email.match(emailpattern)){
                swal("Error","Email is not valied","error");
                return;
            }
            if(!phone.match(number)){
                swal("Error","Contact Number is not valied","error");
                return;
            }

            if( fname=="" ||  lname=="" ||  email=="" ||  phone=="" ||  line1=="" ||  line2=="" || city =="" || district =="" ||  provin==""){
                swal("Error","Please fill all fields !","error");
                return
            }

                var data = $('form').serialize();
                var url = "lib/mod_invoice.php?type=add_cart";
                $.ajax({
                    method:"POST",
                    url:url,
                    data:data,
                    dataType:"text",
                    success:function (result) {
                     
                        res = result.split(",");
                        if (res[0] == "0") {
                            swal("Error", res[1], "error");
                        }
                        else if (res[0] == "1") {
                            var price = $("#total").val();                           
                            sessionStorage.setItem("tot_price",price);                           
                            window.location.href ="checkout.php"; // load chackout page
                        }
                    },
                    error:function (eobj, err, etxt ) {
                        console.log(etxt);
                    }
                });
        });


    })
</script>


<?php require_once ("include/footer.php")?>




