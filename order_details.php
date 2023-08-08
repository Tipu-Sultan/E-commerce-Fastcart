<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'nav.php';
  if (!isset($_SESSION['user_id'])) {
   header('location:index.php');
   die();
 }
 ?>

    <title>Orders</title>
</head>
<body>
  
<?php 
$counts = mysqli_query($con,"select * from order_items where user_id='$uid' and status='confirmed'");
$order_counts = mysqli_num_rows($counts);
if ($order_counts>0) {
if (isset($_GET['order_id'])) {
              $orid = $_GET['order_id'];
            $order_items = mysqli_query($con,"SELECT * FROM order_items WHERE order_id='$orid' and user_id='$uid' and status='confirmed' order by id desc");
           $odc = mysqli_num_rows($order_items);

           $coupon = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM confirm WHERE order_id='$orid' "));
           $coupon_value = $coupon['coupon_value'];
           $Invoice = $coupon['order_id'];

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
            <p class="text-muted mb-0">Total Items : <?php echo $odc ?></p>
            <p class="text-muted mb-0"><a href="orders.php">Back</a></p>
            <a href="invoice.php?invoice=<?php echo $orid ?>" class="btn btn-outline-info mt-4" dowload="invoice.php?invoice=<?php echo $orid ?>" target="_blank">Download Invoice</a>
          </div>
          <div class="card-body p-4">
            <?php 
            $amt_vat = 0;
            while ($row = mysqli_fetch_assoc($order_items)){
              $amt_vat = $amt_vat + $row['price_num'];
             ?>
             <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
              <p class="small text-muted mb-0">Delivery Date : <?php echo $row['delivered']?></p>
            </div>
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <img src="product/<?php echo $row['image'] ?>" alt="Phone" width="100" height="100" class="rounded-circle">
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0"><?php echo $row['item_name']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Color:
                    <svg height=30 width=30>
                      <circle cx=15 cy=13 r=10 stroke=black stroke-width=3 fill=<?php echo $row['colors']  ?> />
                    </svg>
                    </p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Size: <?php echo $row['size']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Qty: <?php echo $row['quantity'] ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><?php echo $row['price_num']." ₹" ?></p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                <div class="row d-flex align-items-center">
                  <div class="col-md-2">
                    <p class="text-muted mb-0 small"><a href="delete_items.php?cancel_items=<?php echo $row['item_ref_id'] ?>&order_id=<?php echo $row['order_id'] ?>&price=<?php echo $row['price_num'] ?>&qty=<?php echo $row['quantity'] ?>" class="btn btn-outline-warning"><i class="fas fa-trash"></i></a></p>
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
          $amt_vat;
          $gst = 0;
          $order_shipped = 0;
          $gst = ($amt_vat*18)/100;
          $tot = $amt_vat + $gst;
          if ($tot>1500) {
             $order_shipped  = "Free";
             $order_totals = ($amt_vat+$gst-$coupon_value);
           }else{
            $order_shipped = 70;
            $order_totals = ($amt_vat+$gst+$shipped-$coupon_value);
           }
          ?>
            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total :</span> <?php echo round($amt_vat)." ₹" ?></p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0 text-uppercase">Invoice Number : <?php echo $Invoice ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> <?php echo "+ ".round($gst) ?></p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Total Items : <?php echo $odc ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> <?php echo "+".$order_shipped ?></p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0"></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Coupon value :</span> <?php echo " - ".$coupon_value ?></p>
            </div>
            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0"></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total pay :</span> <?php echo round($order_totals)." ₹" ?></p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5" style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total paid : <span class="h2 mb-0 ms-2"><?php echo round($order_totals)." ₹" ?></span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}
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