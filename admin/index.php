<?php
require_once ("inc/header.php");
session_start();
 if(isset($_SESSION["user"])){
         $_SESSION["user"]["uname"];
        $_SESSION["user"]["uid"];
     header("Location:home.php");
 }
?>

<div class="row justify-content-center">

    <div class="col-lg-4 col-sm-4" >

      <div class="card mt-5 col-lg-10 col-sm-4 shadow-lg"  >
          <div class="pt-2">

          </div>
          <div class="pt-2 mx-auto">
            <div class="  " >
             <img  src="../resources/img/NESMO logo.png" width="200px">
              <h4 class="h5 pt-2" align="center">USER LOGIN</h4>
            </div>
          </div>
          <form class="  col-11" >
            <div class=" form-group">
              <label for="user_name">Email Address</label>
              <input type="text" class="form-control" name="txtuname" id="txtuname" >
            </div>
            <div class="  form-group">
              <label for="user_pass">Password</label>
              <input type="password" class="form-control " name="txtupass" id="txtupass" placeholder="">
                <span><a href="#" id="forget_pass"> Forgot Password ?</a></span>
            </div>
            <div class="form-group">
              <input type="button" class="btn btn-success" name="btnlogin" id="btnlogin" value="Login" >
                <a href="index.php" class="btn btn-danger" name="btncancel" id="btncancel" >Clear</a>
                <span id="img_loading" style="display: none"><img  src="../resources/img/loading.gif" alt=""     width="50px" ></span>
            </div>

          </form>
          <div class="pb-2">

          </div>
      </div>
        <a class=" p-3" href="../index.php"><i class="fas fa-arrow-circle-left"></i> Back to Website</a>
    </div>

</div>

<script>
    function manage_click(arg){
        if (arg=="0"){
            $("#img_loading").css("display","inline");
            $("#btnlogin").attr("disabled",true);
        }else if(arg=="1"){
            $("#img_loading").css("display","none");
            $("#btnlogin").attr("disabled",false);

        }
    }

    $("document").ready(function(){

        $("#txtupass").keypress(function (e) {
            if(e.which==13){
                $("#btnlogin").click();
            }
        });

        $("#btnlogin").click(function(){
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
                      
                      result = result.trim();
                        manage_click("1");
                        if(result=="1"){
                            location.href="lib/route.php";

                        }else if(result=="2"){
                            swal("Login Failed !","user name or password is wrong","error");

                        }else if(result=="3"){
                            swal("Login Failed !","user name or password is wrong","error");
                        }else{
                          alert(result);
                        }
                    },
                    error:function(eobj,etxt,err){
                        console.log(etxt);
                    }

                });
            }
        });
        $("#forget_pass").click(function () {
            swal("Contact Admin","Please Send a email to admin with your details","warning" );
        });
    })

</script>
