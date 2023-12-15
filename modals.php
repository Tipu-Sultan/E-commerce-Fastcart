<?php 
$user_cookie ='';
$pass_cookie = '';
$remember = '';
if (isset($_COOKIE['user']) && isset($_COOKIE['password'])) {
  $user_cookie = $_COOKIE['user'];
  $pass_cookie = $_COOKIE['password'];
  $remember = "checked='checked'";
}
 ?>
<style type="text/css">
  .vert-move {
    -webkit-animation: mover 1s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
.vert-move {
    -webkit-animation: mover 1s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
}


/* width */
::-webkit-scrollbar {
  width: 20px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #b09a9a; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
div#chatbox {
  height: 60vh;
  overflow: scroll;
}

div#chatbox::-webkit-scrollbar{
  display: none;
}

.ccard{
  width: 500px;
  border: none;
  border-radius: 15px;
}
.adiv{
  background: #04CB28;
  border-radius: 15px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  font-size: 12px;
  height: 46px;
}
.chat{
  border: none;
  background: #E2FFE8;
  font-size: 10px;
  border-radius: 20px;
}




</style>
<!-- signin -->
<div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" id="exampleModalLabel">Sign up</h5>
        <button type="button" class="btn-close bg-light" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="images/mancode.jpg" class="img-responsive img-fluid rounded mb-4">
      
                      <form class="mx-1 mx-md-4" action="#agree" method="POST" id="signin" name="signin">
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Amit,Ayan"/>
                            <label class="form-label" for="form3Example1c">Your Name</label>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="username_singin" class="form-control" name="username" placeholder="(az,AZ,09,@!#)" onkeyup="findusers(this.value)"/>
                            <label class="form-label" for="form3Example1c">Username</label>
                          </div>
                        </div>
                        <p class="text-danger" id="dataTable">* </p>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" id="email_singin" class="form-control" name="email"/>
                            <label class="form-label" for="form3Example3c">Your Email</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password" class="form-control" name="password" placeholder="(az,AZ,09,@!#)" onkeyup="signpass(this.value)"/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>
                        <p id="pass_msg" ></p>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="cpassword_singin" class="form-control" name="cpassword" />
                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                          </div>
                        </div>
      
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input
                            class="form-check-input me-2"
                            type="checkbox"
                            value="I agree all statements in Terms of service"
                            id="agree_singin"
                            name="agree"
                          />
                          <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms of service</a>
                          </label>
                        </div>
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                         <button  class="btn btn-primary btn-block mb-4" id="signin_btn" name="submit">Signin</button>
                        </div>
                              

                      </form>
                      <div id="succ_msg" class="vert-move">
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- ///////////// -->
<script type="text/javascript">
  jQuery('#signin').on('submit',function(e){
    $("#signin_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>creating...</span>");
    jQuery('#signin_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'register.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var sin = jQuery.parseJSON(result);
         if(sin.is_error == 'no'){
        jQuery('#succ_msg').html(sin.msgs);
        jQuery('#signin')[0].reset();
        jQuery('#signin_btn').html('done');
        jQuery('#signin_btn').attr('disabled',false);
        }else if(sin.is_error == 'yes'){
          jQuery('#succ_msg').html(sin.msgs);
          jQuery('#signin')[0].reset();
          jQuery('#signin_btn').html('retry');
        jQuery('#signin_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>
<!-- //////////////////////// -->
<script type="text/javascript">
    function findusers(str) {
        if (str.length==0) {
    document.getElementById("dataTable").innerHTML="";
    document.getElementById("dataTable").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{search:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#dataTable').html(obj.res);
                }else if (obj.error == 'yes'){
                    $('#dataTable').html(obj.msg);
                }
            }
        });
    }
</script>
<script type="text/javascript">
    function signpass(str) {
        if (str.length==0) {
    document.getElementById("pass_msg").innerHTML="";
    document.getElementById("pass_msg").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{alpha:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#pass_msg').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#pass_msg').html(obj.msg);
                }
            }
        });
    }
</script>

<!-- login  -->

<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close bg-light" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="images/mancode.jpg" class="img-responsive img-fluid rounded mb-2">
                              <?php
                              if(!isset($_SESSION['client_id'])){
                              ?>
                              <center>
                              <div class="g-signin2 mb-3" data-width="200"  data-longtitle="true" data-onsuccess="gmailLogIn">
                              </center>
                              <?php
                              }
                              ?>
      
                      <form class="mx-1 mx-md-4" method="POST" action="#" id="login_form" name="login_form">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="both_lgin" class="form-control" name="both" value="<?php echo $user_cookie ?>" required=""/>
                            <input type="text" id="copy_both" class="form-control" name="login" value="login" hidden="" />
                            <label class="form-label" for="form3Example1c">Email / Username</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_login" class="form-control" value="<?php echo $pass_cookie ?>" name="password" required=""/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>
                        <input type="checkbox" value="" name="remember" <?php echo $remember ?>><span class="fw-bold"> Remember Me</span>
                        <br>
                        <input type="checkbox" onclick="ShowPasFunction()"> Show Password
                        <p id="login_msg" class="vert-move mt-3"></p>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg" id="login_btn">Login now</button>
                        </div>
                        <p class="text-center"><a href="#" data-mdb-dismiss="#login" data-mdb-toggle="modal" data-mdb-target="#forgot">Forgot password</a></p>
                      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function ShowPasFunction() {
  var x = document.getElementById("password_login");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script type="text/javascript">
  jQuery('#login_form').on('submit',function(e){
    $("#login_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Connecting...</span>");
    jQuery('#login_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'login.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var login = jQuery.parseJSON(result);
         if(login.error == 'no'){
          var currentPage = window.location.href;
          window.location.href = currentPage;
        }else if(login.error == 'yes'){
          jQuery('#login_msg').html(login.msg);
          jQuery('#login_btn').html('retry');
        jQuery('#login_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>

<!-- forgot account -->
<div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" id="exampleModalLabel">Forgot</h5>
        <button type="button" class="btn-close bg-light" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="images/mancode.jpg" class="img-responsive img-fluid rounded mb-4">
      
                      <form class="mx-1 mx-md-4" method="POST" id="opt_form" name="opt_form" >
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="email_forgot" name="email" class="form-control" onkeyup="otpEnableDisable(this) " required=""/>
                            <input type="text" id="type_forgot" name="type" value="otp" hidden>
                            <label class="form-label" for="form3Example1c">Email or Username</label>
                          </div>
                        </div>
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" id="otp_btn" class="btn btn-primary btn-lg" disabled="disabled">GET OTP</button>
                        </div>
                        <div id="otp_msg" class="vert-move">
                          
                        </div>
                      </form>
<script type="text/javascript">
    function otpEnableDisable() {
        var val = document.getElementById('email_forgot').value;
        if(val.length>5) {
            document.getElementById('otp_btn').disabled='';
        }
        else {
            document.getElementById('otp_btn').disabled='disabled';
        }
    }
</script>
                      
                      <form class="mx-1 mx-md-4" method="POST" id="reset_pass" name="reset_pass">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="otp_otp" class="form-control" name="otp" onkeyup="EnableDisable(this)" required="" />
                            <input type="text" id="type_otp" name="type" value="resetapss" hidden>
                            <label class="form-label" for="form3Example1c">Enter OTP</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_otp1" class="form-control" name="password" placeholder="(az,AZ,09,@!#)" onkeyup="passwrds(this.value)" required=""/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>
                        <p id="pass_msgs"></p>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_otp2" class="form-control" name="cpassword" required=""/>
                            <label class="form-label" for="form3Example4c">Repeat Password</label>
                          </div>
                        </div>
                        <input type="checkbox" onclick="myFunction()">Show Password


                        <div id="reset_msg" class="vert-move">
                          
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" id="reset_btn" class="btn btn-primary btn-lg" disabled="disabled">Reset now</button>
                        </div>
                        <p class="text-center"><a href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#login">Retry login</a></p>
                        <div id="reset_msg">
                          
                        </div>
                      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("password_otp1");
  var y = document.getElementById("password_otp2");

  if (x.type === "password" && y.type === "password") {
    x.type = "text";
    y.type = "text";

  } else {
    x.type = "password";
    y.type = "password";

  }
}
</script>


<script type="text/javascript">
    function EnableDisable() {
        var val = document.getElementById('otp_otp').value;
        if(val.length>5) {
            document.getElementById('reset_btn').disabled='';
        }
        else {
            document.getElementById('reset_btn').disabled='disabled';
        }
    }
</script>

<script type="text/javascript">
    function passwrds(str) {
        if (str.length==0) {
    document.getElementById("pass_msgs").innerHTML="";
    document.getElementById("pass_msgs").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{alpha:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#pass_msgs').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#pass_msgs').html(obj.msg);
                }
            }
        });
    }
</script>

<script type="text/javascript">
  jQuery('#reset_pass').on('submit',function(e){
    $("#reset_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Reseting...</span>");
    jQuery('#reset_btn').attr('disabled',true);
    jQuery.ajax({
      url : 'forgot.php',
      type : 'post',
      data:jQuery('#reset_pass').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.is_error == 'no'){
        jQuery('#reset_msg').html(obj.msg);
        jQuery('#reset_btn').html('Done');
        jQuery('#reset_btn').attr('disabled',false);
      }else{
        jQuery('#reset_msg').html(obj.msg);
        jQuery('#reset_btn').html('Try again');
        jQuery('#reset_btn').attr('disabled',false);
      }
      }
    });
    e.preventDefault();
  });
</script>

<script type="text/javascript">
  jQuery('#opt_form').on('submit',function(e){
    $("#otp_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Sending...</span>");
    jQuery('#otp_btn').attr('disabled',true);
    jQuery.ajax({
      url : 'forgot.php',
      type : 'post',
      data:jQuery('#opt_form').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.opt_er == 'no'){
        jQuery('#otp_msg').html(obj.msg);
        jQuery('#otp_btn').html('Resend');
        jQuery('#otp_btn').attr('disabled',false);
      }else{
        jQuery('#otp_msg').html(obj.msg);
        jQuery('#otp_btn').html('Try again');
        jQuery('#otp_btn').attr('disabled',false);
      }
      }
    });
    e.preventDefault();
  });
</script>
<div class="modal fade" id="del_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Delete account</p>

        <p class="text-center text-danger vert-move">Are you sure to delete this account</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <a href="?del_account=<?php echo $_SESSION['user_id'] ?>&sesskey=<?php echo $_SESSION['sesskey'] ?> "><button type="button" class="btn btn-danger">delete</button></a>
      </div>
    </div>
  </div>
</div>


<!-- //////////////remove image -->


  <!-- Modal -->
  <div class="modal fade" id="myModaledit" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
      <div class="form-group">
                  <h4 class="modal-title">Image changing setup on</h4>

                <label class="font-weight-bold">image</label>
                <?php
if (isset($image)) {
?>
<a href="uploads/<?php echo $image?>"><img  style="border-radius: 50%;" src="uploads/<?php echo $image?>" alt="?" height="50" width="50"></a><br>
<?php
}else{
echo "NULL";
}
?>
<p><a href="edit_redirect.php?repic=<?php echo $view['user_id']?>&imgID=<?php echo $view['image']?>">Remove picture</a></p>
                 <!-- File upload form -->
<form id="uploadForm" class="mt-2" enctype="multipart/form-data" method="post">
    <label>Choose File:</label>
    <input type="text" name="user_id" value="<?php echo $users ?>" hidden>
    <input type="text" name="imgID" value="<?php echo $image ?>" hidden>
    <input type="file" name="file" id="fileInput" class="form-control" required="">
    <br>
    <input class="form-control" type="submit" name="submit" value="UPLOAD"/>
</form>
<!-- Progress bar -->
<div class="progress mt-5">
    <div class="progress-bar"></div>
</div>

<!-- Display upload status -->
<div id="uploadStatus" class="mt-5"></div>

        </div>
        </div>
      </div>
    </div>
  </div>

<!-- //////////////know more chat -->



<!-- chatbox  -->
 <style>

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 400px;
  padding: 10px;
}

</style>




<div class="chat-popup form-container" id="myForm" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="exampleModalLabel">FAST-CART ASSISTANT</h5>
        <button type="button" onclick="closeForm()" class="btn-close bg-light"  aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container d-flex justify-content-center">
          <div>
            <div id="chatbox">
      
          </div>
            <p id="generate"></p>
          <div class="form-group px-3 mt-2" id="userInput">
            <input class="form-control" id="textInput" rows="5" placeholder="Type your message"/>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6491ec8dcc26a871b023b4b2/1h3d082sq';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("myBtn").style.display = "none";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("myBtn").style.display = "block";
}
</script>
 <!-- script tag end -->

<script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
      jQuery('#upload_btn').attr('disabled',true);
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'edit_redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                 var sin = jQuery.parseJSON(resp);
             if(sin.is_error == 'no'){
            window.location.href ='profile.php';
            }else if(sin.is_error == 'yes'){
            jQuery('#uploadStatus').html(sin.msgs);
            jQuery('#uploadForm')[0].reset();
            jQuery('#upload_btn').html('Retry');
            jQuery('#upload_btn').attr('disabled',false);
            }
            }
        });
    });
  
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (JPG, PNG, GIF, JPEG');
            $("#fileInput").val('');
            return false;
        }
    });
});
</script>

<script>
function DisplayCurrentTime() {
        var date = new Date();
        var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
        var am_pm = date.getHours() >= 12 ? "PM" : "AM";
        hours = hours < 10 ? "0" + hours : hours;
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds + " " + am_pm;

        return time;
    };
    function getBotResponse() {
      var rawText = $("#textInput").val();
      var userHtml = '<div class="d-flex flex-row p-3"><img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30"><div class="chat ml-2 p-3">'+rawText+'</div></div>';
      $("#textInput").val("");
      $("#chatbox").append(userHtml);
      $("#generate").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Please wait while fetching...</span>");
      document
        .getElementById("userInput")
        .scrollIntoView({ block: "start", behavior: "smooth" });
      $.post("send_data.php", { botquery: rawText }).done(function(data) {
        var botHtml = '<div class="d-flex flex-row p-3"><div class="bg-white mr-2 p-3"><span class="text-muted">'+data+'</span></div><img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30"></div>';
        $("#chatbox").append(botHtml);
        document
          .getElementById("userInput")
          .scrollIntoView({ block: "start", behavior: "smooth" });
          jQuery('#chatbox').animate({scrollTop:1000000},800);
          $("#generate").html("")
          
      });
    }
    $("#textInput").keypress(function(e) {
      if (e.which == 13) {
        getBotResponse();
        jQuery('#chatbox').animate({scrollTop:1000000},800);
      }
    });

  </script>
