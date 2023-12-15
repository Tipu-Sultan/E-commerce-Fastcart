<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  include 'nav.php';
  include 'cart_cal.php';

  if (!isset($_SESSION['user_id'])) {
      ?>
      <script type="text/javascript">
       window.location = 'index.php';
      </script>
      <?php
    }
 ?>

    <title>Orders</title>
</head>
<body>



  <?php 
  $uid = $_SESSION['user_id'];
  if (isset($_GET['cancel_order'])) {
    $oid = mysqli_real_escape_string($con, $_GET['cancel_order']);

    // Perform your database operations here
    $order_items = mysqli_query($con,"DELETE FROM `order_items` WHERE order_id='$oid' and status='confirmed' ");
    $confirm_items = mysqli_query($con,"DELETE FROM `confirm` WHERE order_id='$oid'");
    ?>
    <script type="text/javascript">
      window.location.href = "orders.php";
    </script>
    <?php
    exit();
}
  ?>
  <script>
    document.getElementById("ordersNav").classList.add('active');
    function cancelOrder(orderId) {
    var confirmed = confirm("Are you sure you want to cancel this order?");

    if (confirmed) {
        window.location.href = "?cancel_order=" + orderId;
    } else {
        alert("Order Cancellation Abort");
    }
}

</script>
<?php 
$counts = mysqli_query($con,"SELECT * FROM confirm WHERE status='pending' and  user_id='$uid'");
$order_counts = mysqli_num_rows($counts);
if ($order_counts>0) {

 ?>
<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-2">Thanks for your Order, <span style="color: #a8729a;"><?php echo $users ?></span>!</h5>
            <p><?php echo $email ?></p>
            <p><?php echo $address ?></p>
            <p class="text-muted mb-0">Total Items : <?php echo $order_counts ?></p>
          </div>
          <div class="card-body p-4">
            <?php 
            $order_items = mysqli_query($con,"SELECT * FROM confirm WHERE status='pending'  and  user_id='$uid' order by id desc");
            
            while ($row = mysqli_fetch_assoc($order_items)){
             ?>
             <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
              <p class="small text-muted mb-0 text-uppercase">Receipt Voucher : <?php echo $row['order_id']?></p>
              <p class="small text-muted mb-0">Delivery Date : <?php echo $row['date']?></p>
            </div>
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <img src="product/<?php echo $row['image'] ?>" alt="Phone" width="100" height="100" class="rounded-circle">
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0"><span class="text-success">Status</span> <br><?php echo $row['status']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><span class="text-success">Coupon applied</span><br> <?php echo $row['coupon_value']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><span class="text-success">QUANTITY</span><br><?php echo $row['total_item'] ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><span class="text-success">GT</span> <br><?php echo $row['price']." ₹" ?></p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                <div class="row d-flex align-items-center">
                  <div class="col-md-2">
                    <p class="text-muted mb-0 small"><a href="javascript:void(0)" onclick="cancelOrder('<?php echo $row['order_id']  ?>')">Cancel Order</a></p>
                    <p class="text-muted mb-0 small mt-4"><a href="order_details.php?order_id=<?php echo $row['order_id'] ?>">See Order</a></p>
                    <?php 
                    if(empty($row['txn_id']))
                    {
                      ?>
                      <p class="btn btn-outline-danger btn-sm mt-3"><a href="http://localhost/fastcart/razorpay/razorpay/index.php?order_id=<?php echo $row['order_id'] ?>&amt_id=<?php echo $row['price'] ?>">Pay amount</a></p>
                      <?php
                    }

                     ?>
                  </div>
                  <div class="col-md-10">
                    <div class="progress" style="height: 6px; border-radius: 16px;">
                      <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: <?php echo $row['processed'] ?>%; border-radius: 16px; background-color: #a8729a;"
                        aria-valuenow="20"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      ></div>
                    </div>
                    <div class="d-flex justify-content-around mb-1">
                      <p class="text-muted mt-1 mb-0 small ms-xl-5">Dispatch</p>
                      <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                      <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total (inclusive of all taxes)</span> <?php echo $total_pay_amount." ₹" ?></p>
            </div>

            
            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Total Items : <?php echo $order_counts ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> <?php echo "+".$order_shipped ?></p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0"></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Coupon value :</span> <?php echo " - ".$coupon_value ?></p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5" style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total paid: <span class="h2 mb-0 ms-2"><?php echo $total_pay_amount." ₹" ?></span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}else{
  ?>      <div class="d-flex justify-content-center border border-light mt-4 p-5">

              <img src="images/flipkart.svg" class="img-fluid" alt="">

              </div>
                <p class="mt-2 text-center">Not yet order any product/ items? <br><br><a href="index.php" class="btn btn-outline-warning">Continue shopping</a></p> 
  <?php
}
?>
<?php include 'footer.php';?>
</body>
</html>