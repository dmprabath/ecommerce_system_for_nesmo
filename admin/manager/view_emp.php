<?php
session_start();
$emp_id = $_SESSION["user"]["uid"];

    require ("../lib/mod_emp.php");
    $newid = getEmpId();
?>
<style type="text/css">
    .modal-size{
        width: 700px;
    }
    
</style>
<script>
	$(document).ready(function(){


    var dataTable = $("#tblviewemp").DataTable({
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',
      "ajax":{
        "url":"lib/mod_emp.php?type=viewEmployee",
        "type":"POST"
      },
        "columns":[
        {"data":"0"},
        {"data":"1"},
        {"data":"2"},
        {"data":"3"},
        {"data":"4"},
        {"data":"5"},
        {"data":"6"}
      ],
      "order" :[[1,"asc"]],
        "columnDefs":[

            {
                "data":"0",
                "render": function(data,type,row){
                    return '<a data-fancybox="gallery" href="../resources/img/profile/'+data+'" ><img width="50px" src="../resources/img/profile/'+data+'" /></a>';
                },
                "targets":0
            },
            {
                "data":"5",
                "render": function(data,type,row){
                    return(data=="1")?"<p class='text-success'>Active</p>":"<p class='text-danger' >Inctive</p>";
                },
                "targets":5
            },
            {
                "data":null,
                "defaultContent":"<button id='view' title='view' class='btn btn-sm btn-primary' >View</button> ",
                "targets":6
            }
        ],
             
            "buttons":[
                'copy',
                'csv',
                'excel',
                'pdf',
                'print'
            ]
            

    });
        var email ="";
    $("#tblviewemp tbody").on('click','button',function() {
        var type = $(this).attr('title');
        var data = dataTable.row($(this).parents('tr')).data();
         var eid = data[1];
         var name = data[2];
          var email = data[3];
         var urole = data[4];



         if(type=="view"){
             var url = "view/view_profile_emp.php?empid="+eid ;
             $("#rpanel").load(url);

         }

    });
    
  });

</script>

    <div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary"> User Management</a> </li>


    </div>

<div class="d-sm-flex justify-content-between  mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">View User</h1>
    </div>
    
    
    
    
    
</div>

<!-- Content Row -->
<div >
		<table id="tblviewemp" class="table table-striped animated fadeInUp fast " >
  			<thead>
    		<tr>
      			<th></th>
                <th>ID</th>
      			<th>Name</th>
      			<th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
    		</tr>
  			</thead>


		</table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

