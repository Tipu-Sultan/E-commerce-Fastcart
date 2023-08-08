<!DOCTYPE html>
<html lang="en">
    <head>

<?php include 'nav.php';
if (!isset($_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    }
?>


        <title>Edit Porfile</title>
    </head>
<body>
     <section class="h-100 gradient-custom-2 ">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
              <div class="card">
                <div class="rounded-top text-dark d-flex flex-row" style="background-image: url('images//banner.webp'); height:200px;">
                  <div class="ms-4  d-flex flex-column" style="width: 150px;">
                    <?php 
                    $file_pointer = 'uploads/'.$image;
            
                    if (file_exists($file_pointer)) 
                    {
                        echo '<img src="uploads/'.$image.'" alt="AVATAR" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">';
                    }
                    else 
                    {
                        echo '<img src="'.$image.'" alt="AVATAR" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">';
                    }
                     ?>
                    <a href="#" class="btn btn-outline-dark mx-2"  data-mdb-toggle="modal" data-mdb-target="#myModaledit">Edit Pic</a>
                  </div>
                  <form method="post" id="edit_profile" name="edit_profile">
                  <div class="ms-3 mt-5">
                    <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="names" name="names" value="<?php echo $users ?>" class="form-control "  required="" />
                              <label class="form-label" for="name">Your Name</label>
                            </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-user-circle fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="username" name="username" value="<?php echo $usernames ?>" class="form-control " onkeyup="alphanumeric(this.value)"  required="" />
                              <label class="form-label" for="name">Your Username</label>
                            </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-map-marker fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="state" name="state" value="<?php echo $state ?>" class="form-control "  required="" />
                              <label class="form-label" for="name">Your State</label>
                            </div>
                    </div>
                    <p id="liveuser">*</p>
                  </div>
                </div>

                <div class="card-body p-4 text-black mt-5">
                  <div class="mb-5 mt-5">
                    <p class="lead fw-normal mb-1">About</p>
                    <div class="p-4" style="background-color: #f8f9fa;">
                      <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="email" name="email" value="<?php echo $email ?>" class="form-control "  required="" />
                              <label class="form-label" for="name">Your Email</label>
                            </div>
                      </div>
                      <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-map-marker fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="address" name="address" value="<?php echo $address ?>" class="form-control "  required="" />
                              <label class="form-label" for="name">Your Address</label>
                            </div>
                      </div>
                      <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-phone fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="text" id="mobile" name="mobile" value="<?php echo $mobile ?>" class="form-control "  required="" />
                              <label class="form-label" for="name">Your Mobile</label>
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0"><button  class="text-muted btn btn-outline-dark" id="edit_btn" name="submit">Edit Account</button></p>
                  </div>
                  <div  id="error_msg">

                 </div>
               </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<script type="text/javascript">
  jQuery('#edit_profile').on('submit',function(e){
    e.preventDefault();
    $("#edit_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Editing...</span>");
    jQuery('#edit_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'edit_redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.is_error =='no'){
          window.location.href = 'profile.php';
        }else if(obj.is_error =='yes'){
          jQuery('#error_msg').html(obj.eid);
          jQuery('#edit_profile').html('retry');
        jQuery('#edit_btn').attr('disabled',false);
        }else if(obj.is_error =='file_err'){
          jQuery('#error_msg').html(obj.eid);
          jQuery('#edit_btn').html('retry');
        jQuery('#edit_btn').attr('disabled',false);
        }else if(obj.is_error =='type_err'){
          jQuery('#error_msg').html(obj.eid);
          jQuery('#edit_btn').html('retry');
        jQuery('#edit_btn').attr('disabled',false);
        }
      }
    });
  });
</script>

<script type="text/javascript">
    function alphanumeric(str) {
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{alpha:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#liveuser').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#liveuser').html(obj.msg);
                }
            }
        });
    }
</script>
      <!-- MDB -->
      <?php include 'footer.php';?>
</body>
</html>