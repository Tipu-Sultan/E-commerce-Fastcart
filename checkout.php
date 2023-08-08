  <?php 
  include 'nav.php';
  if (!isset($_SESSION['user_id'])) {
     ?>
     <script type="text/javascript">
       window.location.href = "index.php";
     </script>
     <?php
    }
  include 'themancode.php';
$uid = $_SESSION['user_id'];
    if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
    }else{
    $coupon_id = '';
    $coupon_str = '';
    $coupon_value = '';
    $cart_value = '';
    }
  ?>
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout For TheManCode</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" method="post" name="checkout" id="checkout">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="username" class="form-control" name="username" value="<?php echo $users ?>" />
                            <label class="form-label" for="form3Example1c">Your Name</label>
                          </div>
                        </div>
                <!--Grid column-->
                <input
                      type="text"
                      class="form-control form-control-lg"
                      name="type"
                      id="type"
                      value="payRequestforCod"
                      hidden=""
                    />
              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="email" class="form-control" name="email" value="<?php echo $email ?>" />
                            <label class="form-label" for="form3Example1c">Your Email</label>
                          </div>
                        </div>

              <!--email-->
              <!--address-->
              <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-map fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="address" class="form-control" name="address" value="<?php echo $address ?>" />
                            <label class="form-label" for="form3Example1c">Your Addres</label>
                          </div>
                        </div>

              <!--address-2-->
              <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-map-marker fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="landmark" class="form-control" name="landmark" />
                            <label class="form-label" for="form3Example1c">Landmark Addres 2</label>
                          </div>
                        </div>

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">

                  <label for="country">States</label>
                  <select class="custom-select d-block w-100" id="state" name="state" onchange="mystate(this.value)" required>
                    <option value="">Choose...</option>
                <?php  
                $country = mysqli_query($con,"SELECT * FROM states");
                while ($cid = mysqli_fetch_array($country)){
                  ?>
                    <option value="<?php echo $cid['id'].$cid['name'] ?>"><?php echo $cid['name'] ?></option>
                  <?php
                }
                ?>
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>

                </div>
                <!--Grid column-->

          

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="city">City</label>
                  <select class="custom-select d-block w-100" id="city" name="city" required>
                    <option value="">Choose...</option>
                  </select>
                  <div class="invalid-feedback">
                    Please provide a valid state.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" id="zip" name="zip" placeholder="" maxlength="6" onkeyup="geoloc(this.value)" required>
                  <div id="geolocid"></div>
                  <div class="invalid-feedback">
                    
                  </div>

                </div>
                <div>
                  <input type="radio" name="pin_add" value="<?php echo $address ?>"/>
                  <span><?php echo $address; ?></span>
                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->
              <hr class="mb-4">
              <?php 
              if ($total_cart>0) {
               ?>
               <button class="btn btn-primary btn-lg btn-block" name="submit" id="checkout_btn">Continue to checkout</button>
               <?php
              }
               ?>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $total_cart ?></span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <?php 
            $uid = $_SESSION['user_id'];
           $cart_item = mysqli_query($con,"SELECT * FROM order_items where user_id='$uid' and status='added_in_cart' ");
            while($list = mysqli_fetch_array($cart_item)){
              ?>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <span><img src="product/<?php echo $list['image'] ?>" height="80" width="60" class="img-responsive rounded"/></span>
              <div>
                <h6 class="my-0"><?php echo $list['item_name'] ?></h6>
                <small class="text-muted"><?php echo $list['brief_info'] ?></small>
              </div>
              <span class="text-muted"><?php echo $list['price_num']." ₹" ?></span>
            </li>
              <?php
            }

             ?>
             <hr>
            <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      Products
                      <span><?php echo $amount . " ₹"?></span>
                    </li>
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      GST
                      <span><?php echo round($gst) . " ₹"?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                      Shipping
                      <span><?php echo $shipped . " ₹"?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                      Coupon Value
                      <span id="minus_price"></span>
                    </li>
                    <style type="text/css">
                      #minus_price{
                        display: none;
                      }
                    </style>
                    <li
                      class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                      <div>
                        <strong>Total amount</strong>
                        <strong>
                          <p class="mb-0">(including VAT)</p>
                        </strong>
                      </div>
                      <span><strong id="order_total_price">
                      <?php
                      
                        echo $total_vat. " ₹" ;
                      
                      ?></strong></span>
                    </li>
          </ul>
          <!-- Cart -->
          <!-- total -->
          <!-- total -->
          <!-- Promo code -->
          <div>
            <p class="text-info"><?php echo $cp ?></p>
          </div>
          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code" aria-label="Recipient's username" aria-describedby="basic-addon2" id="coupon_str" name="coupon_str">
              <div class="input-group-append">
                <button id="coupon_btn" class="btn btn-secondary btn-md waves-effect m-0" type="button" value="Apply Coupon" onclick="set_coupon()"/>Redeem</button>
              </div>
            </div>


<div id="coupon_result">
  
</div>
<div id="coupon_price">

</div>
          </form>
          <!-- Promo code -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
  jQuery('#checkout').on('submit',function(e){
    $("#checkout_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Redirecting...</span>");
    jQuery('#checkout_btn').attr('disabled',true);
    jQuery.ajax({
      url : 'redirect.php',
      type : 'post',
      data:jQuery('#checkout').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.redirect =='yes'){
        window.location = 'payment.php';
        jQuery('#checkout')[0].reset();
        jQuery('#checkout_btn').attr('disabled',false);
        }else{
          window.location = 'checkout.php';
        }
      }
    });
    e.preventDefault();
  });
</script>

 <script type="text/javascript">
  function mycountry(data) 
  {
    

    var req = new XMLHttpRequest();
    req.open("GET","get_state.php?datavalue="+data,true);
    req.send();
    req.onreadystatechange=function(){
      if(req.readyState==4 && req.status==200) {
    document.getElementById("state").innerHTML = req.responseText;
      }
    };
  }
</script>

 <script type="text/javascript">
  function mystate(data) 
  {
    

    var req = new XMLHttpRequest();
    req.open("GET","get_cities.php?datavalue="+data,true);
    req.send();
    req.onreadystatechange=function(){
      if(req.readyState==4 && req.status==200) {
    document.getElementById("city").innerHTML = req.responseText;
      }
    };
  }
</script>

<script>
      function set_coupon(){
        var coupon_str=jQuery('#coupon_str').val();
        if(coupon_str!=''){
          jQuery('#coupon_result').html('');
          jQuery.ajax({
            url:'set_coupon.php',
            type:'post',
            data:'coupon_str='+coupon_str,
            success:function(result){
              var data=jQuery.parseJSON(result);
              if(data.is_error=='yes'){
                jQuery('#minus_price').hide();
                jQuery('#coupon_result').html(data.dd);
                jQuery('#coupon_btn').attr('disabled',false);
              }
              if(data.is_error=='no'){
                // var  = data.result;
                jQuery('#minus_price').show();
                jQuery('#coupon_price').html(data.dd);
                jQuery('#order_total_price').html(data.result);
                 jQuery('#minus_price').html(data.minus_dd);
                 jQuery('#coupon_btn').attr('disabled',true);
              }
            }
          });
        }else{
          jQuery('#coupon_price').html('empty value not accepted');
        }
      }
    </script>

    <script type="text/javascript">
    function geoloc(str) {
        if (str.length==0) {
    document.getElementById("geolocid").innerHTML="";
    document.getElementById("geolocid").style.border="0px";
    return;
  }
        $.ajax({
            url:"tools.php",
            type: "POST",
            data :{search:str,type:'geoloc'},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#geolocid').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#geolocid').html(obj.msg);
                }
            }
        });
    }
</script>

<?php 
    if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
}
 ?>
  <!--Main layout-->
  <?php include 'footer.php';?>
