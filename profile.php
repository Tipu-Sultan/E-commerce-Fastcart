<!DOCTYPE html>
<html lang="en">
    <head>

<?php include 'nav.php';
if (!isset($_SESSION['user_id'])) {
      ?>
      <script type="text/javascript">
       window.location = 'index.php';
      </script>
      <?php
    }
if (isset($_GET['del_account'])) {
 $uid =  $_GET['del_account'];
 $sid =  $_GET['sesskey'];
 if ($uid) {
   $delete = mysqli_query($con,"DELETE FROM `redcart` WHERE user_id='$uid' and sesskey='$sid'");
  session_destroy();
      ?>
      <script type="text/javascript">
       window.location = 'index.php';
      </script>
      <?php
 }
}

if (isset($_SESSION['user_id'])) {
?>
        <title>Porfile</title>
    </head>
<body>
  <script type="text/javascript">
    document.getElementById("profileNav").classList.add('active');
  </script>
    <section class="h-100 gradient-custom-2">
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
                    <a href="edit.php"  class="btn btn-outline-dark mt-4" data-mdb-ripple-color="dark" style="z-index: 1;">Edit Profile</a>
                  </div>
                  <div class="ms-3" style="margin-top: 80px;">
                    <h5><?php echo $users ?></h5>
                    <h5><?php echo $state ?></h5>
                  </div>
                </div>
                <div class="p-4 text-black" style="background-color: #f8f9fa;">
                  <div class="d-flex justify-content-end text-center py-1">
                    <div>
                      <p class="mb-1 h5"><?php echo $otp ?></p>
                      <p class="small text-muted mb-0">OTP</p>
                    </div>
                  </div>
                </div>
                <div class="card-body p-4 text-black">
                  <div class="mb-5 mt-5">
                    <p class="lead fw-normal mb-1">About</p>
                    <div class="p-4" style="background-color: #f8f9fa;">
                      <p class="font-italic mb-1"><?php echo $email ?></p>
                      <p class="font-italic mb-1"><?php echo $address ?></p>
                      <p class="font-italic mb-0"><?php echo $mobile ?></p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0"><a href="#"  class="text-muted btn btn-outline-dark" data-mdb-toggle="modal" data-mdb-target="#del_account">Delete account</a></p>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php
}
?>
      <!-- MDB -->
      <?php include 'footer.php';?>
</body>
</html>