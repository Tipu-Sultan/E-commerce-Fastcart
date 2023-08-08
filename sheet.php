<?php include('link.php') ?>
<div class="container mt-5">
  <div class="card-header">
    <a href="index.php">Back</a>
    <h4>Feedback Form</h4>
  </div>
  <div class="card">
    <form method="post" name="testimonials" id="testimonials">
  <!-- Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="form4Example1" name="Name" class="form-control" />
    <label class="form-label" for="form4Example1">Name</label>
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form4Example2" name="Email" class="form-control" />
    <label class="form-label" for="form4Example2">Email address</label>
  </div>

  <!-- Message input -->
  <div class="form-outline mb-4">
    <textarea class="form-control" id="form4Example3" name="Message" class="form-control"  rows="4"></textarea>
    <label class="form-label" for="form4Example3">Message</label>
  </div>


  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4" id="tst_btn">Send</button>
  <div class="form-check d-flex justify-content-center mb-2">
            <p id="sheet_msg"></p>
  </div>
</form>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  jQuery('#testimonials').on('submit',function(e){
    $("#tst_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Sheeting...</span>");
    jQuery.ajax({
      url : 'https://script.google.com/macros/s/AKfycbxBNKq-87iHBcwQIlo-ktuWUp0MhvA6p6IAMyGQLnb9wf74XLRhd7NLlY8lBx3mVzyvUA/exec',
      type : 'post',
      data:jQuery('#testimonials').serialize(),
      success:function(result){
        jQuery('#tst_btn').html('Sheeted again');
        jQuery('#tst_btn').attr('disabled',false);
        jQuery('#sheet_msg').html('Your feedback submitted');
      }
    });
    e.preventDefault();
  });
</script>
  <!-- MDB -->
<script
type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
