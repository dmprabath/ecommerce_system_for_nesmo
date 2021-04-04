<?php
session_start();
//add main Navigation
if(isset($_SESSION["customer"]["uname"])) {
     header("Location:index.php");       
}
 require_once("include/main_nav.php") ;
   
?>


<div class="row justify-content-center  ">
	<!------------------ Email Check Form start ----------------------->
	<div class="col-lg-4 mt-5 border border-primary">
		<div class="m-3">

		<h5 class="h4 text-center">Password Reset Form</h5>
		<form class="form mt-3" id="form_email">

            <div class=" form-group col-11 col-lg-11 col-sm-11 ">
            	<label class="form-input-label"	>Enter Your Email</label>
                <input class="form-control" type="email" id="txtemail" name="txtemail" placeholder="Email">
            </div>           
            
             <div class="row ml-1">
             	<div  class="col-1 col-lg-3 col-sm-11">
             		 <button type="button" class="btn btn-success btn " id="btnemail" >Submit</button>
             	</div>
             		
             	
             	<div class="col-1 col-lg-5 col-sm-11 d-none" id="load_image">
             		<img src="resources/img/page-loading.gif" class="w-100">
             	</div>
            	
           		         
             </div>

            
         </form>

	<!------------------ Confirmation Code Form start ----------------------->

		<form class="form mt-3 d-none" id="form_code">			
			<div class="alert alert-success">

					<span>We have send confirmation code to your email :</span>
					<span id="cus_email"> </span>
			</div>
			
			<input type="hidden" name="code_email" id="code_email">
            <div class=" form-group col-11 col-lg-8 col-sm-11 ">
            	<label class="form-input-label"	>Enter Confirmation Password</label>
                <input class="form-control" type="text" id="txtcode" name="txtcode" placeholder="6 Digit Code" maxlength="6">
            </div>
                    
            
             <div class="col-11 col-lg-11 col-sm-11">
                 <button type="button" class="btn btn-success btn mr-2" id="btncode" >Submit</button>              
             </div>
         </form>

     <!------------------ Passwrod Reset Form start ----------------------->


		<form class="form mt-3 d-none" id="form_pass">
			<div class="alert alert-info" id="password_error">
				<span class=" "  >Password must be more than 8 digits and without use symbols  </span>
			</div>
			
			<input type="hidden" name="pass_email" id="pass_email">
			<div class=" form-group col-11 col-lg-8 col-sm-11 ">
				<label class="form-input-label"	>Enter New Password</label>
                <input class="form-control" type="password" id="txtpass" name="txtpass">

            </div>
            <div class=" form-group col-11 col-lg-8 col-sm-11 ">
            	<label class="form-input-label"	>Confirm Password</label>
                <input class="form-control" type="password" id="txtcpass" name="txtcpass">
            </div> 
                    
            
             <div class="col-11 col-lg-11 col-sm-11">
                 <button type="button" class="btn btn-success btn mr-2" id="btnpass" >Submit</button>              
             </div>
         </form>
         </div>
		
	</div>
	 
</div>



<?php require_once ("include/footer.php")  ?>
<script type="text/javascript">
	$(document).ready(function(){

		$("#txtemail").keypress(function(e){  // function of key press
			if(e.which == 13){
				$("#btnemail").click();
			}
			
		});
			/*---------------- Email Check Form start -----------------------*/

		$("#btnemail").click(function(){
			var email = $("#txtemail").val();
			var emailPattern=/^[^@]{1,64}@[^@]{4,253}$/;
			$("#btnemail").attr('disabled',true);
			$("#load_image").removeClass('d-none');

		     if(!email.match(emailPattern)){
		     	swal("Sorry","Your Email is not Valied Check again ","warning");
		     	$("#btnemail").attr('disabled',false);
				$("#load_image").addClass('d-none');
		     }else{
		     	var data = $('#form_email').serialize();
	            var url  = "lib/mod_cus.php?type=checkEmail";

	            $.ajax({
	                method:"POST",
	                url:url,
	                data:data,
	                dataType:"text",
	                success:function (result) {
	                              	
	                	res = result.split(",");
	                  if(res[0]=='0'){
	                  	swal("Sorry",res[1],"error");
	                  	$("#btnemail").attr('disabled',false);
						$("#load_image").addClass('d-none');
	                  }else{
	                  	$("#cus_email").html($("#txtemail").val());
	                  	$("#code_email").val($("#txtemail").val());
	                  	$("#form_email").addClass('d-none');
	                  	$("#form_code").removeClass('d-none');
	                  }
	                    
	                },error:function(err,eobj,etxt){
	                	console.log(etxt);
	                }

	            });
		     }
			

		});

		/*---------------- Code Check Form start -----------------------*/

		$("#btncode").click(function(){
			var data = $('#form_code').serialize();
            var url  = "lib/mod_cus.php?type=checkcode";

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function (result) {
                	result = result.trim();
                	
                  if(result=='0'){
                  	swal("Error","Confirmation code is incorrect please check again your email inbox","error");
                  }else{
                  	
                  	$("#pass_email").val($("#code_email").val());
                  	$("#form_code").addClass('d-none');
                  	$("#form_pass").removeClass('d-none');
                  }
                    
                },error:function(err,eobj,etxt){
                	console.log(etxt);
                }

            });

		});
/*---------------- Password Rest Form start -----------------------*/

		var $passwordPattern=/^([a-zA-Z1-9]{8,})$/;
	      $('#txtpass').on('keypress keydown keyup',function(){
	          if (!$(this).val().match($passwordPattern)) {
	              // there is a mismatch, hence show the error message
	              $('#password_error').removeClass('alert-info').addClass('alert-danger');
	              $("#btnpass").prop("disabled",true);
	             
	          }
	          else{
	              // else, do not display message
	              $('#password_error').removeClass('alert-danger').addClass('alert-success');
	              $("#btnpass").prop("disabled",false);
	          }
	      });

		$("#btnpass").click(function(){
			var newPass = $("#txtpass").val();
			var conPass = $("#txtcpass").val();
			if(newPass =="" || conPass ==""){
				swal("Sorry","Password is not changed Please try again letter","error");
				exit;
			}
			if(newPass != conPass){
				swal("Sorry","Password and confirm password not matched","error");
				exit;
			}
			var data = $('#form_pass').serialize();
            var url  = "lib/mod_cus.php?type=updatePass";

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function (result) {

                  if(result=='0'){
                  	swal("Sorry","Password is not changed Please try again letter","error");
                  }else{
                  	
                  	swal("success","Password succss fully changed, you can login","success");
                  	setTimeout(function(){
                  		location.href= "index.php";
                  	},400);
                  	
                  }
                    
                },error:function(err,eobj,etxt){
                	console.log(etxt);
                }

            });

		});



	});


	
</script>