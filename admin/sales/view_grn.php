<?php
session_start();
require ("../lib/mod_grn.php");

?>

<script>
$(document).ready(function(){
    var dataTable = $("#tblviewgrn").DataTable({
        "processing": true,
        "serverSide" : true,
        "ajax":{
            "url":"lib/mod_grn.php?type=viewGrn",
            "type":"POST",
        },
        "columns":[
            {"data":"0"},
            {"data":"1"},
            {"data":"2"},
            {"data":"3"},
            {"data":"4"},
            {"data":"5"}

        ],
        "columnDefs":[
            {
                "data":null,
                "defaultContent":"<button class='btn btn-primary btn-sm  ' id='btn_grn_detail' >Details</button> <button class='btn btn-success btn-sm' id='btn_grn_update'>Change</button>" +
                " <button class='btn btn-primary btn-sm' id='btn_grn_print'><i class='fas fa-print'></i>Print</button>",
                "targets":5
            }

        ]
    });

    $("#tblviewgrn tbody").on('click','button',function () {
       var type = $(this).attr('id');
       var data = dataTable.row($(this).parents('tr')).data();
       var grn_id = data[0];
       var sup = data[1];
       var date = data[2];

       if(type == "btn_grn_detail"){
           url ="view/view_grn_details.php?grn_id="+grn_id+"&date="+date+"&sup="+sup;
           $("#rpanel").load(url);
       }else if(type == "btn_grn_print"){

            window.open('view/report/print_grn.php?grnid='+grn_id,'_blank');
       }
    });
})




</script>

<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary" > GRN Management</a> </li>


</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">


    <h1 class="h3 mb-0 text-gray-800">View grns</h1>
    <a href="#" class="btn btn-primary mb-0 shadow-sm " onclick="funAddGrn();"> <i class="fas fa-adduser fa-sm text-white-50"></i>Add grn</a>



</div>

<!-- Content Row -->
<div >
    <table id="tblviewgrn" class="table table-striped animated fadeInUp fast"  >
        <thead>
        <tr >
            <th>Id</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Discount</th>
            <th>Total</th>
            <th ></th>

        </tr>
        </thead>
        <tbody style="">

        </tbody>

    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

<!-- ############################ Add new employee Form ################### ------>

