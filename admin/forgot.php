
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php session_start(); include 'link.php'; ?>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
<div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">TheManCode</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="users.php">Users</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="table.php">Products</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="order_items.php">Order items</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="cart_items.php">Cart items</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="add_product.php">Add products</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button id="sidebarToggle" class="btn btn-outline-primary">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link float-left" href="index.php">Home</a></li>
                                <li class="nav-item dropdown">
                                  <?php if (isset($_SESSION['user_id'])) {
                                    ?>
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php echo $_SESSION['username']; ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                    <?php
                                    }
                                     ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

             <!-- Page content-->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <section class="vh-100 mt-5" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Forgot Password OR Email</p>
      
                      <form class="mx-1 mx-md-4" method="POST" id="forgotForm">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" id="email" class="form-control" name="email" />
                            <label class="form-label" for="form3Example1c">Your Email</label>
                          </div>
                        </div>
          
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-primary " id="forgotbtn">Recover Password</button>
                        </div>
                        <p id="msg"></p>
                      </form>

<hr class="p-2 text-info">
                      <form class="mx-1 mx-md-4" method="POST" id="forgotForm">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password" class="form-control" name="password" />
                            <label class="form-label" for="form3Example1c">Your Password</label>
                          </div>
                        </div>
          
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-primary " id="forgotbtn">Reset Password</button>
                        </div>
                        <p><?php if(isset($msg)){
                        	echo $msg;
                        } ?></p>
                        <a href="login.php">Login</a>
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="https://educatingalllearners.org/wp-content/themes/bulmapress/images/contact.png" class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> 
                    </div>
                </div>
                 <!-- Page content-->
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
        <script src="js/scripts.js"></script>
    </body>
</html>


<?php
    include 'themancode.php';

    if (isset($_POST['password'])) {
    	$token = $_GET['getToken'];
        $password = $_POST['password'];
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $query =  mysqli_query($con,"update admin set password='{$pass}' where token='{$token}' and admin='admin'");

        if($query)
        {
            $msg = "Reset Succesfully";
        }else
        {
            $msg = "Error found";
        }

        echo $msg;
}
    ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  jQuery('#forgotForm').on('submit',function(e){
    $("#forgotbtn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Recovering...</span>");
    jQuery('#forgotbtn').attr('disabled',true);
    jQuery.ajax({
      url : 'recoverpass.php',
      type : 'post',
      data:jQuery('#forgotForm').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.error =='no'){
        jQuery('#msg').html(obj.msg);
        jQuery('#forgotbtn').html('Recover Password');
        jQuery('#forgotbtn').attr('disabled',false);
        }else if(obj.error =='yes'){
          jQuery('#msg').html(obj.msg);
          jQuery('#forgotForm')[0].reset();
          jQuery('#forgotbtn').html('Recover Password');
        jQuery('#forgotbtn').attr('disabled',false);
        }
      }
    });


  e.preventDefault();
  });
</script>

