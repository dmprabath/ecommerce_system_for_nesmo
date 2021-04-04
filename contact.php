<?php 
session_start();
//add main Navigation


?>

<script type="text/javascript">

</script>

<?php require_once ("include/main_nav.php"); ?>

<div class="bg-dark text-light row py-3" >
	<div class="col-sm-12 text-center">
		<h3  class="text-weight-bold " >CONTACT US</h3>
	</div>
	<div class="col-sm-12 text-center">
		<p  class="font-italic " ><i class="fas fa-1x fa-home"></i> Home <i class="fas fa-chevron-right"></i> Contact us </p>
	</div>   
    
</div>
<!----------------------------         add background image to contact form----------------->
  <!-- <div class="w-100" style="background-image: url('resources/img/contact_back.jpg'); background-size: cover"> --> 
<div class="w-100" >

<div class="container justify-content-center pt-4  text-light">

<div  class="">

</div>
    <div class="pt-5">

        <div class="row  ">
            <div class="col-lg-5 col-sm-12 text-dark ">
                <h6>NESMO INTERNATIONAL (PVT) LTD</h6>
                <p>No.103,<br> Highlevel Road,<br> Pannipitiya, <br> Srilanka.</p>
                <p>info@nesmo.lk<br> 070 366 5500<br> www.nesmo.lk</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2686.8445615166497!2d79.9503837857007!3d6.845596224356604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae251d5ebe625b9%3A0xdd66d6c0c828ba73!2sNESMO%20International%20(Pvt)%20Ltd!5e1!3m2!1sen!2slk!4v1578054633447!5m2!1sen!2slk" width="100%" height="300px"  frameborder="0" style="border:1;" allowfullscreen=""></iframe>
                
            </div>

            <div class="col-lg-6 col-sm-12 bg-white border ml-3  shadow
            ">
                <!--------------------------------------Contact Form start--------------->

                    <form  id="cform" >
                        <div class="container "><h5 class="ml-auto text-dark text-center my-3">Drop A Message</h5></div>
                        <div class=" col-sm-10 form-group row">
                            <label class="form-input-label text-dark col-4">Name <strong class="text-danger ">* </strong></label>
                            <input type="text" class="form-control col-8" name="name" id="name" placeholder="Your Name">
                            
                        </div>
                        <div class=" col-sm-10 form-group row">
                            <label class="form-input-label text-dark col-4">Email <strong class="text-danger ">* </strong></label>
                            <input type="email" class="form-control col-8" name="email" id="email"
                                   placeholder="Your Email Address">
                            
                        </div>
                        <div class=" col-sm-10 form-group row">
                            <label class="form-input-label text-dark col-4">Contact No</label>
                            <input type="tel" class="form-control col-8" name="phone" id="phone" placeholder="Your Telephone">
                        </div>
                        <div class=" col-sm-10 form-group row">
                            <label class="form-input-label text-dark col-4">Subject <strong class="text-danger ">* </strong></label>
                            <input type="text" class="form-control col-8" name="msg-title" id="msg-title" placeholder="Subject">
                        </div>
                        <div class=" col-sm-10 form-group row">
                            <label class="form-input-label text-dark col-4">Message <strong class="text-danger ">* </strong></label>
                        <textarea class="form-control col-8" name="message" id="message" rows="6"
                                  placeholder="Your Message"></textarea>
                        </div>
                        <div class=" col-sm-10 form-group">
                            <button id="btn_send" type="button" class="btn btn-success" >Send </button>                            
                            <input type="button"  class="btn btn-danger " value="Clear">
                            <span><img src="resources/img/page-loading.gif" id="sendimage" class="col-sm-5 d-none"></span>
                        </div>
                        <small class="text-danger ">* Required Fields</small>
                    </form>
                <!--------------------------------------Contact Form End--------------->
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once ("include/footer.php")  ?>

<script>
    $(document).ready(function(){

        // after click send button form will submit and send email  ?type=conSend

        $("#btn_send").click(function(){
            var name = $("#name").val();
            var email = $("#email").val();
            var msg_title = $("#msg-title").val();
            var phone = $("#phone").val();
            var message = $("#message").val();

            var numberPattern = /^([0-9]{10})$/;
            var namepattern=/^([a-zA-Z \t]{3,})$/;
            var emailpattern=/^[a-zA-Z\d\_]+\@[a-zA-Z\d\-]+\.[a-zA-Z\d]{2,6}$/;
            if(name =="" || !name.match(namepattern)){
                swal("Error","Enter Valid name","error");
                return;
            }
            if(email =="" || !email.match(emailpattern)){
                swal("Error","Enter Valid Email","error");
                return;
            }
            if(phone !=""){
                if(!phone.match(numberPattern)){
                    swal("Error","Enter Valid Phone","error");
                    return;
                }                
            }
            if(msg_title =="" ){
                swal("Error","Subject is Requird","error");
                return;
            }
            if(message =="" ){
                swal("Error","Message is Requird","error");
                return;
            }
            $("#btn_send").attr("disabled",true);
            $("#sendimage").removeClass("d-none");
            var fdata = $('form').serialize();
            $.ajax({
                method:'POST',
                url:'lib/mailsend.php',
                data:fdata,
                dataType:'text',
                success:function (result) {
                                       
                    swal("Message Was Sent.","We will contact you soon.","success");
                    setTimeout(function(){ 
                        location.reload();
                    }, 3000);
                },
                error:function (eobj,err,etxt) {
                    console.log(etxt);
                }
            });
        });
        

      
    })

</script>
