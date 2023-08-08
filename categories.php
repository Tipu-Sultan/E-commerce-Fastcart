          <?php 
          @$topitem = "";
          include 'themancode.php';
          if(isset($_POST['men']) || isset($_POST['women']) || isset($_POST['elctronics']) || isset($_POST['price']))
          {
            @$men = $_POST['men'];
            @$price = $_POST['price'];
            @$women = $_POST['women'];
            @$electro = $_POST['elctronics'];
          $topitem = mysqli_query($con,"SELECT * FROM items where type='$men' or type='$women' or type='$electro' or price<='$price'");

          while(@$top = mysqli_fetch_array(@$topitem)){
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
                        <h5><span class="badge bg-primary ms-2">New</span></h5>
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
                  <p><?php echo $top['price'] ." ₹"?></p>
              
                </div>
              </div>
            </div>
            <?php
          }
        }
          ?>
