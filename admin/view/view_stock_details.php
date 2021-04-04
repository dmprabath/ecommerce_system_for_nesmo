<?php
if(isset($_GET['prodid'])){
    $prod_id =$_GET['prodid'];
    $modal = $_GET['prodmodal'];
    $qty = $_GET['qty'];
}
?>

<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" class="text-dark" onclick="funViewStock()"> GRN Management </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary"> View Batch  Details</a> </li>


</div>
<div class="container">

</div>
<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col-lg-5 form-label">Product ID</label>
            <input type="text" class="col-lg-6 form-control form-control-plaintext readonly " readonly="readonly"    id="prodid" name="prodid" value="<?php echo($prod_id) ?>" >
        </div>
    </div>

    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col form-label">Product Modal</label>
            <input type="text" class="col form-control form-control-plaintext  " readonly="readonly" id="prod_modal" name="prod_modal" value="<?php echo($modal) ?>">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="" class="col form-label">Total Quantity</label>
            <input type="text" class="col form-control form-control-plaintext  " readonly="readonly" id="prod_modal" name="prod_modal" value="<?php echo($qty) ?>">
        </div>
    </div>
</div>

<div class="m-2 border-dark">

    <!-- Content Row -->
    <div >
        <table id="tblviewbatch" class="table table-striped "  >
            <thead>
            <tr>
                <th>Batch ID</th>
                <th>Supplier Name</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Remaining Quantity</th>
                <th>Received Date</th>
                <th>Batch Status</th>

            </tr>
            </thead>

        </table>

    </div>

</div>

<script>
    $(document).ready(function(){
        $(this).scrollTop(0);
        var prod_id =$("#prodid").val();
        var dataTable = $("#tblviewbatch").DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "lib/mod_stock.php?type=viewBatch&prod_id="+prod_id,
                "type": "POST"
            },
            "columns": [
                {"data": "0"},
                {"data": "1"},
                {"data": "2"},
                {"data": "3"},
                {"data": "4"},
                {"data": "5"},
                {"data": "6"},
                {"data": "7"}
            ],
            "columnDefs":[
                {
                    "data":"7",
                    "render": function(data,type,row){
                        return(data=="1")?"<button title='status' class='btn btn-success'>Active</button>":"<button title='status'  class='btn btn-danger'>Inctive</button>";
                    },
                    "targets":7
                }
            ]
        });



    })
</script>
