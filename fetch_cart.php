 <?php
 session_start();
 include 'cart_cal.php';

 $Arrived = date("Y/m/d", strtotime(' +3 day'));
?>
<section class="h-100 gradient-custom">
        <div class="container py-5">
          <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h5 class="mb-0">Cart -  items</h5>
                </div>
                <?php 
                if (isset($_SESSION['user_id']) || isset($_SESSION['client_id'])) {
              if ($count_cart_items>0) {
               ?>
                  
                <div class="card-body">
                  <!-- Single item -->
                  <div class="row">
                    <?php 
                    $uid = $_SESSION['user_id'];
                   $cartitems = mysqli_query($con,"SELECT * FROM order_items where user_id='$uid' and status='added_in_cart' ");
                   $amount = 0;
                    while($cart = mysqli_fetch_array($cartitems)){
                      $amount = $amount + $cart['price_num'];
                      ?>
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                      <!-- Image -->
                      <div class="bg-image hover-overlay hover-zoom ripple rounded mb-3" data-mdb-ripple-color="light">
                        <img src="product/<?php echo $cart['image']?>"
                          class="rounded-circle" alt="<?php echo $cart['image']?>" 
                          height="150"
                          width="150"
                          />
                        <a href="product_details.php?slug-id=<?php echo $cart['slug'] ?>&type=<?php echo $cart['type'] ?>">
                          <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                        </a>
                      </div>
                      <!-- Image -->
                    </div>
                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0 mt-2">
                      <!-- Data -->
                      <p><strong><?php echo $cart['item_name']?></strong></p>
                      <p>Color: <svg height=30 width=30>
                                      <circle cx=15 cy=13 r=10 stroke=black stroke-width=3 fill=<?php echo $cart['colors'] ?> />
                                    </svg></p>
                      <!-- end measures -->
                      <p>Size: <span><?php echo $cart['size']?></span></p>
                        <a href="#" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                        title="Remove item" id="remove_item" onclick="remove_item('<?php echo $cart['item_id'] ?>')">
                        <i class="fas fa-trash"></i></a>
            
                      <!-- <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                        title="Move to the wish list">
                        <i class="fas fa-heart"></i> -->
                      </button>
                      <!-- Data -->
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                      <!-- Quantity -->
                      <div class="d-flex mb-4" style="max-width: 300px">
                        <button class="btn btn-primary px-3 me-2"
                          onclick="minus_cart('<?php echo $cart['item_id'] ?>')" id="cart_minus" title="after clicking wait for 1 sec">
                          <i class="fas fa-minus" ></i>
                        </button>
      
                        <!-- <div class="form-outline">
                          <input id="form1" min="0" max="4" name="quantity" value="1" type="number" class="form-control" />
                          <label class="form-label" for="form1">Quantity</label>
                        </div> -->
      
                        <button class="btn btn-primary px-3 ms-2"
                          onclick="plus_cart('<?php echo $cart['item_id'] ?>')" id="cart_plus" title="after clicking wait for 1 sec">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <!-- Quantity -->
      
                      <!-- Price -->
                      <p class="text-start text-md-center">
                        <strong><?php echo $cart['price_num'] . " ₹" ?></strong>
                      </p>
                      
                      <!-- Price -->
                    </div>
                      <?php
                    }
                  $amount;

                  $gst = ($amount*18/100);
                      
                  if ($amount>1000) {
                  $shipped  = "Free";
                  $total_vat = ($amount+$gst);
                  }else{
                   $shipped = 70;
                   $total_vat = ($amount+$gst+$shipped);
                  }
                     ?>
                  </div>
                  <!-- Single item -->
      
                  <hr class="my-4" />
                </div>
              </div>
              <div class="card mb-4">
                <div class="card-body">
                  <p><strong>Expected shipping delivery</strong></p>
                  <p class="mb-0"><?php echo $Arrived ?> <span><a href="index.php">Continue shopping</a></span></p>
                </div>

              </div>
              <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                  <p><strong>We accept</strong></p>
                  <img class="me-2" width="90px" height="30px"
                    src="images/razorpay.png"
                    alt="Razorpay" />
                  
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h5 class="mb-2">Total Details</h5>
                  <h6>Total Items :<?php echo $total_cart ?></h6>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      Products
                      <span><?php echo $amount . " ₹"?></span>
                    </li>
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      GST 18%
                      <span><?php echo round($gst) . " ₹"?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                      Shipping
                      <span><?php echo $shipped . " ₹"?></span>
                    </li>
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                      <div>
                        <strong>Total amount</strong>
                        <strong>
                          <p class="mb-0">(including VAT)</p>
                        </strong>
                      </div>
                      <span><strong><?php echo round($total_vat) . " ₹" ;
                      ?></strong></span>
                    </li>
                  </ul>
               <a href="checkout.php" type="button" class="btn btn-primary btn-lg btn-block">
                    Go to checkout
                </a>

                       
               <?php
              }else{
                ?>
                <div class="d-flex justify-content-center border border-light p-5">

              <img src="images/flipkart.svg" class="img-fluid" alt="">

              </div>
                <p class="mt-2 text-center">Missing Cart items? <br><br><a href="index.php" class="btn btn-outline-warning">Continue shopping</a></p>
                <?php
              }
}else{
               ?>
               <div class="d-flex justify-content-center border border-light p-5">

              <img src="images/flipkart.svg" class="img-fluid" alt="">

              </div>
                <p class="mt-2 text-center">Login to see the items you added previously <br><br> <a href="#" class="btn btn-primary mx-2"  data-mdb-toggle="modal" data-mdb-target="#login">Login</a></p>
                <?php
}
               ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>