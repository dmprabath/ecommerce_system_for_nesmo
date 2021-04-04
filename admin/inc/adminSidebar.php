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

    <!-- Nav Item - Pages Collapse Menu -->
    
        
    <li class="nav-item mt-0 pt-0">
        <a class="nav-link py-2 " id="view_inv" onclick="funViewInv();" href="#" >
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Invoice </span>
        </a>
        
    </li>
    <li class="nav-item">
        <a class="nav-link py-2 " id="view_emp" onclick="funViewEmp();" href="#" >
            <i class="fas fa-fw fa-cog "></i>
            <span>Users Mgt.</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link py-2" id="view_cus" href="#" onclick="funViewCus()">
            <i class="fas fa-user-tag "></i>
            <span>Customer Mgt.</span>
        </a>
        
    </li>

    <li class="nav-item" id="view_cat" onclick="funViewCat()">
        <a class="nav-link collapsed py-2" href="#" >
            <i class="fas fa-list-alt"></i>
            <span>Categories</span>
        </a>

    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewSup()" id="view_sup">
            <i class="fas fa-people-carry"></i>
            <span>Suppliers</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewProd()" id="view_prod">
            <i class="fas fa-cash-register"></i>
            <span>Products</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewGrn()" id="view_grn">
            <i class="fas fa-circle-notch"></i>
            <span>GRN</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewStock()" id="view_grn">
            <i class="fas fa-store-alt"></i>
            <span>Stock Mgt.</span>
        </a>
    </li>
    <li class="nav-item p-0">
        <a class="nav-link collapsed py-2" href="#"  onclick="funViewMsg()" >
            <i class="fas fa-4x fa-envelope"></i>
            <span>Messages</span>
        </a>
    </li>
    
    
    
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewWarrenty()">
            <i class="fas fa-circle-notch"></i>
            <span>Warrenty</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewRep()">
            <i class="fas fa-file-contract"></i>
            <span>Reports</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewDisc()">
            <i class="fas fa-file-contract"></i>
            <span>Discount</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" onclick="funViewBackup()">
            <i class="fas fa-circle-notch"></i>
            <span>Backups</span>
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
    /*--------------------------------- view profiles------------------------   */

   
    function viewProfile(){     // view logged user prrofile
        $("#rpanel").load("view/your_profile.php");
    }

    function funViewEmpProfile(){   // view employees profile
        $("#rpanel").load("view/view_profile.php");
    }

    /*--------------------------------- add details ------------------------   */

    function funAddInv(){ //add new employee
        $("#rpanel").load("view/add_inv.php");
    }
    function funAddEmp(){ //add new employee
        $("#rpanel").load("view/add_emp.php");
    }
    function funAddCus(){       //add new customer
        $("#rpanel").load("view/add_cus.php");
    }
    function funAddCat(){       //add new Category
        $("#rpanel").load("view/add_cat.php");
    }

    function funAddProduct_dom(){   //add new Products
        $("#rpanel").load("view/add_prod_dom.php");
    }
    function funAddProduct_com(){   //add new Products
        $("#rpanel").load("view/add_prod_com.php");
    }
    function funAddProduct_acc(){   //add new Products
        $("#rpanel").load("view/add_prod_acc.php");
    }
    function funAddGrn(){       // add new Grn
        $("#rpanel").load("view/add_grn.php");
    }

    /*--------------------------------- view Managment tables------------------------   */

    function funViewInv(){      // view all invoice
        $("#rpanel").load("view/view_inv.php");
    }
    function funViewEmp(){      // view all Employees
        $("#rpanel").load("view/view_emp.php");
    }
    function funViewCus(){      // view all Customer
        $("#rpanel").load("view/view_customer.php");
    }
    function funViewCat(){      // view all Category
        $("#rpanel").load("view/view_categories.php");
    }
    function funViewProd(){    // view all Product
        $("#rpanel").load("view/view_product.php");
    }
    function funViewSup() {     // view all Supplier
        $("#rpanel").load("view/view_supplier.php");
    }
    
    function funViewStock(){    // view all Stock
        $("#rpanel").load("view/view_stock.php");
    }
    function funViewGrn(){      // view all Grn
        $("#rpanel").load("view/view_grn.php");
    }
    function  funViewMsg() {    // view all Message
        $("#rpanel").load("view/view_msg.php");
    }
    function  funViewRep() {    // view all reports
        $("#rpanel").load("view/view_report.php");
    }
    function  funViewDisc() {    // view all reports
        $("#rpanel").load("view/view_discount.php");
    }
    function  funViewWarrenty() {    // view all reports
        $("#rpanel").load("view/view_warr.php");
    }
    function  funViewBackup() {    // view all reports
        $("#rpanel").load("view/view_backup.php");
    }
    



   
</script>
 