<?php
session_start(); 
    require ("../lib/mod_product.php");
    /*$newid = getProId();*/
?>
<style type="text/css">
    .modal-size{
        width: 700px;
    }
</style>


    <div class="breadcrumb  bg-gray-200 text-uppercase">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary" > Product Management</a> </li>


    </div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">    
    
    <h1 class="h3 mb-0 text-gray-800">View Products</h1>
    <div class="dropdown show">
      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-adduser fa-sm text-white-50"></i>Add Product</a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#" onclick="funAddProduct_acc()">Accessories</a>
        <a class="dropdown-item" href="#" onclick="funAddProduct_com()">Commercial</a>
        <a class="dropdown-item" href="#" onclick="funAddProduct_dom()">Domestic</a>
       
        
      </div>
</div>

    

    
    
</div>

<!-- Content Row -->
<div >
		<table id="tblviewproduct" class="table table-striped "  >
  			<thead>
    		<tr>
            <th></th>
      			<th></th>
      			<th>Name</th>
      			<th>Modal No</th>
            <th>Quantity</th>
            <th>Category</th>
            <th></th>
            <th>Action</th>
            <th>Images</th>


    		</tr>
  			</thead>
            <tbody style="font-size: 13px">

            </tbody>

		</table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>






<!-- ############################ Add Product Images modal start ################### ------>

<div class="modal  fade" id="up_image" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="imageForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add More Images</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Product ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="prod_id" name="prod_id" readonly="readonly" value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Product Modal</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="prod_name" name="prod_name" readonly="readonly" value="">

                    </div>

                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Images</label>
                        <input type="file" class="col-lg-7 "  id="prod_img" name="prod_img[]" multiple="multiple">
                            
                    </div>
                    <input type="hidden"  id="cat_id" name="cat_id" readonly="readonly" value="">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="imag_upload" > UPLOAD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- -------------------------------# Add Product Images modal End --------------------- ---->


<!-- ------------------------------ View Product Images modal start ----------------------- ------>

<div class="modal  fade" id="view_image" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="imageForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>View Images</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">

                    <div id="image_box" class="row">
                        <!---------------------All Images display here----------------------->

                    </div>

                    <input type="hidden"  id="cat_id" name="cat_id" readonly="readonly" value="">
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- ------------------------------- View Product Images modal End ---------------------- ---->

<script>
$(document).ready(function(){
  $(this).scrollTop(0);
    var dataTable = $("#tblviewproduct").DataTable({
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',

      "ajax":{
        "url":"lib/mod_product.php?type=viewProduct",
        "type":"POST"
      },
        "columns":[
        {"data":"0"},
        {"data":"1"},
        {"data":"2"},
        {"data":"3"},
        {"data":"4"},
        {"data":"5"},
        {"data":"6"},
        {"data":"7"},
        {"data":"8"},



      ],
        "columnDefs":[
            {
                "targets": [ 1],
                "render": function (data, type, row) {

                    return '<a data-fancybox="gallery" href="../resources/img/products/' +data+'" ><img width="50px" src="../resources/img/products/' +data+ '" /></a>';

                }
            },
            {
                "targets": [6],
                "visible": false,
                "searchable": false
            },
            {
                "data":null,
                "defaultContent":"<button id='view' title='view'  class='btn-sm btn-primary' >View</button> <button title='update' id='update' class='btn-sm btn-secondary'>update</button> ",
                "targets":7
            },
            {
                "data":null,
                "defaultContent":"<button id='viewImg' title='View Image' class='btn-sm btn-primary' ><i class='far fa-images'></i> </button> <button title='Add Image' id='addImg' class='btn-sm btn-secondary'><i class='fas fa-upload'></i></button> ",
                "targets":8
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

  $("#tblviewproduct tbody").on('click','button',function() {
        var type = $(this).attr('id');
        var data = dataTable.row($(this).parents('tr')).data();
         var prodid = data[0];
        
         var name = data[3];
         var cat_id = data[6];

         if(type=="view"){
             var url = "view/view_profile_product.php?prodid="+prodid+"&name="+name;
             // alert(url);
             $("#rpanel").load(url);
         }else if(type =="update"){
          var url = "view/update_profile_product.php?prodid="+prodid+"&name="+name+"&update=1";
              $("#rpanel").load(url);
            
            

         }else if(type == "viewImg"){
             var url = "lib/mod_product.php?type=viewImages";
             $.ajax({
                 method:"POST",
                 url:url,
                 data:{prodid:prodid,catid:cat_id},
                 dataType:"text",
                 success:function(result){
                     $("#image_box").html(result);
                     $("#view_image").modal();

                 },
                 error:function(eobj,etxt,err){
                     console.log(etxt);
                 }
             });

         }else if(type == "addImg"){
             $("#prod_id").val(prodid);
             $("#prod_name").val(name);
             $("#cat_id").val(cat_id);
                $("#up_image").modal();
         }

   });
  // click image upload button
  $("#imag_upload").click(function () {
      var url ="lib/mod_product.php?type=addImages";
      var fdata = new FormData($('#imageForm')[0]); //form data
      $.ajax({
          type: 'POST',
          url: url,
          dataType: "text",
          data: fdata,
          cache: false,
          contentType: false,
          processData: false,
          success: function(result) {
              res = result.split(",");
              msg= res[0].trim();
              if (msg == "0") {
                  swal("Error", res[1], "error");
              }
              else if (msg == "1") {
                swal("Success",res[1], "success")
                  .then((value) => {
                          $("#up_image").modal('hide');
                  });
              }
          }
      });
  });

    $("#image_box").on('click','span',function () {
        var data = $(this).attr('id');
        var res = data.split(" ");
        var imagename = res[0];
        var prodid = res[1];


        swal({
            title: "Do you want to Remove this Image ?",
            icon: "warning",
            button: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                var url = "lib/mod_product.php?type=removeImages";
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {prodid:prodid,imagename:imagename},
                    dataType: "text",
                    success: function (result) {
                        res = result.split(",");
                        msg = res[0].trim();
                        if (msg == "0") {
                            swal("Error", res[1], "error");
                        }
                        else if (msg == "1") {
                            swal("Success",res[1], "success")
                            .then((value) => {
                                $("#view_image").modal('hide');
                                

                            });
                        }

                    }
                });
            }
        });
    })


});

</script>