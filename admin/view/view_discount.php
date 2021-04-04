

<div class="breadcrumb  bg-gray-200 text-uppercase ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary" > Discount Management</a> </li>


</div>

<div >
		<table id="tblProdDiscount" class="table table-striped "  >
  			<thead>
    		<tr>
            <th></th>
      			<th>ID</th>
      			<th>Name</th>
      			<th>Modal Name</th>
      			<th>Default Price</th>
            <th>Discount</th>
            <th></th>
            <th></th>


    		</tr>
  			</thead>
            <tbody style="font-size: 15px">

            </tbody>

		</table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

<div class="modal  fade" id="changePrice" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="priceForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Price</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3">
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Product ID</label>:
                        <div class=" col-5">
                            <input type="text" readonly  class="form-control-plaintext bg-transparent form-control-sm" name="prod_id" id="prod_id">
                        </div>
                      </div>
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Product Modal</label>:
                        <div class=" col-5">
                            <input type="text" readonly  class="form-control-plaintext bg-transparent form-control-sm" name="prod_model" id="prod_model">
                        </div>
                    </div> 
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text" disabled class="form-control-plaintext bg-transparent form-control-sm" name="prod_price" id="prod_price">
                        </div>
                    </div> 
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">New price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text"  class=" form-control  form-control-sm" name="prod_nprice" id="prod_nprice" value="0.00">
                        </div>
                    </div>  
                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-success"  id="btn_confirm"> Confirm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal  fade" id="changeDiscount" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="discForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Price</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3">
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Product ID</label>:
                        <div class=" col-5">
                            <input type="text" readonly  class="form-control-plaintext bg-transparent form-control-sm" name="prod_oid" id="prod_oid">
                        </div>
                      </div>
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text" disabled class="form-control-plaintext text-right bg-transparent form-control-sm" name="prod_oprice" id="prod_oprice">
                        </div>
                    </div> 
                    <div class=" form-group row ">
                        <label class="col-form-label-sm col-4">Discount price (Rs.)</label>:
                        <div class=" col-5">
                            <input type="text"  class=" form-control text-right  form-control-sm" name="prod_dprice" id="prod_dprice" value="0.00">
                        </div>
                    </div>  
                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-success"  id="btn_dconfirm"> Confirm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){

    var dataTable = $("#tblProdDiscount").DataTable({
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',

      "ajax":{
        "url":"lib/mod_product.php?type=viewProdDiscount",
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
        {"data":"7"}

      ],
      "columnDefs":[
            {
                "targets": [ 0],
                "render": function (data, type, row) {

                    return '<a data-fancybox="gallery" href="../resources/img/products/' +data+'" ><img width="50px" src="../resources/img/products/' +data+ '" /></a>';

                }
            },
            {
                "targets": [6], //
                "visible": false,
                "searchable": false
            },
            {
                "data":null,
                "defaultContent":"<button id='price' title='change Price' class='btn-sm btn-primary' >Price </button> <button title='change discount' id='discount' class='btn-sm btn-secondary'>Discount</button> ",
                "targets":7
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


    $("#tblProdDiscount tbody").on("click","button",function(){
      var type = $(this).attr("id");
      var row = dataTable.row($(this).parents('tr')).data();
      var prodid = row[1];
      var prodmodel = row[3];
      var prodprice = row[4];
      var proddiscount = row[5];
      if(type=="price"){
        $("#prod_id").val(prodid);
        $("#prod_model").val(prodmodel);
        $("#prod_price").val(prodprice);
        $("#changePrice").modal();
      }else if(type=="discount"){
        $("#prod_oid").val(prodid);
        $("#prod_oprice").val(prodprice);
        $("#prod_dprice").val(proddiscount);
        $("#changeDiscount").modal();
      }
      
    });

    $("#btn_confirm").click(function(){ // add new price form
        var newprice = $("#prod_nprice").val();
        var pricePattern = /^[0-9\.]*$/;
        if(newprice=="" || !newprice.match(pricePattern)){
            swal("Error","New Price is Invalid","error");
            return;
        }

        $("#changePrice").modal("hide");

        var data = $("#priceForm").serialize();
        var url = "lib/mod_product.php?type=changePrice";

        $.ajax({
            method :"POST",
            url:url,
            data:data,
            dataType:"text",
            success:function(result){
              res = result.split(",");
              msg = res[0].trim();
                if (msg == "0") {
                  swal("Error", res[1], "error");
                }
                else if (msg == "1") {
                  swal("Success",res[1], "success");
                   setTimeout(function() {
                        funViewDisc();
                    }, 2000);
                    
                    
                }
            },
            error:function(err,eobj,etxt){
              console.log(etxt);
            }
        });
    });

    $("#btn_dconfirm").click(function(){
        var discount = $("#prod_dprice").val();
        var pricePattern = /^[0-9\.]*$/;
        if(discount=="" || !discount.match(pricePattern)){
            swal("Error","Discounnt Price is Invalid","error");
            return;
        }

        $("#changeDiscount").modal("hide");
        var data = $("#discForm").serialize();
        var url = "lib/mod_product.php?type=changeDiscount";

        $.ajax({
            method :"POST",
            url:url,
            data:data,
            dataType:"text",
            success:function(result){
              
              res = result.split(",");
              msg = res[0].trim();
                if (msg == "0") {
                  swal("Error", res[1], "error");
                }
                else if (msg == "1") {
                  swal("Success",res[1], "success");
                   setTimeout(function() {
                        funViewDisc();
                    }, 2000);
                    
                    
                }
            },
            error:function(err,eobj,etxt){
              console.log(etxt);
            }
        });
    });

  });
    </script>