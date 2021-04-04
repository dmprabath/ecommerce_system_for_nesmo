	
<!DOCTYPE html>
<html>
<head>
	<link href="../../resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
	<script src="../../resources/js/jquery-3.3.1.min.js" ></script>
    <script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
    	if(isset($_GET['u'])){
    		$mail= $_GET['u'];
    	}
    ?>
    <div class="container center ">
    	<div class="card col-lg-5 col-sm-12 mx-auto my-5 border shadow p-4">
    		<div id="box-login">
    			<div>
	    			<h4>Login to Reset</h4>
	    		</div>
    			<form >
	            	<div>
	            		<p class="alert alert-danger d-none " id="login_alert"> </p>
	            	</div>
	                <div class="form-group">
	                    <label class="custom-input-label ">  Username</label>
	                    <input type="text" id="uname" name="uname" class="form-control">
	                </div>
	                <div class="form-group">
	                    <label class="custom-input-label ">  Password</label>
	                    <input type="password" id="upass" name="upass" class="form-control">
	                </div>
	                <div>
	                	<button type="button" class="btn btn-primary" id="btn_login">Login</button>
	                	<img src="../../resources/img/loading.gif" id="login_image" class="d-none" width="75px">
	                </div>
	            </form>
    		</div>

    		<div id="box-pass" class="d-none">
    			<div>
	    			<h4>Reset Password</h4>
	    		</div>
	            <form >
	            	<div>
	            		<p class="alert alert-info " id="pass_alert">Password must include at least one simple letter and capital letter and minimum 8 digits </p>
	            		<p class="alert  " id="pass_error"></p>
	            		<input type="hidden" name="newmail" id="newmail">
	            	</div>
	                <div class="form-group">
	                    <label class="custom-input-label ">  New Password</label>
	                    <input type="password" id="newpass" name="newpass" class="form-control">
	                </div>
	                <div class="form-group">
	                    <label class="custom-input-label ">  Confirm Password</label>
	                    <input type="password" id="con_pass" name="con_pass" class="form-control">
	                </div>
	                <div>
	                	<button type="button" class="btn btn-primary" id="btn_confirm">Confirm</button>
	                	<img src="../../resources/img/loading.gif" id="load_image" class="d-none" width="75px">
	                </div>
	            </form>	
    			
    		</div>
    		
    	</div>
    	<div>    		
    	</div>
    </div>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){

		$("#btn_login").click(function(){
			var mail = "<?php echo $mail ?>";
			var uname = $("#uname").val();
			var upass = $("#upass").val();
			if(uname =="" || upass==""){
				$("#login_alert").removeClass("d-none");
				$("#login_alert").html("Please Enter email and your tempory password");
			}else{
				$("#login_alert").addClass("d-none");
				$.ajax({
					method: "POST",
					url : "mod_password.php?type=checkLogin",
					data :{uname:uname,upass:upass,mail:mail},
					dataType:"text",
					success:function(result){
						res=result.split(",");
						if(res[0]=="0"){
							$("#login_alert").removeClass("d-none");
							$("#login_alert").html(res[1]);

						}else if(res[0]=="1"){
							$("#box-login").addClass("d-none");
							$("#box-pass").removeClass("d-none");
							$("#newmail").val(uname);
						}					
					},
					error:function(eobj,err,etxt){
						console.log(etxt);
					}
				});
			}
			
		});

		$("#btn_confirm").click(function(){
			var email = $("#newmail").val();
			var pass = $("#newpass").val();
			var conpass = $("#con_pass").val();
			//var email = "<?php echo $mail  ?>";
			var passwordPattern = /^(?=.*[1-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
			// must be at least one simple letter and capital letter and minimum 8 digits 
			if(pass=="" || con_pass=="" ){
				$("#pass_error").html('Please type password and Confirm Password');
				$("#pass_error").addClass('alert-danger');
				$("#pass_alert").addClass('alert-info');

			}else if(!pass.match(passwordPattern)){
				$("#pass_alert").addClass('alert-danger');

			}else if(pass=="" || con_pass=="" ){
				$("#pass_error").html('Please type password and Confirm Password');
				$("#pass_error").addClass('alert-danger');
				$("#pass_alert").addClass('alert-info');

			}else if(pass != conpass){
				$("#pass_error").html('Password and confirm password not matched');
				$("#pass_error").addClass('alert-danger');
				$("#pass_alert").addClass('alert-info');
			}else{
				$.ajax({
					method: "POST",
					url : "mod_password.php?type=changePass",
					data :{pass:pass,email:email},
					dataType: "text",
					success:function(result){
						
						res = result.split(",");
						if(res[0]=="0"){
							$("#pass_error").html(res[1]);
							$("#pass_error").addClass('alert-danger');
						}else{
							location.href ="../index.php";
						}
					},
					error:function(eobj,err,etxt){
						console.log(etxt);
					}
				});
			}	
		});


		
	});
</script>
	

    

