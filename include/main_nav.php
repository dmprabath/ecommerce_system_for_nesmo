<?php 
require_once("include/header.php") ;
require("lib/function.php");
require("lib/common.php");

require("lib/mod_cus.php");
?>

<style type="text/css">
    
    .fixed-top2 {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 1020;
}
    /*.nav_sticky + .body_content{
        padding-top: 100px;
    }*/
    
</style>
<?php
   // session_start();
    
        if(isset($_SESSION["customer"]["uname"]) && $_SESSION["customer"]["uid"] !="") {
            $cusid =$_SESSION["customer"]["uid"];
            $name = $_SESSION["customer"]["uname"];
        }else{
            $name="";
        }
?>

<div id="web-body " >
    <header class="fixed-top55 ">
<div class="topbar   mb-1" style="">
    <nav class="navbar navbar-default bg-primary">
        <div class="mx-5 container-fluid" >
            <div class="navbar-header">
                <a href="tel:+940703665500" class="text-light"><i class="fas fa-phone-volume"></i>  070 366 5500</a>
                <span class="text-light">   <i class="fas fa-truck"></i> Free Delivery</span>
            </div>
            <div>

                <span class="nav-item text-light">
                    <?php
                    if ($name==""){
                       ?> <!--
                     /
                    <span class="text-light"><a class="text-light"  href="#" id="btnlogin" > <i class="fas fa-user"> </i> Login</a></span> -->
                    <span class="nav-item text-primary">
                        <button type="button" id="btn_login" class="btn btn-light " data-toggle="modal" data-target="#login_form">  Login
                        </button>
                    </span>
                    <span class="nav-item text-primary">
                        <a class="btn btn-light" href="register.php">  Register
                         </a>
                    </span>
                    <?php

                    }else{
                        ?>
                            <span> <button type="button" class="btn btn-light"  onclick="logout()"><i class="fas   fa-sign-out-alt"></i> Logout</button>

                            </span>
                    <?php
                    }
                    ?>
                </span>
            </div>
        </div>
    </nav> 
</div>
<div class="" id="menubar" style="background-color: #e6f2ff;">
    <nav  class="navbar navbar-expand-sm navbar-light bg-transparent "  >
        <a href="index.php" class="col-lg-2 col-sm-8 navbar-brand"><img src="resources/img/NESMO%20logo.png" width="100%" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="nav nav-pills  ">
                <li class="active ">
                    <a class="nav-link bg-light text-secondary mr-2"   href="index.php"></span>Home</a>
                </li>
                <li >
                    <a class="nav-link bg-light text-secondary mr-2 " id="nav_shop" href="shop.php" >shop</a>
                </li>
                <li >
                    <a class="nav-link bg-light text-secondary mr-2 "  href="waterhelth.php">Water and Health</a>
                </li>
                <li >
                    <a class="nav-link bg-light text-secondary mr-2 "  href="about.php">About</a>
                </li>
                <li >
                    <a class="nav-link bg-light text-secondary mr-2 "  href="contact.php">Contact</a>
                </li>

            </ul>

        </div>
            <ul class="navbar-nav navbar-right mr-5">
                <?php if($name != ""){
                    ?>
                    <div class="btn text-primary"><i class="fas fa-user"></i> HI  <?php echo( $name )?></div>
                <a href="myaccount.php" class="btn btn-info" id="text-account">Account  <?php countcusnotification($cusid) ?> </a>
                    <?php
                } ?>
                
                    
            </ul>

    </nav>
</div>
<div class="modal" id="loadingImage" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-conten bg-transparent">
      <img src="resources/img/loading.gif" class=" text-center w-50">
    </div>
  </div>
</div>

</header>

<script >
     window.onscroll = function() {stickyfunction()} ;

    var nav_bar = document.getElementById("menubar");
    var stop = nav_bar.offsetTop;

    function stickyfunction(){
        //alert(stop);
        if(window.pageYOffset >= stop){
            //alert(stop);
            nav_bar.classList.add("fixed-top2");
            nav_bar.classList.add("bg-light");
        }else{
            nav_bar.classList.remove("fixed-top2");
        }
    }

    function logout(){
        swal({
            title: "Are you Sure ?",
            text: "You are trying to logout from the website" ,
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                $("#loadingImage").modal();
                setTimeout(function(){
                    window.location.assign("lib/logout.php");
                },1500);
                //window.location.assign("lib/logout.php");   
            }
        });
    }
    $(document).ready(function(){
        /*var cusid = "<?php $cusid ?>";
        var url = "lib/common.php?type=countcusnotification";

        $.ajax({
            method:"POST",
            url:url,
            data:{cusid:cusid},
            dataType:"text",
            success:function (result) {
               $("#text-account").html(result);
            },
            error:function (eobj, err, etxt) {
                console.log(etxt);
            }
        });*/
    })

</script>