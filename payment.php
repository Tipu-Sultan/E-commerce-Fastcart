<?php 
require('nav.php'); 
if (!isset($_SESSION['user_id'])) {
   ?>
     <script type="text/javascript">
       window.location.href = "index.php";
     </script>
     <?php
 }

if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];
    }else{
    $coupon_id = '';
    $coupon_str = '';
    $coupon_value = '';
    $cart_value = '';
    }

    $card_data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM card_data WHERE uid='$user_id'"));

?>

<section
  class="p-4 p-md-5 mt-4"
  style="
    background-image: url(https://mdbcdn.b-cdn.net/img/Photos/Others/background3.webp);
  "
>
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-5">
      <div class="card rounded-3">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <h3>THEMANCODE</h3>
            <h6>Payment</h6>
          </div>

            <div
              class="px-3 py-4 border border-primary border-2 rounded mt-4 d-flex justify-content-between"
            >
              <div class="d-flex flex-row align-items-center">
                <img src="https://i.imgur.com/S17BrTx.webp" class="rounded" width="60" />
                <div class="d-flex flex-column ms-4">
                  <span class="h5 mb-1">Total pay amount</span>
                  <span class="small text-muted">Total items : <?php echo $total_cart ?></span>
                </div>
              </div>
              <div class="d-flex flex-row align-items-center">
                <span class="h2 mx-1 mb-0">
                  <?php
                  if (isset($_SESSION['COUPON_ID'])) {
                    echo $cart_value;
                  }else{
                 echo $total_vat ;
                 $_SESSION['total_vat'] = $total_vat;
               }
                  ?></span>
                <span class="text-muted font-weight-bold mt-2"> ₹</span>
              </div>
            </div>
            <form id="confirm_order" name="confirm_order">
              <div class="form-outline mt-4">
              <input
                type="text"
                id="formControlLgXsd"
                class="form-control form-control-lg"
                name="number"
                id="number"
                value="<?php echo $mobile ?>"
                require=""
              />
              <input
                      type="text"
                      class="form-control form-control-lg"
                      name="type"
                      id="type"
                      value="payRequestforCod"
                      hidden=""
                    />
              <label class="form-label" for="formControlLgXsd">Mobile number</label>
            </div>

            <div class="form-check mt-3">
               <input class="form-check-input mb-4" type="radio" name="cod" id="cod" value="COD" />
               <label class="form-check-label" for="flexRadioDefault1">COD</label>
            </div>

           <!--  card section -->      
            <button id="place_order" class="btn btn-success btn-lg btn-block" name="submit">Place order</button>
            <p class="text-center text-danger" id="empty"></p>
          </form>
          <div>
            <h5 class="text-center mt-3">Pay through online mode or UPI</h5>
          </div>
          <div class="form-check mt-3 mb-3">
               <a href="http://localhost/fastcart/razorpay/razorpay/index.php" class="btn btn-outline-primary"><img src="images/razorpay.png" width="96" height="21"></a>
          </div>
          <form method="post" id="card_payment">
          <div class="form-check">
            <h5>Add your card</h5>
               <div class="row">
                <div class="col-lg-12">
                   <div class="form-outline">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      name="card_holder"
                      id="card_holder"
                      value="<?php echo @$card_data['card_holder'] ?>"
                    />
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      name="type"
                      id="type"
                      value="payRequestforCard"
                      hidden=""
                    />
                    <label class="form-label" for="formControlLgXsdcard">Card holder name</label>
                  </div>
                 </div>
                 <div class="col-lg-12 mt-2">
                   <div class="form-outline">
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      name="card_number"
                      id="card_number"
                      onkeyup="cardverify(this)"
                      maxlength="16"
                      value="<?php echo @$card_data['card_number'] ?>"
                    />
                    <label class="form-label" for="formControlLgXsdcard">Enter card number</label>
                  </div>
                  <div id="card_msg">
                    
                  </div>
                 </div>
               </div>

               <div class="row mt-2">
                 <div class="col-lg-4">
                   <div class="form-outline">
                    <input
                      type="password"
                      class="form-control form-control-lg"
                      name="cvv"
                      id="cvv"
                      placeholder="CVV"
                      maxlength="3"
                      value="<?php echo @$card_data['cvv'] ?>"
                    />
                  </div>
                 </div>
                 <div class="col-lg-8">
                   <div class="form-outline">
                    <input
                      type="tel"
                      class="form-control form-control-lg"
                      name="expiry"
                      id="expiry"
                      placeholder="MM / YY"
                      maxlength="5"
                      autocomplete="expiry"
                      value="<?php echo @$card_data['expiry'] ?>"
                    />
                  </div>
                  <!-- <div id="expirymsg">
                    
                  </div> -->
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-lg-12">
                   <div class="form-outline">
                    <input
                      type="email"
                      class="form-control form-control-lg"
                      name="email"
                      id="email"
                      placeholder="Email"
                      value="<?php echo @$card_data['email'] ?>"
                    />
                  </div>
                  <button id="upi_btn" class="btn btn-info btn-lg btn-block mt-3" name="submit">proceed your payment</button>
                 </div>
               </div>
          </div>
          </form>

          <div class="form-check mt-3">
               <a href="upi.php" class="btn btn-outline-primary"><img src="images/upi.png" width="110" height="21"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
  jQuery('#confirm_order').on('submit',function(e){
    $("#place_order").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Redirecting...</span>");
    jQuery('#place_order').attr('disabled',true);
    jQuery.ajax({
      url : 'thanks.php',
      type : 'post',
      data:jQuery('#confirm_order').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.redirect =='yes'){
        window.location = 'orders.php?ord_msg='+obj.ord_msg;
        jQuery('#place_order').attr('disabled',false);
        }else if(obj.redirect =='no'){
          jQuery('#succ_msg').html('Not inserted');
          jQuery('#confirm_order')[0].reset();
          jQuery('#place_order').html('retry');
        jQuery('#place_order').attr('disabled',false);
        }
      }
    });


  e.preventDefault();
  });
</script>

<script type="text/javascript">
  jQuery('#card_payment').on('submit',function(e){
    $("#upi_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Requesting...</span>");
    jQuery('#upi_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.redirect == 'yes'){
          window.location = 'otp.php';
        }else if(obj.redirect == 'no'){
          jQuery('#login_msg').html(obj.msg);
          jQuery('#upi_btn').html('Retry');
        jQuery('#upi_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>

<script type="text/javascript">
    function cardverify() {
        var val = document.getElementById('card_number').value;
        if (val.length==0) {
    document.getElementById("card_msg").innerHTML="";
    document.getElementById("card_msg").style.border="0px";
    return;
  }
        if(val.length<14 || val.length>16 || val.length == 15) {
            document.getElementById('card_msg').innerHTML = "<p class='text-danger'>Enter vaild 14 or 16 digits card number </p>";
        }
        else if(val.length == 14 || val.length == 16 ){
             document.getElementById("card_msg").innerHTML="<p class='text-success'>Vaild</p>";
        }
    }

var expDate = document.getElementById('expiry');
expDate.onkeyup = function (e) {
    if (this.value == this.lastValue) return;
    var caretPosition = this.selectionStart;
    var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
    var parts = [];
    
    for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
        parts.push(sanitizedValue.substring(i, i + 2));
    }
    
    for (var i = caretPosition - 1; i >= 0; i--) {
        var c = this.value[i];
        if (c < '0' || c > '9') {
            caretPosition--;
        }
    }
    caretPosition += Math.floor(caretPosition / 2);
    
    this.value = this.lastValue = parts.join('/');
    this.selectionStart = this.selectionEnd = caretPosition;
}

</script>



