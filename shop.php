
<?php
session_start();
//add main Navigation
    require_once("include/main_nav.php") ;


        if (isset($_GET['cat'])){
            $cat =$_GET['cat'];
            //getProductBox($cat) ;
        } else{
            $cat = "0";
            //getProductBox($cat) ;
        }
?>

   

</div>
<div class="bg-dark text-light row py-3" >
    <div class="col-sm-12 text-center">
        <h3  class=" text-weight-bold " >SHOP</h3>
    </div>
    <div class="col-sm-12 text-center">
        <p  class="font-italic " ><i class="fas fa-1x fa-home"></i> Home <i class="fas fa-chevron-right"></i> Shop </p>
    </div>   
    
</div>

<div class="container-fluid row" >

    <div class="col-lg-2 col-sm-11 sidebar navbar-nav side-menu"  style="background-color: #f8f9fa"  >

        
        <li class="container nav-item text-center mt-4 ">
        <h4 class="text-left">Search </h4>            
            <small><input type="text" id="search-prod" class="form-control" name="
            "></small>
        </li>
        <li class="container nav-item text-center mt-4 ">            
            <h4 class="text-left">Categories</h4>
        </li>
        
        <li class="container nav-item my-1">            
            <button class="btn btn-primary col-lg-10 text-capitalize" id="0">All Products</button>
        </li>

        

        <?php
            $dbobj = DB::connect();
            $sql_cat ="SELECT * FROM tbl_category";
            $result = $dbobj->query($sql_cat);
            if($dbobj->errno){
                echo("SQl Error");
            }
            while($rec=$result->fetch_assoc()){
                ?>
                    <li class="container nav-item my-1">            
                        <button class="btn btn-primary col-lg-10 text-capitalize" id="<?php echo $rec['cat_name'] ?>">
                            <?php echo $rec['cat_name'] ?>
                                
                            </button>
                    </li>
                <?php
            }

         ?>
    </div>
    <input type="hidden" id="prod_cat" name="prod_cat" value="<?php  echo ($cat) ?>">
    <div class="col-lg-10 col-sm-11 row" >
        <div class="row" id="shop-product">
            
        </div>
        <div class="row" id="shop-productNot">
        </div>
    </div>
    

</div>


<div class="footer">
<?php require_once ("include/footer.php")  ?>
</div>

<script>
    $(document).ready(function () {
        var cat = "<?php echo $cat ?>";

        var url = "lib/mod_products.php?type=getProductBox";
        $.ajax({
            method:"POST",
            url:url,
            data:{cat:cat},
            dataType:"text",
            success:function (result) {

                $('#shop-product').html(result);

            },
            error:function (eobj, err, etxt) {
                console.log(etxt);
            }

        });

        $(".side-menu").on("click","button",function(){
            var cat = $(this).prop("id");
          
            //alert(cat)
            var url = "lib/mod_products.php?type=getProductBox";

            $.ajax({
                method:"POST",
                url:url,
                data:{cat:cat},
                dataType:"text",
                success:function (result) {
                    $('#shop-product').html(result);
                },
                error:function (eobj, err, etxt) {
                    console.log(etxt);
                }

            });
        });
        $("#search-prod").on(' keyup ',function(){
            var searchKey = $(this).val();
            //alert(searchKey);          
          
            var url = "lib/mod_products.php?type=searchProduct";

            $.ajax({
                method:"POST",
                url:url,
                data:{searchKey:searchKey},
                dataType:"text",
                success:function (result) {
                    $('#shop-product').html(result);
                },
                error:function (eobj, err, etxt) {
                    console.log(etxt);
                }

            });
        });
        
    })
</script>