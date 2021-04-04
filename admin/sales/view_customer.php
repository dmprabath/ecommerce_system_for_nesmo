 <?php
require("../lib/mod_cus.php");
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];


}
?>

<script>
    $(document).ready(function(){
      $(this).scrollTop(0);
        var dataTable = $("#tblviewcus").DataTable({
            "processing": true,
            "serverSide": true,
            "dom": 'Bfrtip',
            "ajax":{
                "url":"lib/mod_cus.php?type=viewCustomer",
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
            "columnDefs":[
                {
                    "data":"5",
                    "render": function(data,type,row){                      
                        return(row[5]=="1")?"<p class='text-success'>Active User</p>":"<p class='text-danger'>Inctive User</p>";
                    },
                    "targets":5
                },
                {
                    "data":null,
                    "defaultContent":"<button id='view' title='view' class='btn-sm btn btn-primary' ><i class='fas fa-user-edit'></i>View</button>  ",
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


        $("#tblviewcus tbody").on('click','button',function() {
            var type = $(this).attr('title');
            var data = dataTable.row($(this).parents('tr')).data();
            var cusid = data[0];
            var cusName = data[1];
            var cusEmail = data[2];



          if(type=="view") {
              var url = "view/view_profile_cus.php?cusid=" + cusid;
              $("#rpanel").load(url);
            }
        });
    });

</script>
 <div class="breadcrumb  bg-gray-200 ">
     <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
     <li><a  class="text-primary"> Customer Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
 </div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h3 mb-0 text-gray-800">Customers</h1>
  </div>
    <div class="dropdown ml-2">
        
    </div>
    
    

</div>
 <table id="tblviewcus" class="table table-striped animated fadeInUp fast" >
     <thead>
     <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>Contact No</th>
         <th>Join Date</th>
         <th>Status</th>
         <th></th>
     </tr>
     </thead>

 </table>

<script type="text/javascript">
    
</script>