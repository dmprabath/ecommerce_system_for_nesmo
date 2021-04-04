<?php

    $type = $_SESSION["user"]["utype"];
    $name = $_SESSION["user"]["uname"];
                     
 ?>


<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion ccs" id="accordionSidebar" >

    <!-- Sidebar - Brand -->
    
    <div class="text-light" align="center" >
        <img class="img-profile rounded-circle " align="center" src="../resources/img/profile/<?php
        if(isset($_SESSION["user"]["image"])){
            $image = $_SESSION["user"]["image"];
            echo($image);
        }else{
            echo("user.png");
        }
        ?>" width="50%">

        <h6><?php
            echo "$name";
            ?>
        </h6>
        <h6>( <?php
            if($type==1){
                echo "Admin";
            }else if($type==2){
                echo "Manager";
            }else if($type==3){
                echo "Sales ";
            }else if($type==4){
                echo "Technician ";
            }else{
                echo "Employee ";
            }
            ?> )</h6>

    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" id="side_home" href="home.php">
            <i class="fas fa-2x fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <!-- Interface -->
    </div> 

    <!-- Nav Item - Pages Collapse Menu -->
       
   
    <li class="nav-item mt-0 pt-0">
        <a class="nav-link py-2 " id="view_inv" onclick="funViewInv();" href="#" >
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Invoice </span>
        </a>
        
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewProd()" id="view_prod">
            <i class="fas fa-cash-register"></i>
            <span>Products</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewStock()" id="view_grn">
            <i class="fas fa-store-alt"></i>
            <span>Stock Mgt.</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewWarrenty()">
            <i class="fas fa-circle-notch"></i>
            <span>Warrenty</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>


<script type="text/javascript">
    function viewProfile(){     // view logged user prrofile
        $("#rpanel").load("view/your_profile.php");
    }

    


    function funViewInv(){      // view all invoice
        $("#rpanel").load("technician/view_inv.php");
    }

    function funViewCus(){      // view all Customer
        $("#rpanel").load("technician/view_customer.php");
    }
    function funViewProd(){    // view all Product
        $("#rpanel").load("technician/view_product.php");
    }

    function funViewStock(){    // view all Stock
        $("#rpanel").load("technician/view_stock.php");

    }

    
    function  funViewWarrenty() {    // view all reports
        $("#rpanel").load("technician/view_warr.php");
    }


</script>
