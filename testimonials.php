<?php 
if(isset($_SESSION['user_id'])){

 ?>
<div class="container">
   <div class="row">
  <?php 
  $limit = 4;
  $carousel  = mysqli_query($con,"SELECT * FROM testimonial order by id desc LIMIT $limit ");
  while($tst = mysqli_fetch_array($carousel)){
  ?>
    <div class="text-white col-lg-3 col-6 col-sm-6 col-md-6 mt-2 mb-2">
      <div class="card bg-dark border border-success">
        <div class="card-body">
          <div class="avatar d-flex justify-content-center">
            <img src="uploads/<?php echo $image ?>" width="50" height="50" class="img-responsive rounded-circle" alt="test">
          </div>
          <h5 class="text-center mt-2"><?php echo $tst['user_name']; ?></h5>
          <p class="text-center mt-2"><?php echo $tst['testimonial'] ?></p>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
  </div>
  </div>

  <!-- testimonial sections -->
  <div class="container">
  <div class="row">
        <!-- testimonials sections -->
        <form method="post" id="testimonials" name="testimonials" class="pl-5 pr-5">
          
          <!-- Message input -->
          <div class="form-outline mb-4">
            <input type="text" name="type" value="testimonial" hidden="true">
            <textarea class="form-control" id="testimoial_msg" name="comments" rows="4"></textarea>
            <label class="form-label" for="form4Example3">Add review</label>
          </div>
          <!-- Checkbox -->
          <div class="form-check d-flex justify-content-center mb-2">
            <p id="test_msg"></p>
          </div>
          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-block mb-2"  id="testimoial_btn" name="submit">Comment</button>
        </form>
  </div>
</div>
<?php 
}
 ?>