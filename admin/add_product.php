
<?php include 'sidebar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-sm col d-flex justify-content-center">
                    <div class="card mt-4 w-50">
                        <div class="card-body">
                            <form id="add_product" name="add_product" action="#file" method='post' enctype="multipart/form-data">
                  <!-- Name input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="product_name" name="product_name" class="form-control" required="" />
                    <label class="form-label" for="form4Example1">Product Name</label>
                  </div>

                  <!-- price input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="Price" name="Price" class="form-control" required="" />
                    <label class="form-label" for="form4Example2">Price</label>
                  </div>

                  <!-- input Category -->
                  <div class="form-outline mb-4">
                    <input type="text" id="Category" name="Category" class="form-control" required="" />
                    <label class="form-label" for="form4Example2">Category</label>
                  </div>
                  <!-- input stocks -->
                  <div class="form-outline mb-4">
                    <input type="text" id="qty" name="qty" class="form-control" required="" />
                    <label class="form-label" for="form4Example2">Add Quantity</label>
                  </div>
                  <!-- type size -->
                  <div class="paste-new-sizes">
                  </div>
                  <a href="javascript:void(0)" class="add_more_sizes btn btn-sm btn-primary mb-3">Add more sizes</a>

                  <!-- type colors -->
                  <div class="paste-new-colors">
                  </div>
                  <a href="javascript:void(0)" class="add_more_colors btn btn-sm btn-primary mb-3">Add more colors</a>
                  <!-- type image -->
                  <label for="favcolor">Colour :</label>
                  <input type="color" id="favcolor" name="favcolor" value="#ff0000">
                  <br>
                  <label>Add product catalog</label>
                  <br>
                  <div class="form-outline mb-4 mt-3">
                    <input type="file" name="file" id="fileInput" class="form-control" required="">
                  </div>

                  <!-- type catalog -->
                  <label>Add more product catalog || (select multiple catalog)</label>
                  <br>
                  <div class="form-outline mb-4 mt-3">
                    <input type="file" name="catalog[]" id="catalog" class="form-control" multiple="">
                  </div>
                  <!-- Message input -->
                  <div class="form-outline mb-4">
                    <textarea class="form-control" rows="4" id="product_details" name="product_details" required=""></textarea>
                    <label class="form-label" for="form4Example3">Product Details</label>
                  </div>
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
        
        $(document).ready(function(){

            $(document).on('click','.add_more_sizes',function(){
                
                $('.paste-new-sizes').append('<div class="row"><div class="col-md-7 col-lg-7 col-7"><div class="form-outline mb-4"><input type="text" id="sizes" name="sizes[]" class="form-control" required="" /><label class="form-label" for="form4Example2">Select Sizes</label></div></div><div class="col-md-3 col-lg- col-3"><button type="button" class="btn btn-sm btn-primary remove-btn">remove</button></div></div>');
            });

        });

        $(document).on('click','.remove-btn',function(){
                $(this).closest('.paste-new-sizes').remove();
            });
    </script> 


    <script type="text/javascript">
        
        $(document).ready(function(){

            $(document).on('click','.add_more_colors',function(){
                
                $('.paste-new-colors').append('<div class="row"><div class="col-md-7 col-lg-7 col-7"><div class="form-outline mb-4"><input type="text" id="colors" name="colors[]" class="form-control" required="" /><label class="form-label" for="form4Example2">Select Colors</label></div></div><div class="col-md-3 col-lg- col-3"><button type="button" class="btn btn-sm btn-primary remove-btn-color">remove</button></div></div>');
            });

        });

        $(document).on('click','.remove-btn-color',function(){
                $(this).closest('.paste-new-colors').remove();
            });
    </script>
               



<script type="text/javascript">
  jQuery('#add_product').on('submit',function(e){
    e.preventDefault();
    $("#add_item").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Adding...</span>");
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
        jQuery('#succ_msg').html('product insert successfully');
        jQuery('#add_product')[0].reset();
        jQuery('#add_item').html('add more');
        jQuery('#add_item').attr('disabled',false);
        }else if(obj.is_error =='yes'){
          jQuery('#succ_msg').html('Not inserted');
          jQuery('#add_product')[0].reset();
          jQuery('#add_item').html('retry');
        jQuery('#add_item').attr('disabled',false);
        }else if(obj.is_error =='file_err'){
          jQuery('#succ_msg').html('file size accepted only 2 MB');
          jQuery('#add_product')[0].reset();
          jQuery('#add_item').html('retry');
        jQuery('#add_item').attr('disabled',false);
        }else if(obj.is_error =='type_err'){
          jQuery('#succ_msg').html('Please select a valid file (mp4/JPEG/JPG/PNG/GIF).');
          jQuery('#add_product')[0].reset();
          jQuery('#add_item').html('retry');
        jQuery('#add_item').attr('disabled',false);
        }
      }
    });
  });
</script>

<!-- script tag end -->
<!-- <script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('add_file', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'add_image.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#000;">File has uploaded successfully!</p>');
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                }else if(resp == 'file_err'){
                  $('#uploadStatus').html('<p style="color:#000;">Please select a valid file size.</p>');
                }
            }
        });
    });
  
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['video/mp4','image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (mp4/JPEG/JPG/PNG/GIF).');
            $("#fileInput").val('');
            return false;
        }
    });
});
</script> -->
    </body>
</html>
