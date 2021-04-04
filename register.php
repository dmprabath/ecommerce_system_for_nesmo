<?php
session_start();
//add main Navigation
if(isset($_SESSION["customer"]["uname"])) {
     header("Location:index.php");       
}

require_once("include/header.php");
require_once("include/main_nav.php");

$cusid = getCusId();

?>

        <!-------------------start javascript ------------------------>

<div class="" >
	
<div class="container-fluid " style="background-color: #ededed">
	<div class="container-fluid" >

			
		</div>	
    <div class="row">
      <div class="col-lg-6 col-sm-8">
        <img src="resources/img/company-ethics.png" width="100%">
      </div>

      <div class="col-lg-4 col-sm-8 card  justify-content-center m-5" style="width: 100%">
          <div class=" m-4">
          <h3 class=" pb-3" align="center" >Create An Account</h3>
            <em class="text-danger ">* All Field are Required </em>
         <form class="">
             <input type="hidden" name="cus_id" value="<?php echo ($cusid);?>">


            <div class="form-group">
                  <input type="text" class="form-control form-control border-info fname"  required id="fname" name="fname" style="" placeholder="First Name *">
                    <span class=" error-message hidden" id="fname_error" >Enter Valid Name </span>
            </div>

             <div class="form-group">
                 <input type="text" required class="form-control form-control border-info" id="lname" name="lname" placeholder="Last Name *">
                 <span class=" error-message hidden" id="lname_error" >Enter Valid Name  </span>
             </div>


            <div class="form-group">
                <input type="email" required class="form-control form-control border-info" id="email" name="email" placeholder="Your Email Address *" >
                <span class=" error-message hidden" id="email_error" >Eneter Valid Email </span>
            </div>

            <div class="form-group">
                <input type="password" required class="form-control form-control border-info" required id="password" name="password" placeholder="Password *">
                <span class=" error-message hidden" id="password_error" >Password must be more than 8 digits and can't use symbols  </span>
            </div>

            <div class="form-group ">
              <input type="password" required class="form-control border-info " id="conpassword" name="conpassword" placeholder="Confirm Password *" >
                <span class=" error-message hidden" id="conpassword_error" >minimum 8 letters and maximum 30 </span>
            </div>

            <div class="form-group">
              <input type="text" required class=" form-control border-info"  id="bdate" name="bdate" style="" placeholder="Birth Date *">
                <span class=" error-message hidden" id="fname_error" >minimum 3 letters and can't use symbles! </span>
            </div>            

            <div class="  text-info ">
              <div class="form-check form-check-inline m-1">
                <input type="radio" class=" form-check-input " name="gender" id="male" value="1"
                checked> 
                  <span class="form-check-label">Male</span>
                <input type="radio" class="form-check-input ml-3" name="gender" id="female" value="0">
                  <span class="form-check-label">Female</span>
              </div>
               
            </div>   

          <div class=" pt-3" >
            <input type="button" name="btn_reg" id="btn_reg" class="btn btn-primary" value="create"> &nbsp;&nbsp;
            <input type="reset" name="" class="btn btn-danger" id="btn-clear" value="clear">
          </div>
          </form>
          </div>
          <div>
              <p><a href="#" id="btn_login" data-toggle="modal" data-target="#login_form"> I have an account</a></p>
          </div>

      </div>
      
    </div>	
	</div>
</div>
</div>


<script type="text/javascript">


  $(function(){
    $("#bdate").datepicker({
      changeMonth:true,
      changeYear:true,
      dateFormat:"yy-mm-dd",
      maxDate:"-6570"
    });
  });
  
  $("document").ready(function(){

                                /*------------------Input Validation ------------------------*/

      var $namePattern=/^([a-zA-Z ]{3,})$/;
      // validate first name
      $('#fname').on('keypress keydown keyup',function(){
          if (!$(this).val().match($namePattern)) {
              // there is a mismatch, hence show the error message
              $('#fname_error').removeClass('hidden');
              $('#fname_error').show();
          }
          else{
              // else, do not display message
              $('#fname_error').addClass('hidden');
          }
      });
      //validate last name
      $('#lname').on('keypress keydown keyup',function(){
          if (!$(this).val().match($namePattern)) {
              // there is a mismatch, hence show the error message
              $('#lname_error').removeClass('hidden');
              $('#lname_error').show();
          }
          else{
              // else, do not display message
              $('#lname_error').addClass('hidden');
          }
      });
      var $emailPattern=/^[^@]{1,64}@[^@]{4,253}$/;
      //validate email
      $('#email').on('keypress keydown keyup',function(){
          if (!$(this).val().match($emailPattern)) {
              // there is a mismatch, hence show the error message
              $('#email_error').removeClass('hidden');
              $('#email_error').show();
          }
          else{
              // else, do not display message
              $('#email_error').addClass('hidden');
          }
      });
      var $passwordPattern=/^([a-zA-Z0-9\@]{8,})$/;
      //validate pasword 
      $('#password').on('keypress keydown keyup',function(){
          if (!$(this).val().match($passwordPattern)) {
              // there is a mismatch, hence show the error message
              $('#password_error').removeClass('hidden');
              $('#password_error').show();
          }
          else{
              // else, do not display message
              $('#password_error').addClass('hidden');
          }
      });

                    /*------------------form Submission ------------------------*/
    $("#btn_reg").click(function(){
      var fname = $("#fname").val();        //first name in form
      var lname = $("#lname").val();        //lastname in form
      var email = $("#email").val();        //email in the form
      var password  = $("#password").val(); //password in the form
      var conPass = $("#conpassword").val(); // confirm password in the form
      var birthdate =$("#bdate").val();     // birthdate in the form
      var gender    = $("input[name='gender']:checked").length; // gender in the form

            var name_pattern=/^[a-zA-Z\.\s]+$/;
            if( fname=="" || !fname.match(name_pattern)){
                swal ("Invalid Input","Please enter your first name","error");
                return;
            }
            if( lname == "" || !lname.match(name_pattern)){
                swal ("Invalid Input","Please enter your last name","error");
                return;
            }
            var email_pattern=/^[a-zA-Z\.\s]+$/;
            if( email.match(email_pattern) || email==""){
                swal ("Invalid Input","Please enter your email address","error");
                return;
            }
            
            if( password == ""){
                swal ("Invalid Input","Please enter your password","error");
                return;
            }
            if( !conPass.match(password)){
                swal ("Invalid Input","Passwords are not match","error");
                return;
            }
      

      var fdata = $('form').serialize();
      var url = "lib/mod_cus.php?type=addNewCus"; 

      $.ajax({
        method:"POST",
        url:url,
        data:fdata,
        dataType:"text",

        success: function(result){


          res = result.split(",");
            if (res[0] == "0") {
                swal("Error", res[1], "error");
            }else if(res[0] == "2"){
                swal({
                    title: "Sorry ",
                    text: res[1],
                    icon: "warning",
                    button: true,
                    dangerMode: true
                }).then((willDelete) => {
                    if (willDelete) {
                        $("#login_form").modal();
                    }else{
                        $("#login_form").modal();
                    }
                });


            } else {
                swal({
                    title: "Success ",
                    text: res[1],
                    icon: "success",
                    button: true,
                    dangerMode: true
                }).then((willDelete) => {
                    if (willDelete) {
                        $("#btn-clear").click();
                        $("#login_form").modal();
                    }else{
                        $("#btn-clear").click();
                        $("#login_form").modal();
                    }
                });
            }
        },
        error: function (eobj, etxt, err) {
            console.log(etxt);
          }
      });
    });
  });
</script>

<?php require_once("include/footer.php") ?>

