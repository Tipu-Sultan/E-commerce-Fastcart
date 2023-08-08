<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'link.php' ?>
        <?php 
        include 'cart_cal.php';
         if (!isset($_SESSION['email'])) {
        header('Location:login.php');
      }
 ?>

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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="coupons.php">Coupons</a>
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
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>