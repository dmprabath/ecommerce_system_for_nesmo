<?php
session_start();
require ("../lib/mod_backup.php");
$emp_id = $_SESSION["user"]["uid"];
/*require ("../lib/common.php");*/

?>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary" > Backup Management</a> </li>
</div>


<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">        
    <h1 class="h3 mb-0 text-gray-800">View Backup</h1>
    <button class="btn btn-success" id="btnNewBackup" ><i class="fas fa-database"><b>+</b></i> Create Backup </button>
    
    </div>
</div>
<div>
    </div>
</div>

<!-- Content Row -->
<div  class="view_backup">
    <table id="tblviewbackup" class="display nowrap table table-striped animated fadeInUp fast "  >
        <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Backup Date</th>
            <th>Backup Time</th>
            <th>File Name</th>
            <th>Backup BY</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="backupBody" class="">

        </tbody>

    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>






<script>

    $(document).ready(function() {

       dataTable = $('#tblviewbackup').DataTable( {
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url": "lib/mod_backup.php?type=viewBackup",
                    "type": "POST"
                },
                "columns": [
                    {"data": "0"},
                    {"data": "1"},
                    {"data": "2"},
                    {"data": "3"},
                    {"data": "4"},
                    {"data": "5"},
                ],
                "columnDefs":[
                    {
                        "data": null,
                        "render":function(data,type,row){
                            return "<a href='backup/"+row[3]+"' class='btn btn-primary' download> <i class='fas fa-cloud-download-alt'></i>Downloads</a>"
                        },
                 
                        "targets":5
                    }
                ],
                             

            });
       $("#btnNewBackup").click(function(){
            var userid = $("#id").val();
            var url = "lib/mod_backup.php?type=createBackup";
            $.ajax({
                method: "POST",
                url: url,
                data: {userid:userid}, 
                dataType: "text",
                success: function (result) {
                    
                    res = result.split(",");
                    msg = res[0].trim();
                    if (msg  == "0") {
                        swal("Error", res[1], "error");
                    }
                    else if (msg  == "1") {
                        swal("Success", res[1], "success");
                        setTimeout(function() {
                           funViewBackup();
                        }, 600);
                       
                    }
                }
            });
       });

     
    });
 </script> 