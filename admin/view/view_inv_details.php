<?php
if(isset($_GET['inv_id'])){
    $inv_id =$_GET['inv_id'];
    $date = $_GET['date'];
    $cus = $_GET['cus'];
}
?>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" class="text-dark" onclick="funViewInv()"> Invoice Management </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary"> Invoice  Details</a> </li>


</div>
<div class="container">

</div>
<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col-lg-5 form-label">Grn No</label>
            <input type="text" class="col-lg-7 form-control form-control-plaintext readonly " readonly    id="invid" name="invid" value="<?php echo($inv_id) ?>" >
        </div>
    </div>

    <div class="col-3">
        <div class="form-group row">
            <label for="" class="col-lg-4 form-label">Received Date</label>
            <input type="text" class="col-lg-7 form-control form-control-plaintext  " readonly id="rdate" name="rdate" value="<?php echo($date) ?>">
        </div>
    </div>
    <div class="col-5">
        <div class="form-group row">
            <label for="" class="col-lg-3"> Customer</label>
            <input type="text" class="col-lg-7 form-control form-control-plaintext  " disabled id="inv_cus" name="inv_cus" value="<?php echo($cus) ?>">
        </div>
    </div>
</div>

<div class="m-2 border-dark">

<!-- Content Row -->
<div >
    <table id="tblviewinvdata" class="table table-striped "  >
        <thead >
        <tr>
            <th>Product ID</th>
            <th>Prod Modal </th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>prod_sprice</th>           

        </tr>
        </thead>
        <tbody >
            
        </tbody>

    </table>

</div>

</div>

<script>
    $(document).ready(function(){
        var inv_id =$("#invid").val();
        var dataTable = $("#tblviewinvdata").DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "lib/mod_inv.php?type=viewInvDetails&inv_id="+inv_id,
                "type": "POST"
            },
            "columns": [
                {"data": "0"},
                {"data": "1"},
                {"data": "2"},
                {"data": "3"},
                {"data": "4"}
            ],
            "columnDefs":[
                {
                    "className":'dt-body-right',
                    "targets":4
                }
            ]
        });



    })
</script>