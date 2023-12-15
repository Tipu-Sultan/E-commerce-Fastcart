<?php 
include 'link.php';
include 'cart_count.php';
if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
 }
 ?>

 <?php 
sleep(2);
if (isset($_SESSION['user_id']) && isset($_GET['txnId'])) {
$uid = $_SESSION['user_id'];

if(isset($_GET['order_id'])){
    $txnid = $_GET['txnId'];
    $orderid  = $_GET['order_id'];
    $order_update = mysqli_query($con,"update confirm set txn_id='$txnid',status='confirmed' where user_id='$uid' and order_id='$orderid' ");
}else{
$txn_id =  mysqli_real_escape_string($con,$_GET['txnId']);

$payment_count = mysqli_num_rows(mysqli_query($con,"select * from confirm  where txn_id='$txn_id'"));
if($payment_count>0)
{

}
else
{
date_default_timezone_set("Asia/Calcutta");
$order_id = date('Ymdhisa').bin2hex(random_bytes(2));
$qty_update = mysqli_query($con,"update payment set order_id='$order_id' where payment_id='$txn_id'");
$delivered = date("Y/m/d", strtotime(' +3 day'));

$order_update = mysqli_query($con,"update order_items set order_id='$order_id', cod='razorpay',delivered='$delivered',processed='10',status='confirmed' where user_id='$uid' and status='added_in_cart' ");
$traid = $_SESSION['new_txn'];
$succes = mysqli_query($con,"update payment set order_id='$order_id', payment_status='complete',payment_id='$traid' where id='".$_SESSION['OID']."'");
   // for confirmed

$cart_data = mysqli_query($con,"select * from order_items where order_id='$order_id' and status='confirmed' ");
$count_cart = mysqli_num_rows($cart_data);
$data = mysqli_fetch_array($cart_data);

$order_totals;
$email = $data['email'];
$username = $data['username'];
$address = $data['address'];
$zip = $data['zip'];
$cod = $data['cod'];
$number = $_SESSION['mobile'];
$image = $data['image'];
if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];

    $html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dynamic Invoice Generator</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
  <style>
  * {
  margin: 0;
  padding: 0;
}

body {
  font-family: roboto;
  background: white;
}

.material-icons {
  cursor: pointer;
}

.invoice-container {
  margin: auto;
  padding: 0px 20px;
}

.invoice-header {
  display: flex;
  padding: 70px 0%;
  width: 100%;
}

.title {
  font-size: 18px;
  letter-spacing: 3px;
  color: rgb(66, 66, 66);
}

.date {
  padding: 5px 0px;
  font-size: 14px;
  letter-spacing: 3px;
  color: rgb(156, 156, 156);
}

.invoice-number {
  font-size: 17px;
  letter-spacing: 2px;
  color: rgb(156, 156, 156);
}

.space {
  width: 50%;
}

table {
  table-layout: auto;
  width: 100%;
}
table, th, td {
  border-collapse: collapse;
}

th {
  padding: 10px 0px;
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
  font-weight: 400;
  font-size: 13px;
  letter-spacing: 2px;
  color: gray;
  text-align: left;

}

td {
  padding: 10px 0px;
  border-bottom: 0.5px solid rgb(226, 226, 226);
  text-align: left;
}

.dashed {
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
}

.total {
  font-weight: 800;
  font-size: 20px !important;
  color: black;
}

input[type=number] {
  text-align: center ;
  max-width: 50px;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text] {
  max-width: 170px;
  text-align: left;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input[type=number]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
/* Firefox */
input[type=number] {
-moz-appearance: textfield;
}

.float{
  width:40px;
  height:40px;
  background-color:#FF1D89;
  color:#FFF;
  border-radius:100%;
  text-align:center;
  box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.048),
0 6.7px 5.3px rgba(0, 0, 0, 0.069),
0 12.5px 10px rgba(0, 0, 0, 0.085),
0 22.3px 17.9px rgba(0, 0, 0, 0.101),
0 41.8px 33.4px rgba(0, 0, 0, 0.122),
0 100px 80px rgba(0, 0, 0, 0.17);
}

.float:hover {
  background-color:#ff057e;
}

.plus{
  margin-top:10px;
}

#sum {
  text-align: right;
  width: 100%;
}

#sum input[type=text] {
  width: 100%;
  font-size: 33px !important;
  color: black;
  text-align: right !important;

}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  body {
      background: lemonchiffon;
  }
  .invoice-container {
      border: solid 1px gray;
      width: 60%;
      margin: 50px auto;
      padding: 40px;
      padding-bottom: 100px;
      border-radius: 5px;
      background: white;
      box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.02),
0 6.7px 5.3px rgba(0, 0, 0, 0.028),
0 12.5px 10px rgba(0, 0, 0, 0.035),
0 22.3px 17.9px rgba(0, 0, 0, 0.042),
0 41.8px 33.4px rgba(0, 0, 0, 0.05),
0 100px 80px rgba(0, 0, 0, 0.07);
  }

  .title-date {
      width: 20%;
  }
  .invoice-number {
      width: 20%;
  }
  .space {
      width: 80%;
  }
}
  </style>
    <div class="invoice-container">
      <div class="invoice-header">
          <div class="title-date">
              <h2 class="title">INVOICE</h2>
              <p class="date">01/12/20</p>
          </div>
          <div class="space"></div>
          <p class="invoice-number">#08 279</p>
      </div>
      <div class="invoice-body">
          <table>
              <thead>
                  <th style="padding-left:12px;">PRODUCT</th>
                  <th>UNIT</th>
                  <th>PRICE</th>
                  <th>AMOUNT</th>
                  <th style="text-align: right;">ACTION</th>
              </thead>

              <tbody id="table-body">
              <tr class="single-row">
                  <td><input type="text" placeholder="Product name" class="product left"></td>
                  <td><input type="number" placeholder="0" name="unit" class="unit" id="unit" onkeyup="getInput()"></td>
                  <td><input type="number" placeholder="0" name="price" class="price" id="price" onkeyup="getInput()"></td>
                  <td><input type="number" placeholder="0" name="amount" class="amount" id="amount" disabled></td>
                  <td style="text-align: right;"><span class="material-icons">delete_outline</span></td>
              </tr>

              <tr style="padding-left: 20px">
                  <td class="dashed "><div class="float">
                      <a href="#" class="float" id="add-row">
                          <span class="material-icons plus">add</span>
                      </a>
                  </div>
              </td>
                  <td class="dashed"></td>
                  <td class="dashed"></td>
                  <td class="dashed"></td>
                  <td class="dashed"></td>
              </tr>
          </tbody>
          </table>
          <div id="sum"><input type="text" placeholder="0.00" name="total" class="total" id="total" disabled></div>

      </div>
  </div>
    <script>
    const tBody = document.getElementById("table-body");

addNewRow =()=> {
    const row = document.createElement("tr");
    row.className = "single-row";
    row.innerHTML = `<td><input type="text" placeholder="Product name" class="product" id="product"></td>
                    <td><input type="number" placeholder="0" name="unit" class="unit" id="unit" onkeyup="getInput()"></td>
                    <td><input type="number" placeholder="0" name="price" class="price" id="price" onkeyup="getInput()"></td>
                    <td><input type="number" placeholder="0" name="amount" class="amount" id="amount" disabled></td>
                    <td style="text-align: right;"><span class="material-icons" action="delete">delete_outline</span></td>`

    tBody.insertBefore(row, tBody.lastElementChild.previousSibling);
}

document.getElementById("add-row").addEventListener("click", (e)=> {
    e.preventDefault();
    addNewRow();
});

//GET INPUTS, MULTIPLY AND GET THE ITEM PRICE
getInput =()=> {
    var rows = document.querySelectorAll("tr.single-row");
    rows.forEach((currentRow) => {
        var unit = currentRow.querySelector("#unit").value;
        var price = currentRow.querySelector("#price").value;

        amount = unit * price;
        currentRow.querySelector("#amount").value = amount;
        overallSum();

    })
};

//Get the overall sum/Total
overallSum =()=> {
    var arr = document.getElementsByName("amount");
    var total = 0;
    for(var i = 0; i < arr.length; i++) {
        if(arr[i].value) {
            total += +arr[i].value;
        }
        document.getElementById("total").value = total;
    }
}

//Delete row from the table
tBody.addEventListener("click", (e)=>{
    let el = e.target;
    const deleteROW = e.target.getAttribute("action");
    if(deleteROW == "delete") {
        delRow(el);
        overallSum();
    }
})

//Target row and remove from DOM;
delRow =(el)=> {
    el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
}
    </script>
  </body>
</html>';

   include('sendmail.php');
  if($mail->send()){

    $confirms = mysqli_query($con,"insert into confirm(order_id,txn_id,user_id,username,email,number,address,price,total_item,image,coupon_id,coupon_value,coupon_code,cod,zip,status,date)values('$order_id','$txn_id','$uid','$username','$email','$number','$address',$cart_value,$total_cart,'$image',$coupon_id,'$coupon_value','$coupon_str','$zip','$cod','pending','$delivered')");

      $item_fetch = mysqli_query($con, "select * from order_items where order_id='$order_id'");
      while($items = mysqli_fetch_array($item_fetch))
      {
      $itemid = $items['item_id'];
      $qty = $items['quantity'];
      $qty_update = mysqli_query($con,"update items set qty=qty-$qty where id=$itemid");
      }

      echo '<div class="container"><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong></strong><span style="font-weight:bold;">An order confirmation mail has send to you</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div></div>';
  } else {
     echo '<div class="container"><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong></strong><span style="font-weight:bold;">Email sending Failed..</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div></div>';
 }

    }else{

$html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$username.'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td>Your order placed successfully ORDEER NO. :'.$order_id.'</td>
                    </tr>
                    <tr>
                      <td>Amount :</td>
                      <td><h5>Your total amount : '.$order_totals.'</h5></td>
                    </tr>
                    <tr>
                      <td>Link :</td>
                      <td><h5><strong><a href="http://localhost/fastcart/invoice.php?invoice='.$order_id.'">Click here to download invoice</a></strong></h5></td>
                    </tr>
                    <tr>
                      <td>Contact Us :</td>
                      <td>for further problems please contact this number 9919408817 Thank You </td>
                    </tr>
                  </table>                        
             </div>

        </div>
      </div>
    </div>
  </div>';

 include('sendmail.php');
   if($mail->send()){

    $confirm = mysqli_query($con,"insert into confirm(order_id,txn_id,user_id,username,email,number,address,price,total_item,image,cod,zip,status,date)values('$order_id','$txn_id','$uid','$username','$email','$number','$address',$order_totals,$total_cart,'$image','$zip','$cod','pending','$delivered')");

      $item_fetch = mysqli_query($con, "select * from order_items where order_id='$order_id'");
      while($items = mysqli_fetch_array($item_fetch))
      {
      $itemid = $items['item_id'];
      $qty = $items['quantity'];
      $qty_update = mysqli_query($con,"update items set qty=qty-$qty where id=$itemid");
      }

      echo '<div class="container"><div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong></strong><span style="font-weight:bold;">An order confirmation mail has send to you</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div></div>';
    }
    }
$notify = mysqli_query($con,"insert into notify (user_id,message)values('$uid','Hi $users you order new product')");

}
}
}
 ?>

 <?php 
if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
}
 ?>


 <?php
 if (isset($_GET['txnId'])) {
    $tid  =  $_GET['txnId'];
    $pay  = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM payment where payment_id = '$tid'"));
    if($pay==true){
     ?>
<div class="container mt-2">
<div class="card justify-content-center">
    <div class="card-header bg-dark">
        <h3 class="text-success">Transaction successfull</h3>
    </div>

<div class="card-body">
    <div class="row">
        <div class="col-lg-6 col-6">
            <table class="table">
              <tr><th>NAME </th><td><?php echo $pay['name'] ?></td></tr>
              <tr><th>ORDER ID </th><td><?php echo $pay['order_id'] ?></td></tr>
              <tr><th>AMOUNT </th><td><?php echo $pay['amount'] ?></td></tr>
              <tr><th>TXN ID </th><td><?php echo $pay['payment_id'] ?></td></tr>
              <tr><th>DATE|TIME </th><td><?php echo $pay['added_on'] ?></td></tr>
              <tr><th>STATUS </th><td><span class="text-success"><?php echo $pay['payment_status'] ?> <i class="fa fa-check" aria-hidden="true"></i></span></td></tr>
            </table>
            <p><a href="http://localhost/fastcart/orders.php" class="btn btn-success btn-sm">Go to order page</a></p>

        </div>
        <div class="col-lg-6 col-6">
            <img src="success.gif" class="tex-success">
        </div>

        <ul class="text-danger">
           Importance :
           <li>If you have any issue with order or product then mail us on teepukhan729@gmail.com</li>
           <li>** In case your payment has been deducted and transaction was failed, Kindly wait for 3 working days</li>
        </ul>

        <div class="sizes mt-3">
            <h6 class="text-uppercase text-secondary">Share your experience to us</h6>
                                
            <label class="radio">
            <input onclick="feed('EXCELLENT')" type="radio" name="feed" value="EXCELLENT" >
            <span>EXCELLENT</span>
            </label>

            <label class="radio">
            <input onclick="feed('HAPPY')" type="radio" name="feed" value="HAPPY" >
            <span>HAPPY</span>
            </label>

            <label class="radio">
            <input onclick="feed('OK')" type="radio" name="feed" value="OK" >
            <span>OK</span>
            </label>

            <label class="radio">
            <input onclick="feed('UNHAPPY')" type="radio" name="feed" value="UNHAPPY" >
            <span>UNHAPPY</span>
            </label>

            <label class="radio">
            <input onclick="feed('WROST')" type="radio" name="feed" value="WROST" >
            <span>WROST</span>
            </label>

            <input type="text" name="sid" id="pid" value="<?php echo $tid ?>" hidden> 
            <p id="feedmsg" class="mt-3 text-success"></p>      
        </div>
    </div>
</div>
</div>
     <?php
 }
 else
 {
    echo '<div class="card-header">
        <h3 class="text-danger">Something went wrong</h3>
        <a href="http://localhost/fastcart/cart.php">back cart page</a>
    </div>';
 }
 }
 ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  function feed(feed){
        jQuery.ajax({
      url:'feed.php',
      type:'post',
      data :{
        type:'feed',
        fid:feed,
        pid: $("#pid").val(),
        },
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.error=="yes" || obj.error=="no"){
            $("#feedmsg").html(obj.msg);
        }
      }
    });
  }

  
</script>
