<!-- owl product section start -->
<section style="background-color: #eee;">
<div class="owl-carousel owl-theme bg-grey">
  <?php 
  $carousel  = mysqli_query($con,"select * from  trending_item");
  while($top = mysqli_fetch_array($carousel)){
  ?>
    <div class="item mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
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
                  <a href="product_details.php?slug-id=<?php echo $top['slug'] ?>&type=<?php echo $top['type'] ?>">
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
                <div class="card-body text-center">
                  <!-- <marquee behavior="alternate" scrollamount="3">   -->
                  <a href="" class="text-reset " style="max-width: 150px">
                    <h5 class="card-title mb-3"><?php echo $top['name']?></h5>
                  </a>
                  <!-- </marquee>  -->
                  <p class="text-center"><?php echo $top['price'] ." ₹"?></p>
                  <p>
                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="far fa-star fa-sm"></i></li>
      </ul>
                  </p>
                  <p class="text-center"><a href="javascript:void(0)" class="btn btn-sm btn-info" data-mdb-toggle="modal" data-mdb-target="#myModalknowmore" onclick="knowmore(<?php echo $top['id'] ?>)">Know More</a></p>
              
                </div>
              </div>
            </div>
    </div>
    <?php
  }
  ?>
</div>
  <div class="mt-4">
    <center>
      <button  class='play btn btn-success btn-sm'><i class="fas fa-play"></i></button>
    <button  class='stop btn btn-danger btn-sm'><i class="fas fa-pause"></i></button>
    </center>
  </div>
 </section> 
<!-- owl product section end -->
<!-- product section start -->
<?php require 'add_in_cart.php'; ?>
    <section style="background-color: #eee;">
        <div class="text-center container py-5">
          <h4 class="mt-4 mb-5"><strong>Latest And Trending</strong></h4>
      
          <div class="row">

          <?php 
          include 'themancode.php';
          $topitem = mysqli_query($con,"SELECT * FROM items order by name asc");
          while($top = mysqli_fetch_assoc($topitem)){
            ?>
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
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
                    class="img-fluid"
                  />
                  <a href="product_details.php?slug-id=<?php echo $top['slug'] ?>&type=<?php echo $top['type'] ?>">
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
                <div class="card-body text-center">
                  <!-- <marquee behavior="alternate" scrollamount="3">   -->
                  <a href="" class="text-reset " >
                    <h5 ><?php echo $top['name']?></h5>
                  </a>
                  <!-- </marquee>  -->
                  <p><?php echo $top['price'] ." ₹"?></p>
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
            <!-- second row -->
          </div>
        </div>
      </section>
<div class="modal fade" id="myModalknowmore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-center text-white" id="exampleModalLabel">KNOW MORE</h5>
        <button type="button" class="btn-close bg-light" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
            <tr>
                <td id="product_img"></td>
                <td id="price"></td>
                <td id="k_name"></td>
            </tr>
          </table> 
          <div id="botchatbox">
      
          </div>
            
          <div class="form-group px-3 mt-2" id="botInput">
            <input class="form-control" id="usertextInput" rows="5" placeholder="Type your Query"/>
          </div>           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      <script type="text/javascript">
  function knowmore(id){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=knowmore&id='+id,
      success:function(result){
        var obj = jQuery.parseJSON(result);
              if(obj.is_error=='no'){
            jQuery('#product_img').html('<img src="product/'+obj.img+'"  class="img-responsive img-fluid rounded mb-2" width="200" height="200">');
            jQuery('#price').html(obj.price);
            jQuery('#k_name').html(obj.name);

        }
      }
    });
  }
  </script>

<script>

    function getChatResponse() {
      var rawText = $("#usertextInput").val();
      var userHtml = '<div class="d-flex flex-row p-3"><img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30"><div class="chat ml-2 p-3">'+rawText+'</div></div>';
      $("#usertextInput").val("");
      $("#botchatbox").append(userHtml);
      $("#generate").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Generating...</span>");
      jQuery('#wishlist').attr('disabled',true);
      document
        .getElementById("botInput")
        .scrollIntoView({ block: "start", behavior: "smooth" });

        jQuery.ajax({
      url:'send_data.php',
      type:'post',
      data:
      {
        query:rawText,
        proID:<?php echo $_SESSION['proID'] ?>
      },
      success:function(result){
        var botHtml = '<div class="d-flex flex-row p-3"><div class="bg-white mr-2 p-3"><span class="text-muted">'+result+'</span></div><img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30"></div>';
        $("#botchatbox").append(botHtml);
        document
          .getElementById("botInput")
          .scrollIntoView({ block: "start", behavior: "smooth" });
          jQuery('#botchatbox').animate({scrollTop:1000000},800);
          jQuery('#generate').attr('disabled',false);
          $("#generate").html("submit");
      }
    });

      
    }
    $("#usertextInput").keypress(function(e) {
      if (e.which == 13) {
        var newCheck = $("#usertextInput").val();
        if(newCheck!='')
        {
        getChatResponse();
        jQuery('#botchatbox').animate({scrollTop:1000000},800);
        }
      }
    });


  </script>

      <!-- product section end -->
