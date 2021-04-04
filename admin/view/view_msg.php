<?php
session_start();
if(isset($_SESSION['user']['uid'])){
    $log_id = $_SESSION['user']['uid'];
}else{
    echo ("please Login Again");
}

require ("../lib/mod_msg.php");
require ("../lib/common.php");
?>

<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary"> Messages Management</a> </li>

</div>


<!--  --------------View messages------------- -->
<div class="modal fade" id="view_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">          
             <div id="view_details">
                 
             </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" id="modal_btn_ok"> OK</button>
            </div>
      
        </div>
    </div>
</div>

<!--  --------------Send reply------------- -->

<div class="modal fade" id="sendReply" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formSendreply"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Send Reply</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                <input type="hidden" name="id" id="id" value="" >
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">name</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_name" id="send_name"> 
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">To</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_mail" id="send_mail"> 
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Title</label>:
                    <input type="text" class="ml-1 col-lg-6 form-control" readonly name="send_title" id="send_title">
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Reply</label>:
                    <textarea class="ml-1 col-lg-7 form-control " rows="6" id="send_msg" name="send_msg">
                            
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <img src="../resources/img/page-loading.gif" class="d-none" id="load_imag" width='100px'>
                <button type="button" class="btn btn-success"  id="modal_reply_send"> Send</button>

            </div>
            </form>
        </div>
    </div>
</div>

<div class="mx-auto mb-5">    
  
</div>
<!-- Content Row -->
<div >
    <table id="tblviewmsg" class="table table-striped animated fadeInUp fast" >
        <thead>
            <th>Date</th>
            <th>Name</th>
            <th>Title</th>
            <th>Email</th>
            <th>Reply</th>
            <th></th>
            <th></th>
        </thead>
        

    </table>
    <div></div>
</div>

<script>
    $(document).ready(function () {
     
        
    dataTable = $("#tblviewmsg").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                "url":"lib/mod_msg.php?type=allMessage",
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
                "order": [[0,"desc"]],
                "columnDefs":[
                    {
                        "data":"4",
                        "render": function(data,type,row){
                            return(data=="0")?"<button class='btn btn-success btn-sm' title='reply now'>Reply Now</button>":"<button class='btn btn-primary btn-sm' title='view reply'>View Reply</button>";
                        },
                        "targets":4
                    },
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "data":null,
                        "defaultContent":"<button class='btn btn-primary btn-sm mx-none' title='view message'>View Message</button>",
                        "targets":6
                    }
                ]
                
    });

     $("#tblviewmsg tbody").on('click','button',function () {
        var type = $(this).attr('title');
        var data = dataTable.row($(this).parents('tr')).data();    
        var msg_id = data[5];
        var name = data[1];
        var title = data[2];
        var email = data[3];

            if(type == "view message"){
                var url= "lib/mod_msg.php?type=viewMessage";
                $.ajax({
                    method:"POST",
                    url:url,
                    data:{msgid:msg_id},
                    dataType:"text",
                    success:function (result) {
                       $("#view_details").html(result);
                        $("#view_message").modal('show');
                    },
                    error:function (eobj,err,etxt) {
                        console.log(etxt);
                    }
                });
                
            }else if( type =="view reply"){
                
                var url= "lib/mod_msg.php?type=viewReply";
                $.ajax({
                    method:"POST",
                    url:url,
                    data:{msgid:msg_id},
                    dataType:"text",
                    success:function (result) {
                       $("#view_details").html(result);
                        $("#view_message").modal('show');
                    },
                    error:function (eobj,err,etxt) {
                        console.log(etxt);
                    }
                });
            }else if( type =="reply now"){
                    title = "Reply For :"+title;
                $("#id").val(msg_id);
                $("#send_name").val(name);
                $("#send_mail").val(email);
                $("#send_title").val(title);
                $("#sendReply").modal('show');                  
            
            }
        });
     
     $("#modal_reply_send").click(function(){
         if($("#send_msg").val() ==""){
             swal("Error","Reply Field is empty","error");
             return;
         }
         $("#load_imag").removeClass('d-none');
         
         var data = $("#formSendreply").serialize();
         var url= "lib/mod_msg.php?type=sendReply";
         $.ajax({
             method:"POST",
             url:url,
             data:data,
             dataType:"text",
             success:function (result) {
                $("#sendReply").modal('hide');
                res = result.split(",");
                    msg = res[0].trim();
                    if(msg =="0"){
                        swal("error",res[1],"error")
                    }else{

                        $("#load_imag").addClass('d-none');
                        swal("success",res[1],"success");
                        setTimeout(function() {
                            funViewMsg();
                        }, 1000);
                        
                    }
                
               
             },
             error:function (eobj,err,etxt) {
                 console.log(etxt);
             }
         });       

     });               
 });




</script>