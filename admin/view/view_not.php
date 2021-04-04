<?php
session_start();
if(isset($_SESSION['user']['uid'])){
    $log_id = $_SESSION['user']['uid'];
}else{
    echo ("please Login Again");
}

require ("../lib/mod_not.php");
?>

<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary"> Notifications Management</a> </li>

</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
    <div class="btn-group">
        <button class="btn btn-light border-dark shadow "  id="btn_inbox" >
            INBOX
        </button>
        <button class="btn btn-light border-dark shadow " id="btn_sentbox" >
            SENT BOX
        </button>

    </div>
    <a href="#" class="btn btn-light border-dark mb-0 shadow-sm " > <i class="fas fa-adduser fa-sm text-white-50"></i>Send Notification</a>


</div>

<div class="modal fade" id="readNot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" >

                    <p id="msg_from"></p>

                    <h5 id="msg_title"></h5>
                </div>
                <div class="d-block">

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                messages description
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"  id="modal_btn_ok"> OK</button>

            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div >
    <table id="tblviewnot" class="table table-striped " >
        <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>From</th>
            <th>Title</th>
            <th>Message</th>
            <th>Status</th>
            <th></th>

        </tr>
        </thead>

    </table>
    <div><input type="hidden" name="log_id" id="log_id" value="<?php echo($log_id) ?>" ></div>
</div>

<script>
    $(document).ready(function () {
        var usr_id = $("#log_id").val();

        var dataTable;
        var i = 0;
        $("#btn_inbox").click(function ssd() {
            $("#btn_inbox").addClass('active');
            $("#btn_sentbox").removeClass('active');
            if(++i > 1) dataTable.destroy();
             dataTable = $("#tblviewnot").DataTable({
                "processing": true,
                "serverSide": true,

                "ajax":{
                    "url":"lib/mod_not.php?type=viewINNotification&user="+usr_id,
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
                        "render": function (data,type,row) {
                            return (data == "1") ? "<button class='btn btn-success' id='btn-unread'>Unread</button>" : "<button class='btn btn-primary' id='btn-read'  >Read</button>";
                        },

                        "targets":5
                    },
                    {
                        "targets":6,
                        "visible":false,
                        "searchable": false
                    }


                ],
                'rowCallback': function(row, data, index){
                    if(data[5] == 1){
                        $(row).addClass('text-success');
                    }
                }
            });
            $("#tblviewnot tbody").on('click','button',function () {
                var type = $(this).attr('id');
                var data = dataTable.row($(this).parents('tr')).data();
                var not_date = data[0];
                var not_time = data[1];
                var not_from = data[2];
                var not_title = data[3];
                var not_msg = data[4];
                var not_id = data[6];
                $("#msg_title").html("Title : "+not_title);
                $("#msg_from").html("From : "+not_from +"<br/>"+not_date+" "+not_time);
                $("#msg_body").html("Notification : "+not_msg);
                if(type == "btn-read"){
                    $("#readNot").modal('show');

                }else if( type =="btn-unread"){
                    var url= "lib/mod_not.php?type=readMessage";
                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{notid:not_id},
                        dataType:"text",
                        success:function (result) {
                            res = result;
                            if(res=="1"){
                                $("#readNot").modal('show');

                            }

                        },
                        error:function (eobj,err,etxt) {
                            console.log(etxt);
                        }
                    })
                }
            });
        });




        $('#btn_sentbox').click(function () {
            $("#btn_sentbox").addClass('active');
            $("#btn_inbox").removeClass('active');
            if(++i > 1) dataTable.destroy();
            dataTable = $("#tblviewnot").DataTable({

                "processing": true,
                "serverSide": true,

                "ajax":{
                    "url":"lib/mod_not.php?type=viewOUTNotification&user="+usr_id,
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
                        "render": function (data,type,row) {
                            return (data == "1") ? "<button class='btn btn-success' id='btn-unread'>Unread</button>" : "<button class='btn btn-primary' id='btn-read'  >Read</button>";
                        },

                        "targets":5
                    },
                    {
                        "targets":6,
                        "visible":false,
                        "searchable": false
                    }


                ],
                'rowCallback': function(row, data, index){
                    if(data[5] == 1){
                        $(row).addClass('text-success');
                    }
                }
            });
            $("#tblviewnot tbody").on('click','button',function () {
                var type = $(this).attr('id');
                var data = dataTable.row($(this).parents('tr')).data();
                var not_date = data[0];
                var not_time = data[1];
                var not_from = data[2];
                var not_title = data[3];
                var not_msg = data[4];
                var not_id = data[6];
                $("#msg_title").html("Title : "+not_title);
                $("#msg_from").html("From : "+not_from +"<br/>"+not_date+" "+not_time);
                $("#msg_body").html("Notification : "+not_msg);
                if(type == "btn-read"){
                    $("#readNot").modal('show');

                }else if( type =="btn-unread"){
                    var url= "lib/mod_not.php?type=readMessage";
                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{notid:not_id},
                        dataType:"text",
                        success:function (result) {
                            res = result;
                            if(res=="1"){
                                $("#readNot").modal('show');

                            }

                        },
                        error:function (eobj,err,etxt) {
                            console.log(etxt);
                        }
                    })
                }
            });
        });
        $('#readNot').on('hidden.bs.modal', function () {
            funViewNot();
        });





    })
</script>