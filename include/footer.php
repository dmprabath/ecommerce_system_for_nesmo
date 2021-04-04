
</body>
<div class="" > 
<div style="margin-top: 10px ; height: 10px;">
    
</div>

    <!-- Footer -->
    <footer class="page-footer font-small mdb-color  pt-4 " style="background-color: #f8f9fa"  >

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Footer links -->
            <div class="row text-center text-md-left mt-3 pb-3">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3  mt-3">
                    <!--<h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>-->
                    <img src="resources/img/NESMO logo.png" class="w-100">
                    <div>
                        <div class="h5">Social</div>
                        <div>  
                            <a href="https://www.facebook.com/nesmointernational/" target="_blank"><i class="fab fa-3x text-primary fa-facebook-square"></i> </a>
                            <a href="#"><i class="fab text-success fa-3x fa-whatsapp-square"></i></a> 
                            <a href="#"><i class="fab fa-3x text-primary fa-twitter-square"></i></a>
                        </div>
                    </div>

                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2  mt-3">               
                    
                        <img src="resources/img/web-home/dwlivery-image.png" class="w-75">
                        <img src="resources/img/web-home/paylogo.png" class="w-75">
                    
                    
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Our Services</h6>
                    <p>
                        <a href="#!">Water filter selling</a>
                    </p>
                    <p>
                        <a href="#!">Filter Accessories</a>
                    </p>
                    <p>
                        <a href="#!">Installion</a>
                    </p>
                    <p>
                        <a href="#!">Water Testing</a>
                    </p>
                </div>


                

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none">

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p>
                        <i class="fas fa-home mr-3"></i>103, Highlevel Road, Pannipitiya</p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> info@nesmo.lk</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> 070 366 5500</p>
                    <p>
                        <i class="fas fa-print mr-3"></i> 070 366 5500</p>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Footer links -->

            <hr>

            <!-- Grid row -->
            <div class="row d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-7 col-lg-8">

                    <!--Copyright-->
                    <p class="text-center text-md-left">© 2018 Copyright:
                        <a href="#">
                            <strong> Nesmo International (Pvt) .Ltd</strong>
                        </a>
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-5 col-lg-4 ml-lg-0">

                    <!-- Social buttons -->
                    <div class="text-center text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1" href="https://www.facebook.com/nesmointernational/" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

    </footer>
    <!-- Footer -->
</div>

 <!--  ######################  Login form   ##################   -->
<div class="modal fade " id="login_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel" >Login </h5>
        <button type="button" class="close" id="btn_close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body " >
         <form class="form">
            <div class=" form-group col-11 col-lg-11 col-sm-11 ">
                <input class="form-control" type="text" id="txtuname" name="txtuname" placeholder="Email">
            </div>
            <div class=" form-group col-11 col-lg-11 col-sm-11">
                <input class="form-control" type="password" id="txtupass" name="txtupass" placeholder="password">
                <span ><a class="font-italic " href="password-reset.php" style="font-size: 12px; align-content: right" >Forget Password..?</a></span>
            </div>
             <div>
                 <div class="row justify-content-end">
                     <img id="img_loading" class="mr-3 d-none" src="resources/img/loading.gif" alt="" width="40px"   >
                     <button type="button" class="btn btn-success btn mr-2" id="btnsubmit" >Submit</button>
                     <button id="btn_res" class="btn btn-danger btn mr-1"  type="reset">clear</button>
                 </div>
             </div>
         </form>
      </div>
    </div>
  </div>
</div>
    <!--  ######################  Register form   ##################   -->




<script>
    function manage_click(arg){
        if (arg=="0"){
            $("#img_loading").css("display","inline");
            $("#btnsubmit").attr("disabled",true);
        }else if(arg=="1"){
            $("#img_loading").css("display","none");
            $("#btnsubmit").attr("disabled",false);

        }
    }
/* --------------------customer login form submission ---------- */
    $("document").ready(function(){
        $("#txtupass").keypress(function (e) {
            if(e.which==13){
                $("#btnsubmit").click();
            }
        });

        $("#btnsubmit").click(function(){
            $("#img_loading").removeClass("d-none");
            manage_click("0");
            var uname,upass;
            uname = $("#txtuname").val();
            upass = $("#txtupass").val();

            if(uname=="" && upass==""){
                swal("Login Failed !","Please enter your user name and password","error");
                manage_click("1");
            }
            else{
                var fdata = $("form").serialize();
                var url ="lib/loginhandle.php";

                $.ajax({
                    method:"POST",
                    url:url,
                    data:fdata,
                    dataType:"text",
                    success:function(result){
                        manage_click("1");
                        if(result=="1")

                        window.location.reload();

                        else if(result=="2")
                            swal("Login Failed !","user name or password is wrong","error");

                        else if(result=="3")
                            swal("Login Failed !","user name or password is wrong","error");
                        else
                            alert(result);
                    },
                    error:function(eobj,etxt,err){
                        console.log(etxt);
                    }

                });
            }
        });

        /* --------------------customer register form submission ---------- */

        
    })

</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>
</html>