<?php

$emp_id = $_SESSION["user"]["uid"];
?>
<div class="">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1></h1>
    <a href="#" onclick="funViewRep()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm text-uppercase"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
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
    <div class="mt-5">
        <table id="tblviewemp" class="table " >
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
</div>

<input type="hidden" name="id" id="id" value="<?php echo($emp_id) ?>" >

<div  class="text-light">
	<div class="row animated fadeInUp text-center">
    	<div class="col-5 col-lg-2 col-xl-2  m-4"   >
    		
    	</div>
    </div>

</div>
</div>
<script>
    
    $(document).ready(function () {
            var dataTable = $("#tblviewemp").DataTable({
      "processing": true,
      "serverSide": true,
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
                "defaultContent":"<button id='view' title='view' class='btn btn-sm btn-primary' >View</button>  " +
                "  <button title='status' class='btn btn-sm btn-danger'>Status</button>",
                "targets":6
            }
        ]
            

    });
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
         else if(type =="status") {
             var emp_id = $("#id").val();
             if( eid == emp_id){
                 swal("Oh! Sorry"," You can’t change Own status","info");
             }else {
                 swal({
                     title: "Do you want to change status ?",
                     text: "Change states of " + name,
                     icon: "warning",
                     button: true,
                     dangerMode: true
                 }).then((willDelete) => {
                     if (willDelete) {
                         var url = "lib/mod_emp.php?type=changeStatus";
                         $.ajax({
                             method: "POST",
                             url: url,
                             data: {eid: eid}, 
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
                                        location.reload();
                                     }, 300);
                                    
                                 }
                             }
                         });
                     }
                 });
             }


         }

    });

});


</script>