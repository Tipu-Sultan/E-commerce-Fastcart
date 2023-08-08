
<?php include 'sidebar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Email</th>
                                            <th>Payment</th>
                                            <th>Units</th>
                                            <th>Coupon</th>
                                            <th>Process</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Email</th>
                                            <th>Payment</th>
                                            <th>Units</th>
                                            <th>Coupon</th>
                                            <th>Process</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </tfoot>
                                    
                                    <?php 
                                    $id = 0;
                                    $cart_item = mysqli_query($con,"SELECT *  FROM confirm where status='pending' or status='confirmed'");
                                    while ($row = mysqli_fetch_array($cart_item)){
                                        $id = $row['id'];

                                     ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['username']?></td>
                                            <td><img src="../product/<?php echo $row['image']?>" width="40" height="40"></td>
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td><?php echo $row['total_item']?></td>
                                            <td><?php echo $row['coupon_value']?></td>
                                            <td>
                                                <input type="text" id="oid_<?php echo $row['id'] ?>" name="oid"
                                                    value="<?php echo $row['order_id']?>" hidden>
                                                    <input type="text" id="process_<?php echo $row['id'] ?>" name="per" class="form-control" style="width: 80px;" value="<?php echo $row['processed']?>">
                                                    <button  class="btn btn-primary-sm" id="per_<?php echo $row['id'] ?>" type="submit" name="submit">Add</button>
                                        <span id="succ_msg_<?php echo $row['id'] ?>"></span>
                                                
                                            </td>
                                            <td><?php echo $row['address']?></td>

                                            <td>
                                                <input type="text" id="soid<?php echo $row['id'] ?>" name="oid"
                                                    value="<?php echo $row['order_id']?>" hidden>
                                                    <input type="text" id="pro_status_<?php echo $row['id'] ?>" name="status" class="form-control" style="width: 80px;" value="<?php echo $row['status']?>">
                                                    <button  class="btn btn-primary-sm" id="status_<?php echo $row['id'] ?>" type="submit" name="submit">update</button>
                                        <span id="msg_status<?php echo $row['id'] ?>"></span>
                                                
                                            </td>

                                            <td><a href="details.php?order_detais=<?php echo $row['order_id'] ?>" class='btn btn-primary-sm'><i class='fa fa-edit'></i></a>
                                        </tr>
                                    </tbody>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

      $("#per_<?php echo $row['id'] ?>").on("click",function(){
        jQuery.ajax({
        url : "process.php",
        type : "POST",
        data :{
          orderid: $("#oid_<?php echo $row['id'] ?>").val(),  
          process: $("#process_<?php echo $row['id'] ?>").val()
        },
        dataType: "text",
        success: function(data)
        {
         var obj = jQuery.parseJSON(data);
         if (obj.is_error == 'no') {
             jQuery('#succ_msg_<?php echo $row['id'] ?>').html(obj.msg);
         }          
        }
      });
      });
    });


    $(document).ready(function(){

      $("#status_<?php echo $row['id'] ?>").on("click",function(){
        jQuery.ajax({
        url : "process.php",
        type : "POST",
        data :{
          soid: $("#soid<?php echo $row['id'] ?>").val(),  
          status: $("#pro_status_<?php echo $row['id'] ?>").val()
        },
        dataType: "text",
        success: function(data)
        {
         var obj = jQuery.parseJSON(data);
         if (obj.is_error == 'no') {
             jQuery('#msg_status<?php echo $row['id'] ?>').html(obj.msg);
         }          
        }
      });
      });
    });
  </script>

                                    <?php

                                }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            </div>
        </div>


        <script src="js/scripts.js"></script>
         <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
    </body>
</html>
