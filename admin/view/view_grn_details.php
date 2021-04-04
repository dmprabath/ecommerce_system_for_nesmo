<?php
if(isset($_GET['grn_id'])){
    $grn_id =$_GET['grn_id'];
   
}
?>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a href="#" class="text-dark" onclick="funViewGrn()"> GRN Management </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary"> View Received  Details</a> </li>


</div>
<div class="container">

</div>
<div class="row">
    <div class="col-2">
        <div class="form-group row">
            <label for="" class="col-lg-5 form-label">Grn No</label>
            <input type="text" class="col-lg-5 form-control form-control-plaintext readonly " readonly    id="grnid" name="grnid" value="<?php echo($grn_id) ?>" >
        </div>
    </div>
    <div class="col-7">
        <div class="form-group row">
            <label for="" class="col-lg-3"> Supplier</label>
            <input type="text" class="col-lg-7 form-control form-control-plaintext  " disabled id="grn_sup" name="grn_sup" value="">
        </div>
    </div>

    <div class="col-3">
        <div class="form-group row">
            <label for="" class="col-lg-4 form-label">Received Date</label>
            <input type="text" class="col-lg-7 form-control form-control-plaintext  " readonly id="rdate" name="rdate" value="">
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
            <th>Prod Modal </th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th>Quantity</th>
            <th >Remaining Quantity</th>
            <th>Received Date</th>
            <th>Batch Status</th>

        </tr>
        </thead>

    </table>

</div>

</div>

<script>
    $(document).ready(function(){
        var grn_id =$("#grnid").val();


        var url  ="lib/mod_grn.php?type=viewGrnDetail";

        $.ajax({
            method:"POST",
            url:url,
            data:{grn_id:grn_id},
            dataType:'json',
            success:function(result){
               
                $("#rdate").val(result.grn_rdate);
                $("#grn_sup").val(result.sup_name);
            },
            error:function(eobj,err,etxt){
                console.log(etxt);
            }
        });

        var dataTable = $("#tblviewbatch").DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "lib/mod_grn.php?type=viewDetails&grn_id="+grn_id,
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