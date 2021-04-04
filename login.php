<?php
require_once ("include/header.php");
?>

<div >

    <div >

      <div class="card col-sm-4 shadow-lg" style="left: 450px; top: 200px;" >
          <div class="mx-auto">
              <h4 >NESMO User Login</h4>

          </div>
          <form >
            <div class=" form-group ">
              <label for="user_name">User Name</label>
              <input type="text" class="form-control" name="txtuname" id="txtuname">
            </div>

            <div class="  form-group">
              <label for="user_pass">Password</label>
              <input type="password" class="form-control " name="txtupass" id="txtupass">
            </div>

            <div class="  form-group">
              <input type="button" class="btn btn-success" name="btnlogin" id="btnlogin" value="Login">
                <a href="index.php" class="btn btn-danger" name="btncancel" id="btncancel" >Cancel</a>
                <span id="img_loading" style="display: none"><img  src="resources/img/loading.gif" alt=""     width="50px" ></span>
            </div>

          </form>
          <div class="pb-2">
              <a href="#" id="forget_pass">Lost Your Password ?</a>
          </div>
      </div>
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
                        manage_click("1");
                        if(result=="1")

                            location.href="lib/route.php";

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
        $("#forget_pass").click(function () {
            swal("Follow this seps","Please Send a email to admin with your details","warning" );
        });
    })

</script>
