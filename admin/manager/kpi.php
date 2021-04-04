<?php
/*require ("lib/common.php");*/
?>
<div class="">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Manager Report</a>
</div>

<!-- Content Row -->

    <div class="container row">
        <div class="col-lg-12 row  shadow animated fadeInUp ">
                <div class="col-xl-3 col-md-6 my-4">
                    <div class="card  border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registered Customers</div>
                                    <div class="h5 mb-0 font-weight-bold text-success">
                                        <?php  customerCount() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 my-4">
                    <div class="card   border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-primary">5</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-primary"></i></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="col-xl-3 col-md-6 my-4">
                    <div class="card   border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders</div>
                                    <div class="h5 mb-0 font-weight-bold text-primary"><?php orderCount() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cart-arrow-down fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-3 col-md-6 my-4">
                <div class="card  border-left-primary bg-light  h-100 py-2 " >
                    <div class="card-body">
                         <?php
                            $stocklevel = getProductOutStock();
                            if($stocklevel=="0"){
                                $txtcol = "text-primary";
                            }else{
                                $txtcol = "text-danger";
                            }
                        ?>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold <?php echo $txtcol ; ?> text-uppercase mb-1">Out OF Stock</div>
                                <div class="h5 mb-0 font-weight-bold ">
                                   <p class='text-danger'><?php echo $stocklevel; ?></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x <?php echo $txtcol ; ?>"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div id="product-remain" class="p-2" >FusionCharts will render here</div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div id="customer-reg" class="p-2"  >FusionCharts will render here</div>
        </div>

    </div>
    <div >

    </div>

<div  class="text-light">

	

</div>

<script>
    
    $(document).ready(function () {
            $.ajax({
                url: "lib/common.php?type=prodRemCount",
                type: "GET",
                success: function(data) {
                    chartData = data;

                    var chartProperties = {
                        "theme": "zune",
                        "caption": "Product Quantity",
                        "subCaption": "Today",
                        "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",

                        "showBorder": "0",
                        "use3DLighting": "0",
                        "showShadow": "0",
                        "enableSmartLabels": "0",
                        "startingAngle": "0",
                        "showPercentValues": "1",
                        "showPercentInTooltip": "0",
                        "decimals": "1",
                        "captionFontSize": "14",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "toolTipColor": "#ffffff",
                        "toolTipBorderThickness": "0",
                        "toolTipBgColor": "#000000",
                        "toolTipBgAlpha": "80",
                        "toolTipBorderRadius": "2",
                        "toolTipPadding": "5",
                        "showHoverEffect": "1",
                        "showLegend": "1",
                        "legendBgColor": "#ffffff",
                        "legendBorderAlpha": '0',
                        "legendShadow": '0',
                        "legendItemFontSize": '10',
                        "legendItemFontColor": '#666666'
                    },
                    apiChart = new FusionCharts({
                        type: "column3d",
                        renderAt: "product-remain",
                        dataFormat: "json",
                        dataSource: {
                            chart: chartProperties,
                            data: chartData
                        }
                    });
                    apiChart.render();
                }
            });
        $.ajax({
            url: "lib/common.php?type=cusRegCount",
            type: "GET",
            success: function(data) {
                chartData = data;

                var chartProperties = {
                        "theme": "zune",
                        "caption": "Customer registration Performance",
                        "subCaption": "Today",
                        "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                        "showShadow": "0",
                        "legendBgColor": "#ffffff",
                        "use3DLighting": "0",
                        "legendItemFontColor": '#666666',


                    },
                    apiChart = new FusionCharts({
                        type: "line",
                        renderAt: "customer-reg",
                        dataFormat: "json",
                        dataSource: {
                            chart: chartProperties,
                            data: chartData
                        }
                    });
                apiChart.render();
            }
        });

        });


</script>