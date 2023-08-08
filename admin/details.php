
<?php 
include 'sidebar.php';
if (isset($_GET['order_detais'])) {
    $oid = $_GET['order_detais'];
?>
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
                                            <th>Product Name</th>
                                            <th>Payment</th>
                                            <th>Date</th>
                                            <th>Process</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Payment</th>
                                            <th>Date</th>
                                            <th>Process</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <?php 
                                    $cart_item = mysqli_query($con,"SELECT *  FROM order_items where order_id='$oid' and status ='confirmed'");
                                    while ($row = mysqli_fetch_array($cart_item)){

                                     ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['username']?></td>
                                            <td><img src="../product/<?php echo $row['image']?>" width="40" height="40"></td>
                                            <td><?php echo $row['item_name']?></td>
                                            <td><?php echo $row['price_num']?></td>
                                            <td><?php echo $row['delivered']?></td>
                                            <td><?php echo $row['processed']?></td>
                                            <td><?php echo $row['status']?></td>
                                        </tr>
                                    </tbody>

                                    <?php
                                }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
            }
        ?>
                <!-- /.container-fluid -->

                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
        <script src="js/scripts.js"></script>

    </body>
</html>
