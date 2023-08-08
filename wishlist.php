	<?php 
	include 'nav.php';
if (!isset($_SESSION['user_id'])){
	?>
	<script>
		window.location.href="index.php";
	</script>
	<?php
     }

	?>
	<br><br><br>
	<script type="text/javascript">
		document.getElementById("wishlistNav").classList.add('active');
	</script>
	<div class="container">
		<div class="card shadow-box-example z-depth-5 flex-center mb-3">
				<table class="table table-striped table-bordered">
		<?php
	if (isset($_GET['wish_del'])) {

		$del = $_GET['wish_del'];
			$wish_del = mysqli_query($con,"delete from order_items where slug='$del' ");
		}	
		$uid = $_SESSION['user_id'];
	$wishlist = mysqli_query($con,"select * from order_items where user_id='$uid' and status ='wishlist'");
	$wishcount = mysqli_num_rows($wishlist);
	if ($wishcount>0) {
	while ($wish = mysqli_fetch_array($wishlist)){
  ?>
				<tr>
					<td><a href="product_details.php?slug-id=<?php echo $wish['slug'] ?>&type=<?php echo $wish['type'] ?>"><img src="product/<?php echo $wish['image'] ?>" class="rounded-circle" width="80" height="80" alt="wishlist"></a>
						<br>
						<a href="cart_add.php?item_id=<?php echo $wish['slug'] ?>" class="btn btn-outline-primary btn-sm mt-2">Add to cart</a>
					</td>
					<td><?php echo $wish['item_name'] ?></td>
					<td><?php echo $wish['price_num'] ?></td>
					<td><?php echo $wish['size'] ?></td>
					<td><svg height=30 width=30>
                <circle cx=15 cy=13 r=10 stroke=black stroke-width=3 fill=<?php echo $wish['colors'] ?> />
              </svg>
          </td>
					<td><?php echo $wish['type'] ?></td>
					<td><a href="?wish_del=<?php echo $wish['slug'] ?>" class="text-danger"><i class="fas fa-trash fa-2x"></i></a></td>
				</tr>
  <?php
  }
}else{
	         ?>
                <div class="d-flex justify-content-center border border-light p-5">

              <img src="images/flipkart.svg" class="img-fluid" alt="">

              </div>
                <p class="mt-2 text-center">Missing Wishlist items? <br><br><a href="index.php" class="btn btn-outline-warning">Continue shopping</a></p>
                <?php
}
  ?>
  </table>
		</div>
  </div>  
	<?php include 'footer.php'?>
