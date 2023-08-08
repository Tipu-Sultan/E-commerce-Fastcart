
<?php include 'sidebar.php'; ?>
<?php 
if (isset($_GET['edit_id'])) {
  $eid = $_GET['edit_id'];
  $edit = mysqli_query($con,"SELECT * from items where id =$eid");
  $res = mysqli_fetch_array($edit);
  mysqli_free_result($edit);
  mysqli_close($con);
}
 ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-sm col d-flex justify-content-center">
                    <div class="card mt-4 w-50">
                        <div class="card-body">
                            <form id="add_product" name="add_product" action="#file" method='post' enctype="multipart/form-data">
                  <!-- Name input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $res['name'] ?>" required="" />
                    <label class="form-label" for="form4Example1">Product Name</label>
                  </div>

                  <!-- slug input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="slug" name="slug" class="form-control" required="" value="<?php echo $res['slug'] ?>" />
                    <label class="form-label" for="form4Example2">Slug</label>
                  </div>

                  <!-- type input -->

                  <div class="form-outline mb-4">
                    <input type="text" id="type" name="type" class="form-control" value="<?php echo $res['type'] ?>"  required=""/>
                    <label class="form-label" for="form4Example2">type</label>
                  </div>

                  <!-- stock input -->

                  <div class="form-outline mb-4">
                    <input type="text" id="stock" name="stock" class="form-control" value="<?php echo $res['stock'] ?>"  required=""/>
                    <label class="form-label" for="form4Example2">stock</label>
                  </div>

                  <input type="text" id="eid" name="eid" class="form-control" value="<?php echo $res['id'] ?>"  required="" hidden/>
                  <!-- Submit button -->
                  <button  class="btn btn-primary btn-block mb-4" id="add_item" name="submit">Send</button>
                  <div>
                      <p id="succ_msg" class="text-center"></p>
                  </div>
                </form>
                      </div>
                    </div>
                    </div>
                     </div>
                <!-- /.container-fluid -->
                </div>

                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
        <script src="js/scripts.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
  jQuery('#add_product').on('submit',function(e){
    e.preventDefault();
    $("#add_item").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Editing...</span>");
    jQuery('#add_item').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'add_product_redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.is_error =='no'){
        jQuery('#succ_msg').html('Product edited successfully');
        window.location = 'table.php';
        jQuery('#add_item').attr('disabled',false);
        }else if(obj.is_error =='yes'){
          jQuery('#succ_msg').html('Not inserted');
          jQuery('#add_product')[0].reset();
          jQuery('#add_item').html('retry');
        jQuery('#add_item').attr('disabled',false);
        }
      }
    });
  });
</script>
    </body>
</html>
