<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'nav.php';?>


    <title>Home</title>
</head>
<body onload="themancode()" id="home">

<style type="text/css">
  .neonText {
 color: #000;
  text-shadow:
      0 0 7px #bd418c,
      0 0 10px #bd418c,
      0 0 21px #bd418c,
      0 0 42px #0fa,
      0 0 82px #0fa,
      0 0 92px #0fa,
      0 0 102px #0fa,
      0 0 151px #0fa;
}

#loading_1{
    
    position: fixed;
    width: 100%;
    height: 100vh;
    background: #fff url('images/loader.gif') no-repeat center;
    z-index: 99999;
}
</style>
  <div id="loading_1">
   <h1 style="text-align: center;margin-top: 500px;" class=" fst-italic">Handcrafted By Tipu Sultan</h1>
  </div>  
<script type="text/javascript">

        document.getElementById("homeNav").classList.add('active');
</script>
<?php include 'slider.php';?>
<?php include 'top_product.php';?>
<?php include 'testimonials.php';?>
<?php include 'footer.php';?>

<script type="text/javascript">
  jQuery('#testimonials').on('submit',function(e){
    $("#testimoial_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>commenting...</span>");
    jQuery.ajax({
      url : 'tools.php',
      type : 'post',
      data:jQuery('#testimonials').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.error =='no'){
        jQuery('#test_msg').html(obj.msg);
        jQuery('#testimonials')[0].reset();
        jQuery('#testimoial_btn').html('Comment');
        jQuery('#testimoial_btn').attr('disabled',false);
        }else{
          jQuery('#test_msg').html(obj.msg);
        jQuery('#testimoial_btn').html('Try again');
        jQuery('#testimoial_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>

<script type="text/javascript">
  var preloader = document.getElementById('loading_1');

   function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
   }
   async function themancode() {      
         await sleep(700);
         preloader.style.display = 'none';
      }
   themancode()
</script>
</body>
</html>