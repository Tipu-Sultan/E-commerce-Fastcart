<?php 
include 'nav.php';

 ?>
<?php include 'add_in_cart.php'; ?>
<br>
<br>

<?php
if (isset($_SESSION['user_id']) && isset($_GET['slug-id'])) {
include 'themancode.php';
$slug  = $_GET['slug-id'];
$slug_items = mysqli_query($con,"SELECT * FROM `items` WHERE slug='{$slug}'");
$pid = mysqli_fetch_assoc($slug_items);
if($slug == isset($pid['slug'])){
$slug_id = $pid['id'];
if (isset($_SESSION['user_id'])) {

$user_id=$_SESSION['user_id'];

$wishlist =mysqli_num_rows(mysqli_query($con,"select * from order_items where status='wishlist' and item_id={$slug_id} and user_id='$user_id' "));
}else{
    $cid=$_SESSION['user_id'];

$wishlist =mysqli_num_rows(mysqli_query($con,"select * from order_items where status='wishlist' and item_id={$slug_id} and user_id='$cid' "));
}
$gallery = mysqli_query($con,"select * from product_gallery where pid=$slug_id ");
$sizes = mysqli_query($con,"select * from sizes where item_id=$slug_id");
$color = mysqli_query($con,"select * from colors where item_id=$slug_id");



 ?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"><a href="product/<?php echo $pid['image'] ?>"> <img id="main-image" src="product/<?php echo $pid['image'] ?>" width="250" /></a> </div>
                            <div class="thumbnail text-center"> 
                                <?php 
                            while($gid = mysqli_fetch_array($gallery)){
                                ?>
                                <img onclick="change_image(this)" src="gallery/<?php echo $gid['p_image'] ?>" width="70">
                                <?php
                            }

                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1 fw-bold">PRODUCT INFO</span> </div> <a class="text-reset me-3" href="cart.php?cid=<?php echo $_SESSION['token'] ?>">
        <i class="fas fa-shopping-cart"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php echo $total_cart ?></span>
        </a>
                            </div>
                            <div class="mt-4 mb-3">
                                <h5 class="text-uppercase"><?php echo $pid['name'] ?></h5>
                                <div class="price d-flex flex-row align-items-center">
                                    <h5 class="act-price fw-bold"><?php echo $pid['price']." ₹" ?></h5>
                                </div>
                                <br>
                                <span class="act-price fw-bold"><?php if($pid['qty']>0){ echo $pid['qty']." Units available in stocks"; } ?></span>
                            </div>
                            <p class="about"><?php echo $pid['brief_info'] ?></p>
                            <?php 
                            if($pid['qty']>0)
                            {
                             ?>
                            <div class="sizes mt-3">
                                <h6 class="text-uppercase">Color</h6>
                                <?php 
                                while($cid = mysqli_fetch_array($color)){
                                 ?> 
                                <label class="radio">
                                <input onclick="color('<?php echo $cid['colors'] ?>')" type="radio" name="color" value="<?php echo $cid['colors'] ?>" checked=""/>

                                <input type="text" name="sid" id="id" value="<?php echo $slug_id ?>" hidden>
                                <span >
                                    <svg height=30 width=30>
                                      <circle cx=15 cy=13 r=10 stroke=black stroke-width=3 fill=<?php echo $cid['colors'] ?> />
                                    </svg>
                                </span>
                                </label>
                                <?php
                            }
                                ?>
                            </div>

                            <div class="sizes mt-1">
                                <h6 class="text-uppercase">Size/others</h6>
                                <?php 
                                while($sid = mysqli_fetch_array($sizes)){
                                 ?> 
                                <label class="radio">
                                <input onclick="sizes('<?php echo $sid['sizes'] ?>')" type="radio" name="sizes" value="<?php echo $sid['sizes'] ?>" checked="" />
                                <input type="text" name="sid" id="id" value="<?php echo $slug_id ?>" hidden>
                                <span><?php echo $sid['sizes'] ?></span>
                                </label>
                                <?php
                            }
                                ?>
                            </div>
                            <div class="cart mt-4 align-items-center">
                            <?php
              if(add_in_cart($slug_id)){
              echo '<p><a href="cart.php" type="button" class="btn btn-outline-secondary" disabled>Go to cart</a></p>';
              }else{
              ?>
              <a href="cart_add.php?item_id=<?php echo $slug_id ?>"><button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button></a>
              <?php 
              if ($wishlist>0) {
                  ?>
                  <button  class="btn btn-outline-dark" title="Already wishlist"><i class="fa fa-heart  pl-4 mx-2 text-danger" ></i></button>
                  <?php
              }else
              {
                ?>
                  
                  <button  class="btn btn-outline-dark" onclick="wishlist('<?php echo $slug_id ?>')" id="wishlist" title="Add to wishlist"><i class="fa fa-heart  pl-4 mx-2 " ></i></button>
                  <?php
              }
               ?> 
              <?php
              }
              ?> 
                    <br>
                    <br>
                     <label>Enter Delivery Pin</label>
                       <div class="d-flex flex-row align-items-center mt-2">
                          <i class="fa fa-map-marker fa-lg me-3 fa-fw" aria-hidden="true"></i>
                          <div class="form-group w-25">
                            <input type="text" class="form-control" id="pin" placeholder="Enter pin code" required="">
                          </div>
                          <button  class="btn btn-outline-dark mx-2" onclick="pin()" id="pin_btn" title="search"> <i class="fa fa-search  pl-4 mx-2 " ></i></button>
                        </div>
                        <p id="pinMsg"></p>

                        
                            </div>
                            <?php 
                        }else{
                            ?>
                            <div class="sizes mt-3">
                                <h4 class="text-uppercase">SOLD OUT</h4>
                                <img src="images/sold.png" width="120" height="120">
                            </div>
                            <?php
                        }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">


</style>
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button
        class="accordion-button"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#collapseOne"
        aria-expanded="true"
        aria-controls="collapseOne"
      >
        Check Product Reviews
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
      <div class="accordion-body">
        <div class="row">
            <div class="col-lg-6 col-sm-7 col align-items-end">
                <table class="table-hover">
                    <tr>
                        <td><img src="uploads/<?php echo $image ?>" width="50" height="50" class="img-responsive rounded-circle"></td>
                        <td>
                            <form method="post" id="reviews" class="mt-3">
                                <div class="mb-3">
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control" placeholder="Type message"
                                            aria-label="Recipient's username" id="reviews_data" />
                                    <input type="" id="img1" value="<?php echo $image ?>" hidden="">
                                    <input type="" id="userid" value="<?php echo $user_id ?>" hidden="">
                                    <button class="btn btn-warning" onclick="reviews_fn()" id="reviews_btn" type="button" >
                                            Add review
                                    </button>
                                </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <hr>
                    
                        <?php 
                             $res = mysqli_query($con,"select *  from product_review where pid='$slug_id' ORDER BY id DESC LIMIT 10");
                             while($get = mysqli_fetch_array($res))
                             {
                                 ?>
                        <tbody id="review_data" class="table-secondary">
                        <tr>
                        <td><img src="uploads/<?php echo $get['image'] ?>" width="30" height="30" class="img-responsive rounded-circle"></td>
                        <td>
                            <h6><?php echo $get['review'] ?></h6>  
                        </td>
                        </tr>
                        </tbody>
                        <?php
                        }

                            ?>
                
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>  
</div>


<div class="accordion mt-5" id="accordionExample2">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button
        class="accordion-button"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#collapseTwo"
        aria-expanded="true"
        aria-controls="collapseTwo"
      >
        Check Suggested Products
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
      <div class="accordion-body">
        <div class=" mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div>
                <div class="row">
                    <?php 
                    $type = $_GET['type'];
                    $topitem = mysqli_query($con,"SELECT * FROM items where type='$type' order by name asc");
                    while($top = mysqli_fetch_assoc($topitem)){
                    ?>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
              <div class="card">
                <div
                  class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                  data-mdb-ripple-color="light"
                >
                  <img
                    src="product/<?php echo $top['image']?>"
                    class="w-100"
                    width="200"
                    height="200"
                  />
                  <a href="product_details.php?pid=<?php echo $top['id'] ?>&slug-id=<?php echo $top['slug'] ?>&type=<?php echo $top['type'] ?>">

                    <div class="mask">
                      <div class="d-flex justify-content-start align-items-end h-100">
                        <h5><span class="badge bg-primary ms-2"><?php echo $top['type']?></span></h5>
                      </div>
                    </div>
                    <div class="hover-overlay">
                      <div
                        class="mask"
                        style="background-color: rgba(251, 251, 251, 0.15);"
                      ></div>
                    </div>
                  </a>
                </div>
                <div class="card-body">
                  <marquee behavior="alternate" scrollamount="3">  
                  <a href="" class="text-reset " style="max-width: 150px">
                    <h5 class="card-title mb-3"><?php echo $top['name']?></h5>
                  </a>
                  </marquee> 
                  <p class="text-center "><?php echo $top['price'] ." ₹"?></p>
                  <p>
                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="far fa-star fa-sm"></i></li>
      </ul>
                  </p>
              
                </div>
              </div>
            </div>
            <?php 
        }
             ?>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
  </div>
</div>

<?php
}else{
    echo "<h2 class='text-center'>SOMETHING WENT WRONG</h2>";
}
}else{
    echo "<h2 style='text-align: center;margin-top: 100px;'>Please login <a href='#' data-mdb-toggle='modal' data-mdb-target='#login'>click here</a></h2>";
}


?>


<?php include 'footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    function reviews_fn(){

        $("#reviews_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>adding...</span>");
    jQuery('#reviews_btn').attr('disabled',true);
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'reviews',
        reviews: $("#reviews_data").val(),
        img: $("#img1").val(), 
        uid: $("#userid").val(),
        pid:<?php echo $slug_id ?>,
        },
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.is_error=="no")
        {
            jQuery.ajax({
              url:'reviewdata.php',
              type:'post',
              data :{
                pid:<?php echo $slug_id ?>
                },
              success:function(result){
                jQuery('#review_data').html(result);
                jQuery('#reviews_btn').html('Add review');
                jQuery('#reviews_btn').attr('disabled',false);
                jQuery('#reviews')[0].reset();
              }
            });
            
        }
      }
    });
    }


    function pin(){
        $("#pin_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>pining...</span>");
    jQuery('#pin_btn').attr('disabled',true);
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'pin',
        zip: $("#pin").val(),
        },
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.error=="no")
        {
            jQuery('#pinMsg').html(obj.msg);
            jQuery('#pin_btn').html('<i class="fa fa-search  pl-4 mx-2 " ></i>');
            jQuery('#pin_btn').attr('disabled',false);
        }
      }
    });
  }
  function sizes(size){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'sizes',
        sid:size,
        pid: $("#id").val(),
        },
      success:function(result){
        

      }
    });
  }

  function color(color){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'color',
        cid:color,
        pid: $("#id").val(),
        },
      success:function(result){
        

      }
    });
  }
</script>
<script type="text/javascript">
    function wishlist(id){
        $("#wishlist").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>wishting...</span>");
    jQuery('#wishlist').attr('disabled',true);
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=wishlist&pid='+id,
      success:function(result){
        var obj = jQuery.parseJSON(result);
              if(obj.error=='no'){
            jQuery('#wishlist').html('<i class="fa fa-heart pl-4 mx-2 text-danger"></i>');
            jQuery('#wishlist').attr('disabled',true);
            
        }else if(obj.error=='yes'){
            jQuery('#wishlist').html(obj.msg);
            
        }
      }
    });
  }
</script>