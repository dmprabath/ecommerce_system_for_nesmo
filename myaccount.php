
<?php
session_start();
//add main Navigation
if(!isset($_SESSION["customer"]["uname"])) {
     header("Location:index.php");       
}else{
    $cusname = $_SESSION["customer"]["uname"];
    $cusid = $_SESSION["customer"]["uid"];
}

require("include/main_nav.php");


?>
<div class="bg-light">
    



<div class="bg-dark breadcrumb text-light " >
    <h6  class="my-1 mx-auto font-italic " >My Account</h6>
</div>

<div class="container">
 
        <div class="row p-3">
            <div class="col-lg-3 col-xl-3 col-sm-11">
                <div class="card border border-dark">  
                             
                     <div class="nav flex-column nav-pills p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active py-2" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">My Orders</a>
                        <a class="nav-link py-2" id="v-pills-profile-tab" id="btn_prof" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Notification <?php countcusnotification($cusid) ?></a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">After Service</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-xl-9 col-sm-11">
                 <div class="card border border-dark h-100">  
                <div class="tab-content p-3" id="v-pills-tabContent ">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="card-header">
                            My Orders
                        </div>
                       
                        <div id="tbl_myorder">
                                                    
                        </div>
                        <!--------------------start ---------------------->
                        
                        <!--------------------end ---------------------->

                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                         <div class="card-header">
                            My Profile
                        </div>
                        <form id="form_cus">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <input type="hidden" id="cus_id" name="cus_id" value="<?php echo( $cusid)?>">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4">First Name :</label>
                                    <input type="text" class="col-lg-5  form-control-plaintext form-control-sm form-control bg-transparent readinput" disabled  id="cus_fname" name="cus_fname">

                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4">Email :</label>
                                    <input type="email" class="col-lg-7  form-control form-control-plaintext form-control-sm bg-transparent readinput" disabled id="cus_email" name="cus_email">


                                </div>
                                <div class="form-group row">
                                     <label for="address" class="col-lg-4">Address</label>
                                     <div class="col-lg-7 ">
                                        <input type="text" class=" form-control form-control-sm  form-control-plaintext bg-transparent readinput" disabled id="add_line1" name="add_line1" placeholder="Address Line 1">

                                         <input type="text" class="form-control form-control-sm  form-control-plaintext bg-transparent readinput" disabled id="add_line2" name="add_line2" placeholder="Address Line 2">

                                        <input type="text" class="form-control form-control-sm  form-control-plaintext bg-transparent readinput" disabled name="cus_city" id="cus_city" placeholder="City">

                                         <select name="cus_district" disabled id="cus_district" class="custom-select custom-select-sm bg-transparent readinput">
                                                <?php getDestrict() ?>
                                        </select>

                                        <select disabled name="cus_province" id="cus_province" class="custom-select mt-2 custom-select-sm bg-transparent readinput">
                                                <?php getProvince() ?>
                                        </select>
                                         
                                     </div>
                                    
                                    


                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="" class="col-lg-4">Last Name :</label>
                                    <input type="text" class="col-lg-5 form-control-plaintext form-control-sm form-control bg-transparent readinput" disabled id="cus_lname" name="cus_lname">

                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-lg-4">Mobile :</label>
                                    <input type="text" class="col-lg-5  form-control-plaintext form-control-sm form-control bg-transparent readinput" disabled id="cus_mobile" name="cus_mobile">

                                </div>
                            </div>                        


                        </div>
                            <div>
                                <button class="btn btn-primary btn-circle" type="button" id="btn-change"><i class="fas fa-edit"></i> Change</button>

                                <button class="btn btn-success btn-circle d-none" type="button" id="btn-update"><i class="fas fa-edit"></i> Update</button>

                                <button class="btn btn-danger btn-circle d-none" type="button" id="btn-cancel" onclick="$('#btn_prof').click();"><i class="fas fa-edit"></i> Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <div class="card-header">
                            Messages
                        </div>

                        <div>
                            <?php 
                                $dbobj =DB::connect();
                                $sql_mess = "SELECT * FROM tbl_notification nots JOIN tbl_cus_notification cus ON nots.not_id = cus.notif_id  WHERE cus_id ='$cusid' ORDER BY not_date DESC";
                                $result = $dbobj->query($sql_mess);
                                if($dbobj->errno){
                                    echo("SQL Error : " .$dbobj->error);
                                    exit;
                                }
                                while($rec = $result->fetch_assoc()){
                                    ?>
                                    <div class="redNotification my-1" id ="<?php echo $rec['not_id'] ;?>">
                                        <?php if ($rec['not_status']=="0"){
                                        ?>
                                           <div class="card bg-info p-3"    >
                                        <?php
                                            }else{
                                        ?>
                                             <div class="card bg-transparent p-3 "  >
                                        <?php   
                                            }
                                            
                                        ?>
                                        <h6 id="not_title"><?php echo $rec['not_title'] ?></h6>
                                        <p ><?php echo $rec['not_date']." ".$rec['not_time'] ?></p>
                                        <p id="not_msg"><?php echo $rec['not_msg'] ?></p>

                                    </div>

  
                                    </div>

                                    <?php
                                }


                            ?>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                         <div class="card-header">
                           After Service
                        </div>
                        <div class="card-content">
                            <table class="table small" id="warrTable"> 
                                <thead>
                                    <tr>
                                        <th>Inv_id</th>
                                        <th>Claim Date</th>
                                        <th>Items</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php cusWarrenty($cusid) ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>   


    </div>

</div>
</div>

<div class="modal  fade" id="addFeed" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="addForm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add your feadback</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Produc ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="rprod_id" name="rprod_id" readonly="readonly" value="" >                     

                    </div>
                    <form action="">
                        <div>
                            <div id="star_rate">

                                <span class="text-warning star" id="1" title="bad" ><i class="far fa-3x fa-star" id="s1"></i></span>
                                <span  class="text-warning star" id="2" title="satisfy"><i class="far fa-3x fa-star" id="s2"></i></span>
                                <span  class="text-warning star" id="3" title="good"><i class="far fa-3x fa-star" id="s3"></i></span>
                                <span  class="text-warning star" id="4" title="very-good"><i class="far fa-3x fa-star" id="s4"></i></span>
                                <span class="text-warning star" id="5" title="excellent"><i class="far fa-3x fa-star" id="s5"></i></span>

                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="" class="col-form-label">Message :</label>
                            <textarea name="feed_msg" id="feed_msg" class="col-lg-7 form-control" id="" cols="30" rows="5"></textarea>

                        </div>
                        <div>
                            <input type="button" class="btn btn-success" id="btn-send" value="SEND">
                        </div>
                    </form>

                </div>
                
            </div>
        </form>
    </div>
</div>
<!-------------------------------------- Warrenty Form Start----------------------->

<div class="modal  fade" id="reqWarrenty" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="warrForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Request Warrenty</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3">
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Order ID</label>:
                        <div class=" col-5">
                            <!--  Invoice ID --->
                            <input type="text" readonly  class="form-control-plaintext bg-transparent form-control-sm" name="prod_woiid" id="prod_woiid"> 
                            <!--  Product ID --->
                            <input type="text" readonly  class="form-control-plaintext bg-transparent form-control-sm" name="prod_woid" id="prod_woid">
                        </div>
                      </div>
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Description</label>:
                        <div class=" col-5">
                            <textarea id="warr_problem" class="form-control" name="warr_problem" >
                            
                            </textarea>
                        </div>
                    </div> 
                </div>   
                <input type="hidden" id="cus_id" name="cus_id" value="<?php echo( $cusid)?>">             

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"  id="btn_Wconfirm"> Confirm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  > Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-------------------------------------- Warrenty Form Start----------------------->

<div class="modal  fade" id="warrDetails" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="warrDetails" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3> Warrenty Details</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3" id="reqWarrDetails">
                    
                    
                </div>   
                <input type="hidden" id="cus_id" name="cus_id" value="<?php echo( $cusid)?>">             

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        /* ----------------- ----------------------------------------*/
        /* ----------------- Customer Details  -----------------*/
        /* ----------------- ----------------------------------------*/
        var cusid = $("#cus_id").val(); // customer ID
        var urlcus = "lib/mod_cus.php?type=viewCusProfile";
        $.ajax({
            method:"POST",
            url:urlcus,
            data:{cusid:cusid},
            dataType:"json",

            success:function(result){
                $("#cus_fname").val(result.cus_fname);
                $("#cus_lname").val(result.cus_lname);
                $("#cus_email").val(result.cus_email);
                $("#cus_mobile").val(result.cus_mobile);
                $("#add_line1").val(result.line1);
               $("#add_line2").val(result.line2);
               $("#cus_city").val(result.city);
               $("#cus_district").val(result.district);
               $("#cus_province").val(result.province);
            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
        });
        /* ----------------- ----------------------------------------*/
        /*----------------------- Order List ---------------------------- */
        /* -------------------------- ----------------------------------------*/
        var urlord = "lib/mod_cus.php?type=myOrderList";
        $.ajax({
            method:"POST",
            url:urlord,
            data:{cusid:cusid},
            dataType:"text",

            success:function(result){            
                $("#tbl_myorder").html(result);
            },
            error:function(eobj,etxt,err){
                console.log(etxt);
            }
        });
       /* ----------------- -------------------------------------------------*/
        /*----------------------- Feadback Section ---------------------------- */
        /* ------------------------ -------------------------------------------*/


        $("#tbl_myorder").on('click','button',function(){
            var type = $(this).attr('id');
            var prodid = $(this).attr('name');

            if(type=="btn_add_review"){   
                $("#rprod_id").val(prodid);  
                $("#addFeed").modal();       
           
            }else{
                id =prodid.split("/");
                $("#prod_woiid").val(id[0]);  //inovoice Id
                $("#prod_woid").val(id[1]);  //Order Id
                $("#reqWarrenty").modal();
            }
        });
            var rate = "0";
        $("#star_rate").on("click","span",function () {
            rate = $(this).attr('id');

            if(rate == '1'){
                $("#s1").addClass('fas');
                $("#s2").removeClass('fas');
                $("#s3").removeClass('fas');
                $("#s4").removeClass('fas');
                $("#s5").removeClass('fas');
            }else if(rate == '2' ){
                $('#s1').addClass('fas');
                $('#s2').addClass('fas');
                $("#s3").removeClass('fas');
                $("#s4").removeClass('fas');
                $("#s5").removeClass('fas');
            }else if(rate == '3' ){
                $('#s1').addClass('fas');
                $('#s2').addClass('fas');
                $("#s3").addClass('fas');
                $("#s4").removeClass('fas');
                $("#s5").removeClass('fas');
            }else if(rate == '4' ){
                $('#s1').addClass('fas');
                $('#s2').addClass('fas');
                $("#s3").addClass('fas');
                $("#s4").addClass('fas');
                $("#s5").removeClass('fas');
            }else if(rate == '5' ){
                $('#s1').addClass('fas');
                $('#s2').addClass('fas');
                $("#s3").addClass('fas');
                $("#s4").addClass('fas');
                $("#s5").addClass('fas');
            }

            return(rate);
        });
        $("#btn-send").click(function () {
           var feed_star = rate;
           var cus_id = $("#cus_id").val();
           var prod_id = $("#rprod_id").val();
           var feed_msg = $("#feed_msg").val();

           if(cus_id =="0"){
               swal("Sorry","Please login First","warning");
           }else{
               var url_star = "lib/function.php?type=addFeedback";

               $.ajax({
                   method:"POST",
                   url:url_star,
                   data:{cus_id:cus_id,prod_id:prod_id,feed_msg:feed_msg,feed_star:feed_star},
                   dataType:"text",
                   success:function (result) {
              
                       res = result.split(",");
                       if (res[0] == "0") {
                           swal("Error", res[1], "error");
                       }
                       else if (res[0] == "1") {
                           
                           location.reload();
                           
                       }
                   },
                   error:function (eobj, err, etxt) {
                       console.log(etxt);
                   }
               });
           }


        });
/* ---------------------------------------------------------------------*/
/*   ----------------- Profile section ---------------------*/
/* ---------------------------------------------------------------------*/
/* ---------------------------------------------------------------------*/
        $("#btn-change").click(function(){ //click change button in profile section
            $(".readinput").prop('disabled',false);
            $(".readinput").removeClass('form-control-plaintext');
            $("#btn-change").addClass('d-none');
            $("#btn-update").removeClass('d-none');
            $("#btn-cancel").removeClass('d-none');
        }); 
        $("#btn-cancel").click(function(){ //click Cancel button in profile section
            $(".readinput").prop('disabled',true);
            $(".readinput").addClass('form-control-plaintext');
            $("#btn-change").removeClass('d-none');
            $("#btn-update").addClass('d-none');
            $("#btn-cancel").addClass('d-none');
        });

        $("#btn-update").click(function(){ //update profile picture
            var add_line1 = $("#add_line1").val();
            var add_line2 = $("#add_line2").val();
            var cus_city  = $("#cus_city").val();
            var cus_district = $("#cus_district").val();
            var cus_province = $("#cus_province").val();
            var cus_email = $("#cus_email").val();
            var cus_mobile = $("#cus_mobile").val();

            var emailPattern = /[^@]{1,64}@[^@]{4,253}$/;
            var mobilePattern =/([0-9]){10}$/ ;
            if(add_line1==""){
                swal("Error","Please Enter Address line 1","error");
            }else if(add_line2==""){
                swal("Error","Please Enter Address line 2","error");
            }else if(cus_city==""){
                swal("Error","Please Enter your City","error");
            }else if(cus_district==""){
                swal("Error","Please Enter your District","error");
            }else if(cus_province==""){
                swal("Error","Please Enter your Province","error");
            }else if(!cus_email.match(emailPattern) || cus_email=="" ){
                swal("Error","Please Enter your Correct Email","error");
            }else if(!cus_mobile.match(mobilePattern) || cus_mobile=="" ){
                swal("Error","Please Enter your Contact number without any symbol","error");
            }else{
                var data = $('#form_cus').serialize();
                var url = "lib/mod_cus.php?type=updateCusProfile";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:data,
                    dataType:"text",
                    success:function(result){ 
                             
                      res = result.split(",");
                        if (res[0] == "0") {
                            swal("Error", res[1], "error");
                        } else if (res[0] == "1") {
                            swal("Success", res[1], "success");
                            setTimeout(function(){
                                location.reload();
                            },400);                 
                        }
                    },
                    error:function(eobj,etxt,err){
                        console.log(etxt);
                    }
                });

            }
            
        });

/*   -------------------------  Read Notification -----------------*/

        $("#v-pills-messages").on("click",".redNotification", function(){
            var id = $(this).attr("id");
            var title = $("#not_title").html();
            var message = $("#not_msg").html();

            $.ajax({
                method:"POST",
                url : "lib/mod_cus.php?type=readNotification",
                data:{id:id},
                dataType:"text",
                success:function(){
                    swal({

                        title: title,
                        text: message,
                    });
                }
            });
            
        });


/* ---------------------------------------------------------------------*/
/*   ----------------- Warrenty section ---------------------*/
/* ---------------------------------------------------------------------*/
/* ---------------------------------------------------------------------*/
        $("#btn_Wconfirm").click(function(){
            var data = $('#warrForm').serialize();
            var url = "lib/mod_cus.php?type=requestWarrenty";

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function(result){ 
                      
                  res = result.split(",");
                    if (res[0] == "0") {
                        swal("Error", res[1], "error");
                    } else if (res[0] == "1") {
                        swal("Success", res[1], "success");
                        setTimeout(function() {
                            location.reload(); 
                        }, 2000);                  
                    }
                },
                error:function(eobj,etxt,err){
                    console.log(etxt);
                }
            });
        });

/* ---------------------- read warrenty -------------------- */

        $("#warrTable tbody").on('click','button',function(){
            var type = $(this).attr('id');
            var warrid = $(this).attr('name');
          
            if(type=="detButton"){
                var url = "lib/mod_cus.php?type=viewMyWarrenty";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:{warrid:warrid},
                    dataType:"text",
                    success:function(result){
                        $("#reqWarrDetails").html(result);
                        $("#warrDetails").modal('show')
                    },
                    error:function(eobj,err,etxt){
                        console.log(etxt);
                    }
                });
                
                 
            }else if(type=="cancelButton"){
                var url = "lib/mod_cus.php?type=cancelMyWarrenty";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:{warrid:warrid},
                    dataType:"text",
                    success:function(result){
                       res = result.split(",");
                    if (res[0] == "0") {
                        swal("Error", res[1], "error");
                    } else if (res[0] == "1") {
                        swal("Success", res[1], "success");
                        setTimeout(function() {
                            location.reload(); 
                        }, 2000);
                                         
                    }
                    },
                    error:function(eobj,err,etxt){
                        console.log(etxt);
                    }
                });
                
                 
            }
        });



        


    });
    
</script>

<?php require_once ("include/footer.php")  ?>
