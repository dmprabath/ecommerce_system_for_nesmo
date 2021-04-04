<?php
session_start();
//add main Navigation 


if(isset($_GET['id'])){
    $prod_id =$_GET['id'];
}
require_once("include/main_nav.php");

?>

<div  style="background-color: #abe0ff">
    <div  style="background-color: #abe0ff">


    <div class="breadcrumb  bg-gray-200 ">
        <li><a href="index.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a href="shop.php" class="text-primary"> Shop</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i> </li>
        <li><a  class="text-primary" id="bread_cat"> </a> </li>
    </div>



    <div class=" container  row text-info " >
        <!-----------------------------  image caursoul start ---------------------   -->
        <div class="col-lg-8 col-sm-11 ">
          <div class="bg-dark m-4 " style="border:1px solid black; border-radius: 10px">
            <div class="col-lg-7 mx-auto pt-2">              
               <img src="" id="img_box" class="w-100 rounded" alt="">                
            </div>
            <div class="container mx-auto" >
              <div id="other-Image" class=" p-2 row">
                  <?php
                    $dbobj = DB::connect();
                    $sql_o_image = "SELECT prod_image FROM tbl_prod_img WHERE prod_id='$prod_id'";
                    $result = $dbobj->query($sql_o_image);
                    while ($rec= $result->fetch_assoc()){
                      ?>
                      <div class="col-sm-4 col-lg-3 ">
                        <a data-fancybox="gallery" href="resources/img/products/<?php echo $rec['prod_image'] ?>" class=''><img src="resources/img/products/<?php echo $rec['prod_image'] ?>" class="w-100 my-auto rounded"></a>
                      </div>    
                      
                      <?php
                    }
                    $dbobj->close();
                   ?>                      
              </div>
            </div>
        </div>
    </div>

        <!-- -------------------  image caursoul End -------------------   -->
        <div class="col-lg-4 col-sm-11 ">
            <form >
            <div class="shadow row">
                <span class="h3 text-primary p-3 " id="prod_title"> </span>
            </div>

           <p style="font-size:18px" class="text-danger mt-4 "> <del id="sprice" style="font-size:1.5em"></del></p>

            <div class="col-sm-10 border border-white shadow form-group row ">
              <label  class= " col-sm-1 col-form-label-sm " style="font-size:1.75em">Rs.</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext bg-transparent form-control" name="prod_price" id="prod_price" value="" style="font-size:1.75em">
              </div>
            </div> 
            <div class="alert alert-warning row" role="alert">
                  More than 20% need to pay 
            </div>


                <div class=" row ml-2">
                   <input type="number" class="col-lg-2 form-control-sm form-control bg-gray-200 " name="item_qty" id="item_qty" min="1" value="1">
                    <span type="text" class="col-lg-7 text-dark "  id="rem_qty"></span>
                </div>
            <div class="mt-4">
                <input type="hidden" class=""  id="prod_id" name="prod_id" value="<?php echo($prod_id); ?>"/>
                <input type="hidden" class=""  id="cus_name" name="cus_name" value="<?php
                    if(isset($_SESSION["customer"]["uid"])){
                        echo($_SESSION["customer"]["uid"]);
                }else{
                        echo ("0");
                    }

                ?>"/>

                <div id="act_button">               
                
                    <?php
                        if(isset($_SESSION["customer"]["uid"])){
                    ?>
                    <button type="button" class="btn btn-success" id="btn_buy" >ADD TO CART</button> 
                    <?php
                        }else{
                    ?>
                    <button type="button" class="btn btn-success" id="btn_not">ADD TO CART</button>
                    <?php
                        }
                    ?>
                </div>


            </div>

            </form>
            <div class="">

                <div class="col-lg-11 text-dark" id="prod_desc">   </div>

                <div class="col-lg-11 pt-3 text-dark" id="warr">    </div>
            </div>



        </div>
    </div>
<div>
    <!-- --------------  Filter Stages ------------------   -->
    <hr class="" >
    <div class="container mx-auto" >
        <h2 class="h2 text-center pb-3">Filter Stages </h2>
        <div id="step_stage" class="row ">
            <div class="col-sm-4 col-lg-2 border-right border-dark" id="stage_pp">
                <p class="text-uppercase font-weight-bold  text-center" >PP Sediment</p>
                <img src="resources/img/web-home/stage_pp_sediment.png" alt="" width="100%">
                <p class="text-center">Filtration Process
                    Removes Rust, Silt,
                    Scale, Sediment, Dirt,
                    Coarse Sand and Sand
                    from water..</p>

            </div>
            <div class="col-sm-4 col-lg-2 border-right border-dark" id="stage_cto">
                <p class="text-uppercase font-weight-bold  text-center" >CTO Filter</p>
                <img src="resources/img/web-home/stage-cto_filter.png" alt="" width="100%">
                <p class="text-center">
                    Filtration Process
                    Reduces Cloudiness, VOCs,
                    Chlorine, Organic Chemicals,
                    Unnatural Tastes and Odors
                    found in tap water
                </p>
            </div>
            <div class="col-sm-4 col-lg-2 border-right  border-dark" id="stage_post">
                <p class="text-uppercase font-weight-bold  text-center" >POST Carbon</p>
                <img src="resources/img/web-home/stage-post_carbon.png" alt="" width="100%">
                <p class="text-center"> These
                    fast-acting filters can
                    eliminate or reduce the
                    levels of chlorine
                    by-products, pesticides,
                    herbicides, and other
                    organic and industrial
                    chemicals.</p>
            </div>
            <div class="col-sm-4 col-lg-2 border-right border-dark" id="stage_ro">
                <p class="text-uppercase font-weight-bold  text-center" >RO Membrane</p>
                <img src="resources/img/web-home/stage-ro_membrane.png" alt="" width="100%">
            </div>
            <div class="col-sm-4 col-lg-2 border-right border-dark" id="stage_udf">
                <p class="text-uppercase font-weight-bold  text-center" >UDF Filters</p>
                <img src="resources/img/web-home/stage-udf_filter.png" alt="" width="100%">
                <p class="text-center">Ultrafine Depth Filtration

                    Filtration Process
                    Reduces Chlorine,
                    Organic Chemicals,
                    Unnatural Tastes and Odors
                    found in tap water.</p>
            </div>
            <div class="col-sm-4 col-lg-2" id="stage_min">
                <p class="text-uppercase font-weight-bold  text-center" >Minaral</p>
                <img src="resources/img/web-home/stage-mineral.png" alt="" width="100%">
            </div>

        </div>

    </div>
    <!---------  Filter Specification ------------   -->
    <div class="col-lg-12 col-sm-12 container">
        <hr>
        <p class="font-weight-bold h2 underline " align="center">Specification</p>

        <div class="container w-50 bg-password-image">
            <div class="row">
                <div class="col">
                    <div class="text-primary">
                        <i class="fas fa-2x fa-coins"> Capacity</i> <span id="cap_details"></span>
                    </div>

                    <div class="text-primary">
                        <i class="fas fa-2x fa-power-off"> Power </i> <span id="pow_details"></span>
                    </div>

                    <div class="text-primary">
                        <i class="fas fa-2x fa-arrows-alt"> Dimension </i> <span id="dia_details"></span>
                    </div>

                </div>
                <div class="col">
                    <div class="text-primary">
                        <i class="fas fa-2x fa-plug"> Voltage</i> <span id="vol_details"></span>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-2x fa-archive"> Tank Capacity</i> <span id="tank_details"></span>

                    </div>
                    <div class="text-primary">
                        <i class="fas fa-2x fa-industry"> Material</i> <span id="met_details"></span>
                    </div>

                </div>

            </div>


        </div>



    </div>

    <div class="container   pb-5" style="background-color:white ">
        <div class="tab-pane ">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link" id="all-tab" data-toggle="tab"  href="#allfeed" role="tab" aria-controls="allfeed" aria-selected="true">All Reviews</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" id="add-tab" data-toggle="tab"  href="#addfeed" role="tab" aria-controls="addfeed" aria-selected="true">Add Reviews</a>
                </li>

            </ul>
            <div class="tab-content" id="TabContent">
                <div class="tab-pane fade show active px-4" id="allfeed" role="tabpanel" aria-labelledby="allfeed-tab"></div>
                <div class="tab-pane fade" id="addfeed" role="tabpanel" aria-labelledby="addfeed-tab">
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

        </div>
    </div>
</div>

</div>
</div>
<div class="footer">
    <?php require_once ("include/footer.php")  ?>
</div>

<script>
    $(document).ready(function () {
        var prodid =  $("#prod_id").val();
        var url = "lib/mod_products.php?type=getProductDetails";

        $.ajax({
            method:"POST",
            url:url,
            data:{prodid:prodid},
            dataType:"json",
            success:function (result) {

                $("#bread_cat").html(result.prod_modal);
                $("#img_box").attr("src","resources/img/products/"+result.prod_img);
               
                // products name
                if(result.prod_name !=""){
                    $("#prod_title").html(result.prod_name);
                }else{
                    $("#prod_title").html(result.prod_modal);
                }
                // product price

                if(result.prod_qty=="0"){
                  if (result.prod_dprice=="0.00") {
                    $("#prod_price").val(result.prod_price);
                  }else{
                    $("#sprice").html("Rs. "+result.prod_price);
                    $("#prod_price").val(result.prod_dprice);
                  }
                  
                }else{
                  if (result.prod_dprice=="0.00") {
                    $("#prod_price").val(result.bat_sprice);
                  }else{
                    $("#sprice").html("Rs. "+result.bat_sprice);
                    $("#prod_price").val(result.prod_dprice);
                  }
                  
                }

                $("#prod_desc").html(result.prod_desc);               
                
                if(result.prod_qty=="0"){
                     $("#rem_qty").html("/ Not Available");
                    $("#act_button").html("<button type='button' class='btn btn-danger'  >OUT OF STOCK</button> ");
                }else{
                     $("#rem_qty").html("/ "+result.bat_rem+" Available");
                }

                $("#warr").html("<p class='text-dark'>Warrenty : "+result.warrenty+"</p><input type='hidden' id='warr_date' value='"+result.nodate+"'>");
               
                $("#cap_details").html("<p class='text-primary'>"+result.capacity+"</p>");
                $("#pow_details").html("<p class='text-primary'>"+result.power+" Hz</p>");
                $("#dia_details").html("<p class='text-primary'>"+result.dimension+" cm</p>");

                $("#vol_details").html("<p class='text-primary'>"+result.voltage+" V</p>");
                $("#tank_details").html("<p class='text-primary'>"+result.tank_capacity+" ml</p>");
                $("#met_details").html("<p class='text-primary'>"+result.material+"</p>");
                var stage_pp = result.stage_pp;
                if(stage_pp=="0"){
                    $("#stage_pp").addClass("d-none");
                }
                var stage_cto = result.stage_cto;
                if(stage_cto=="0"){
                    $("#stage_cto").addClass("d-none");
                }

                var stage_post = result.stage_post;
                if(stage_post=="0"){
                    $("#stage_post").addClass("d-none");
                }

                var stage_ro = result.stage_ro;
                if(stage_ro=="0"){
                    $("#stage_ro").addClass("d-none");
                }
                var stage_udf = result.stage_udf;
                if(stage_udf=="0"){
                    $("#stage_udf").addClass("d-none");
                }

                var stage_min = result.stage_min;
                if(stage_min=="0"){
                    $("#stage_min").addClass("d-none");
                }
                 sessionStorage.setItem("bat_id",result.bat_id);
            },
            error:function (eobj, etxt, err) {
                console.log(etxt);
            }
        });
        /* ----------- function for image caursoul -------------*/
        var url2 = "lib/mod_products.php?type=getProductImage";

        $.ajax({
           method:"POST",
           url:url2,
           data:{prod_id:prodid},
           dataType:"text",
           success:function (result2) {
             $("#img_car").html(result2);
           } ,
            error:function (eobj, err, etxt ) {
                console.log(etxt);
            }
        });
        var url3 ="lib/function.php?type=getFeedback";
        $.ajax({
            method:"POST",
            url:url3,
            data:{prodid:prodid},
            dataType:"text",
            success:function (result) {
                $("#allfeed").html(result);
            },
            error:function (eobj, err, etxt ) {
                console.log(etxt);
            }
        });

        /* ---------------------- function for image caursoul -------------------*/


        $("#btn_not").click(function () {
            swal("Sorry","please login or register first","warning");
        });
        $("#btn_buy").click(function () {
           
            var cusid = $("#cus_name").val(); //quntity
            var ordqty = $("#item_qty").val(); //quntity
            var prod_sprice = $("#prod_price").val(); //quntity
            var rem_qty = $("#rem_qty").html(); //rem quantity
               rem_qty = rem_qty.replace("/ ","");
               rem_qty = rem_qty.replace(" Available","");
               rem_qty = rem_qty.trim();
               rem_qty = parseInt(rem_qty);
            if(rem_qty<ordqty){
                swal("Error","Request quntity is not available","error");
                return;
            }
            var warrnodate = $("#warr_date").val();

            if(ordqty==""){
                swal("Error","Please enter quantity","error");
                return;
            }
            sessionStorage.setItem("cusid",cusid); //customer id
            sessionStorage.setItem("prod_id",prodid); //product id
            sessionStorage.setItem("prod_sprice",prod_sprice); //product sell price
            sessionStorage.setItem("ordqty",ordqty);    // request quantity
            sessionStorage.setItem("warrnodate",warrnodate); //no of date for warrenty
           

              window.location.href ="deli_data.php";
           

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
           var cus_id = $("#cus_name").val();
           var prod_id = $("#prod_id").val();
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
                       }else if (res[0] == "1") {                           
                           location.reload();
                           
                       }
                   },
                   error:function (eobj, err, etxt) {
                       console.log(etxt);
                   }
               });
           }


        });

    });
</script>