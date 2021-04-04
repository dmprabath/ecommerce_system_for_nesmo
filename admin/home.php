<?php require_once("inc/header.php"); ?>
<?php require("lib/common.php"); ?>
<?php

 session_start();
 if(!isset($_SESSION["user"])){
         $_SESSION["user"]["uname"];
        $_SESSION["user"]["uid"];
     header("Location:../index.php");
 }
?>
<div class="">
  <!-- Page Wrapper -->
  <div id="wrapper" class="  m-auto" >
      <!------------------------------ Sidebar ------------------------------------>
      <?php
      $type = $_SESSION["user"]["utype"];
      $uid =  $_SESSION["user"]["uid"];
      switch($type){
        case "1";
          require_once ("inc/adminSidebar.php" );
          break;
        case "2";
           require_once ("inc/managerSidebar.php" );
           break;
        case "3";
           require_once ("inc/salesSidebar.php" );
           break;
        case "4";
           require_once ("inc/technicianSidebar.php" );
           break; 
      }
      


      ?>


    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


            <a id="" href="home.php" class="btn btn-link  rounded-circle mr-3" >
                <i class="fa fa-2x fa-home"></i> <h5>Home</h5>
            </a>
            <?php
              if($type =="4"){
                ?>

                <?php
              }else {
                  ?>
                <a id="" href="#" class="btn btn-link  rounded-circle mr-3" onclick="funAddInv()">
                <i class="fas fa-2x fa-file-signature"></i> <h5>Creat Invoice</h5>
            </a>
                  <?php

              }
             ?>
            


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

              <div >
                  <a href="#" class="nav-link ">
                      
                  </a>
                  

              </div>
              
              <?php if($type != '4') {
                ?>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="funViewMsg()">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">
                  <?php  getUnreadMsgCount() ?>
                  
                </span>
              </a>
              <!-- Dropdown - Messages -->
              
            </li>
            <?php 
              } ?>
 
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-primary small">
                    <img class="img-profile rounded-circle " align="center" src="../resources/img/profile/<?php
                    if(isset($_SESSION["user"]["image"])){
                        $image = $_SESSION["user"]["image"];
                        echo($image);
                    }else{
                        echo("user.png");
                    }
                    ?>" width="50%">
                    <?php
                    if(isset($_SESSION["user"]["uname"])){

                        $name = $_SESSION["user"]["uname"];
                        $type = $_SESSION["user"]["utype"];

                        echo ("$name");
                    }else{

                        echo ("employee");
                    }
                    ?>

                     <i class="fas fa-bars"></i>
                </span>
                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" onclick="viewProfile()" id="your_prof">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid dash" id="rpanel" >


          <?php
          $type = $_SESSION["user"]["utype"];
          
          switch($type){
            case "1";
              require_once("view/kpi.php");
              break;
            case "2";
               require_once("manager/kpi.php");
               break;
            case "3";
               require_once("sales/kpi.php");
               break; 
            case "4";
               require_once("technician/kpi.php");
               break; 
          }



          ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->



<?php require_once("inc/footer.php") ?>
