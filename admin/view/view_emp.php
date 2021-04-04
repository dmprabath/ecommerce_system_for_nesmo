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


    <div class="breadcrumb  bg-gray-200 text-uppercase">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary"> User Management</a> </li>


    </div>

<div class="d-sm-flex justify-content-between  mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">View User</h1>
    </div>
    
    
    
    <div class=" ">
        
         <a href="#" class="btn btn-primary mb-0 shadow-sm  " onclick="funAddEmp();"> <i class="fas fa-adduser fa-sm text-white-50"></i>Add Employee</a>
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


<div class="modal  fade" id="change_role" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="role_form">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Change User Role</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Employee ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="emp_id" name="emp_id" readonly="readonly" value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Role</label>

                        <select name="user_type" id="user_type" class="custom-select col-lg-5">
                            <?php getUserRole() ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="btn_role_updae" data-dismiss="modal"> Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>


<!-- --------------------- View and Change email------------------ ------>

<div class="modal  fade" id="change_email" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="email_form">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>change email</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Employee ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="emp_id" name="emp_id" readonly="readonly" value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Employee Name</label>
                        <input type="text" class="col-lg-7 form-control form-control-plaintext" id="emp_name" name="emp_name" readonly="readonly" value="">

                    </div>
                        
                        <input type="hidden" class="col-lg-7 form-control " id="old_email" name="old_email"  value="">

                    
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Email</label>
                        <input type="email" class="col-lg-7 form-control " id="emp_email" name="emp_email"  value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Confirm Email</label>
                        <input type="email" class="col-lg-7 form-control " id="con_email" name="con_email"  value="">

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success"   id="btn_email_update" > Update</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>

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
                "defaultContent":"<button id='view' title='view' class='btn btn-sm btn-primary' >View</button> <button id='email' title='email' class='btn btn-sm btn-primary' >Email</button> " +
                " <button title='changeRole' class='btn btn-sm btn-success'>Role</button> <button title='reset' class='btn btn-sm btn-warning'>PW Reset</button> <button title='status' class='btn btn-sm btn-danger'>Status</button>",
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

         }else if(type == "email"){

            $("#change_email #emp_id").val(eid);
            $("#change_email #emp_name").val(name);
            $("#change_email #emp_email").val(email);
            $("#change_email #old_email").val(email);
            $('#change_email').modal('show');
            
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
                                    funViewEmp();
                                 }
                             }
                         });
                     }
                 });
             }


         }else if(type == "reset"){
             var emp_id = $("#id").val();
             if( eid == emp_id){
                 swal("Oh! Sorry"," You can't reset own password","info");
             }else{

             swal({
                 title:"Do you want to Reset password?",
                 text:"You are trying to update:"+name,
                 icon:"warning",
                 buttons:true,
                 dangerMode:true
             }).then((willDelete)=> {
                 if (willDelete) {

                     var url = "lib/mod_emp.php?type=resetPassword";
                     $.ajax({

                         method: "POST",
                         url: url,
                         data: {eid: eid, email: email,name:name},
                         dataType: "text", 
                         success: function (result) {                          

                             res = result.split(",");
                             msg = res[0].trim();
                             if (msg == "0") {
                                 swal("Error", res[1], "error");

                             } else if (msg == "1") {
                                 swal("Success", res[1], "success");
                                 $("#view_emp").click();
                             }
                         },
                         error: function (eobj, etxt, err) {
                             console.log(etxt);
                         }
                     });
                 }
             });

             }
         }else if(type == "changeRole"){

             var emp_id = $("#id").val();
             if( eid == emp_id){
                 swal("Oh! Sorry","You can’t change Own role","info");
             }else{
                 swal({
                     title:"Do you want to change user role?",
                     text:"You are trying to change:"+name,
                     icon:"warning",
                     buttons:true,
                     dangerMode:true
                 }).then((willDelete)=> {
                     if (willDelete) {
                         $(".modal-body #emp_id").val(eid);
                         $(".modal-body #user_type").val(urole);
                         $('#change_role').modal('show');
                     }
                 });

             }
         }

    });

    $("#btn_role_updae").click(function () {
        var emp_id = $("#emp_id").val();
        var user_type = $("#user_type").val();

        if(user_type==""){
            swal("Error","Please Select User Role","error");
            return;
        }

        var url_role ="lib/mod_emp.php?type=changeRole";
        $.ajax({
            method:"POST",
            url:url_role,
            data:{email:email, user_role:user_type},
            dataType:"text",
            success:function (result) {
                res = result.split(",");
                if (res[0] == "0") {
                    swal("Error", res[1], "error");

                } else if (res[0] == "1") {
                    swal("Success", res[1], "success");

                    $("#view_emp").click();
                }
            },
            error:function (eobj, err, etxt) {
                console.log(etxt);
            }

        });
    });

    /*------------- Email change Button  ---------------  */
    $("#btn_email_update").click(function () {
        var emp_id = $("#emp_id").val();
        var emp_name = $("#emp_name").val();
        var emp_email = $("#emp_email").val();
        var con_email = $("#con_email").val();

        var email_pattern =  /[^@]{1,64}@[^@]{4,253}$/;
        if(emp_email == "" || !emp_email.match(email_pattern)){
            swal("Error","Email is not valid","error");
            return;
        }
        if (emp_email != con_email) {
            swal("Error","Email and confirm email Must be same","error");
            return;
        }
        $("#change_email").modal("hide");
        var data = $("#email_form").serialize();

        var url_email ="lib/mod_emp.php?type=changeEmail";
        $.ajax({
            method:"POST",
            url:url_email,
            data:data,
            dataType:"text",
            success:function (result) {
               
                res = result.split(",");
                msg =res[0].trim();
                if (msg == "0") {
                    swal("Error", res[1], "error");

                } else if (msg == "1") {
                    swal("Error", res[1], "success");
                    setTimeout(function() {
                        funViewEmp();
                    }, 2000);
                }
            },
            error:function (eobj, err, etxt) {
                console.log(etxt);
            }

        });
    });
  });

</script>