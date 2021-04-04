<?php
/*require ("lib/common.php");*/
?>

<div>
    <h3>Orders</h3>
</div>
<div >
    <table id="tblviewinv" class="table table-striped animated fadeInUp fast"  >
        <thead> 
        <tr >
            <th>Date</th>
            <th>Id</th>
            <th>Customer name</th>
            <th>Contact Number</th>
            <th>Total Quantity</th>             
            <th>type</th>
            <th ></th>
            <th ></th>

        </tr>
        </thead>
        <tbody style="">

        </tbody>
 
    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

<script>
    
    $(document).ready(function () {
       var dataTable = $("#tblviewinv").DataTable({
        "processing": true,
        "serverSide" : true,
        "ajax":{
            "url":"lib/mod_inv.php?type=viewConfirmdInvoice",
            "type":"POST",
        },
        "columns":[
            {"data":"0"},
            {"data":"1"},
            {"data":"2"},
            {"data":"3"},
            {"data":"4"},
            {"data":"5"},
            {"data":"6"},
            {"data":"7"}

        ],
        "columnDefs":[
            {
                "data":6,
                "render":function(data,type,row){
                    if(data==="1"){
                        return "<button class='btn btn-danger btn-sm' title='Not confirm' >Not Confirm</button>"
                    }else if (data ==="2"){
                        return  "<button class='btn btn-success btn-sm' title='ready' >Complete </button>"
                    }else if(data ==="0"){
                        return  "<p class='text-danger'>Cancled</p>"
                    }else{
                        return  "<p class='bg-info text-center text-light'>Finished</p>"
                    }
                },
                "targets":6
            },
            {
                "data":null,
                "defaultContent":"<button class='btn btn-primary btn-sm  ' title='inv_detail' >Details</button>",
                "targets":7
            }

        ]
    });

     $("#tblviewinv tbody").on("click","button",function(){
         var button = $(this).attr("title");
         var data = dataTable.row($(this).parents('tr')).data();
        var date = data[0];
        var invid = data[1];
        var cus = data[2];

        if(button=="ready"){
             swal({
                      title: "Are you sure ?",
                      text: "You are trying to Finished invoice of " + invid,
                      icon: "warning",
                      button: true,
                      dangerMode: true
                  }).then((willDelete) => {
                      if (willDelete) {
                          var url = "lib/mod_inv.php?type=orderDeliverd";
                          $.ajax({
                              method: "POST",
                              url: url,
                              data: {invid:invid}, 
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
                                      }, 600);
                                     
                                  }
                              }
                          });
                   }
              });
        }else if(button == "inv_detail"){
            url ="view/view_inv_details.php?inv_id="+invid+"&cus="+cus+"&date="+date;
            $("#rpanel").load(url);
        }
     });     


});


</script>