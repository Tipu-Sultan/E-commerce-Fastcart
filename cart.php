<!DOCTYPE html>
<html lang="en">
    <head>
      <?php 
      include 'nav.php';
      
      ?>
        <title>Cart</title>
    </head>
<body>

    <div id="fetch_cart" class="">
      <div class="d-flex justify-content-center " style="margin-top: 200px;">
  <div class="spinner-border " style="width: 3rem; height: 3rem;" role="status">
    <span class="text-danger sr-only">Loading...</span>
  </div>
</div>
    </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  document.getElementById("cartNav").classList.add('active');
  function plus_cart(id){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=plus&id='+id,
      success:function(result){
        jQuery.ajax({
        url :'fetch_cart.php',
        success:function(result) {
        jQuery('#fetch_cart').html(result);
        }
      });
        var obj = jQuery.parseJSON(result);
              if(obj.is_error=='yes'){
                alert(obj.dd);
        }else{
                jQuery.ajax({
                url :'fetch_cart.php',
                success:function(result) {
                jQuery('#fetch_cart').html(result);
                }
              });
              }
      }
    });
  }


  function minus_cart(id){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=minus&id='+id,
      success:function(result){
              var obj=jQuery.parseJSON(result);
              if(obj.is_error=='yes'){
                alert(obj.dd);
              }else{
                jQuery.ajax({
                url :'fetch_cart.php',
                success:function(result) {
                jQuery('#fetch_cart').html(result);
                }
              });
              }
      }    
    });
  }


  function remove_item(id){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=remove_item&id='+id,
      success:function(result){
        jQuery.ajax({
      url :'fetch_cart.php',
      success:function(result) {
      jQuery('#fetch_cart').html(result);
      }
    });
      }
    });
  }
</script>


<!-- <script type="text/javascript">
  function fetch_cart(){
    jQuery.ajax({
      url :'fetch_cart.php',
      success:function(result) {
      jQuery('#fetch_cart').html(result);
      }
    });
}
    setInterval(function(){
    fetch_cart();
  },1000);
</script> -->

<script type="text/javascript">
  function sizes(size){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'sizes',
        sid:size,
        id: $("#id").val(),
        },
      success:function(result){
        jQuery.ajax({
      url :'fetch_cart.php',
      success:function(result) {
      jQuery('#fetch_cart').html(result);
      }
    });
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
        id: $("#id").val(),
        },
      success:function(result){
        jQuery.ajax({
        url :'fetch_cart.php',
        success:function(result) {
        jQuery('#fetch_cart').html(result);
        }
      });
      }
    });
  }
</script>
<script type="text/javascript">
      jQuery.ajax({
      url :'fetch_cart.php',
      success:function(result) {
      jQuery('#fetch_cart').html(result);
      }
    });
</script>
      <!-- MDB -->
      <?php include 'footer.php';?>
</body>
</html>