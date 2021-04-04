
<?php
session_start();
//add main Navigation


 require_once("include/main_nav.php") 
 ?>


<img src="resources/img/web-home/nesmo.png" class="w-100" alt="">

<?php /*require_once("include/main_slider.php") */?>

<div class=" mb-5 bg-password-imaget " >
        <div class="pb-4 text-muted">
            <h2 align="center">Our Products</h2>
        </div>
        <div class="container-fluid row justify-content-center">
                <div class="col-5 col-lg-3 col-sm-4">
                    <a href="shop.php?cat=domestic" >
                        <div class="card cat-box shadow-lg rounded">
                           <img class="" src="resources/img/web-home/domestic.jpg" alt="" width="100%">                           
                        </div>
                    </a>
                </div>
                <div class="col-5 col-lg-3 col-sm-4 " >
                    <a href="shop.php?cat=commercial" >
                        <div class="card cat-box">
                           <img class="" src="resources/img/web-home/commercials.jpg"  alt="" width="100%">
                          
                        </div>
                    </a>
                </div>
                <div class="col-5 col-lg-3 col-sm-4">
                    <a href="shop.php?cat=accessories" >
                    <div class="card cat-box">
                       <img class="" src="resources/img/web-home/industrial.png" alt="" width="100%">
                       
                    </div>
                    </a>
                </div>
        </div>
    </div>
    <div class=" container ">
        <!--- What is Ro  box --->
        <div class="row text-secondary">
                <div class="col-sm-4">
                    <img src="resources/img/what_ro.jpg" alt="" width="300" style="border-radius: 50% ; border: solid 2px blue; padding: 5px">

                </div>
                <div class="col">
                    <h3 style="font-family: 'cursive'">What is RO?</h3>
                    <p style="font-family: cursive; font-size: 18px"> RO is the Reverse Osmosis technology for filling water, it's usefull for every time for filtering water.
                    This is latest technology. that use popular country.</p>
                    <a class=" btn btn-lg btn-primary" href="waterhelth.php" id="click">Read More</a >
                </div>
        </div>
    </div>



<div class="">

</div>
    <div class="">
        <h2 align="center" id="contac_1" >Why Choose Us?</h2>
        <div class="container ">
            <div class="row">

                <div class="col-lg-3 col-sm-4  "  >
                    <img src="resources/img/web-home/dwlivery-image.png" class=" mt-4" alt="" width="100%" style="">
                    <h5 class="h5 text-center text-primary"> Free Delivery Service</h5>
                </div>
                <div class="col-lg-3 col-sm-4 " >
                    <img src="resources/img/web-home/after-service.png" class="mt-4" alt="" width="100%">
                    <h5 class="h5 text-center text-primary"> After Service</h5>
                </div>
                <div class="col-lg-3 col-sm-4 " >
                    <img src="resources/img/web-home/24-7.png" class=" mt-4" alt="" width="100%">
                    <h5 class="h5 text-center text-primary">24/7 Contact Service</h5>
                </div>
                <div class="col-lg-3 col-sm-4 " >
                    <img src="resources/img/web-home/ware-bottle.png" class="w-100 mt-4" alt="">
                    <h5 class="h5 text-center text-primary">No Need Water Bottles</h5>
                </div>
            </div>

        </div>

    </div>
<div class="py-lg-4 py-sm-2">

</div>
<hr>
    <div class="p-3  ">
        <h2 class="h2 text-primary text-md-center"> Portfolio</h2>
        <div class="container">
            <div class="row">
                <?php 

                    $dirname = "resources/img/Gallery/";
                    $images = glob($dirname."*.jpg");

                    foreach($images as $image) {
                        echo '<div class="col-sm-6 col-lg-3">
                            <a data-fancybox="gallery" href="'.$image.'" target="_blank">
                        <img class="img_gal w-100 my-2" src="'.$image.'"  />
                        </a></div>';
                    }
                ?>
                
            </div>
        </div>

    </div>

 
    

<?php require_once ("include/footer.php")  ?>