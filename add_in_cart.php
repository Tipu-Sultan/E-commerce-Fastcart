<?php
        function add_in_cart($item_id){
            if (isset($_SESSION['user_id'])) {
            require 'themancode.php';
        //session_start();    
        $product_check_query="select * from order_items where item_id=$item_id and user_id='{$_SESSION['user_id']}' and status='added_in_cart'";
        $product_check_result=mysqli_query($con,$product_check_query) or die(mysqli_error($con));
        $num_rows=mysqli_num_rows($product_check_result);
        if($num_rows>=1){
            return 1;
        }else{
            return 0;
        }
      } else{
            echo "please login";
        } 
    }
   
?>