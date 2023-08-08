
<?php 

include 'sidebar.php';

$payment = mysqli_query($con,"select * from payment where payment_status='complete' ");
$pay = 0;
while ($res = mysqli_fetch_array($payment)){
    $pay = $pay + $res['amount'];

}


 ?>

             <!-- Page content start-->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-lg-4 col-sm col">
                            <div class="card bg-primary">
                                <div class="card-body text-white">
                                    <div class="row">
                                        <div class="col-lg-6 col">
                                            <h6>Earings Monthly</h6>
                                            <span><?php echo $pay.' ₹' ?></span>
                                        </div>

                                        <div class="col-lg-6 col float-right">
                                            <i class="fas fa-calendar text-muted fa-3x ml-4"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm col">
                            <div class="card  bg-warning">
                                <div class="card-body text-white">
                                    <div class="row">
                                        <div class="col-lg-6 col">
                                            <h6>Expenditure Monthly</h6>
                                            <span><?php  $exp = ($pay*18)/100; echo $exp.' ₹' ?></span>
                                        </div>

                                        <div class="col-lg-6 col">
                                            <i class="fas fa-dollar-sign text-muted fa-3x"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm col">
                            <div class="card bg-info">
                                <div class="card-body text-white">
                                    <div class="row">
                                        <div class="col-lg-6 col">
                                            <h6>Task</h6>
                                            <span><div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div></span>
                                        </div>

                                        <div class="col-lg-6 col">
                                            <i class="fas fa-tasks text-muted fa-3x"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page content end-->
                    <!-- charts content start-->
                    <div class="row mt-4">
                        <div class="col-lg-6 col-sm col mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Visual Earnings</h4>
                                </div>
                                <div class="card chart-container">
                                        <canvas id="mycanvas"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm col">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Earnings</h4>
                                </div>
                                <div class="card chart-container">
                                        <canvas id="myChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- charts content end-->

                    <!-- footerstart -->
                </div>
                <!-- footer -->
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
        <script src="js/scripts.js"></script>
        <script type="text/javascript"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
</script>
<script>
$(document).ready(function(){
  $.ajax({
    url: "fetch_amt.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var amt = [];
      var month = [];
      var year = [];
      var color = [];

      for(var i in data) {
        amt.push(data[i].amount);
        month.push(data[i].month);
        year.push(data[i].year);
      }

      var chartdata = {
        labels: month,
        datasets : [
          {
            label: 'Earnings by months',
            backgroundColor: [getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor()],
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: amt
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
</script>



<script type="text/javascript">
    $(document).ready(function(){
  $.ajax({
    url: "chart.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var amt = [];
      var month = [];
      var color = [];
      var total = 0;
      for(var i in data) {
        amt.push(data[i].amount);
        month.push(data[i].month);
        color.push(data[i].color);
        total =data[i].total;
      }

      var chartdata = {
        labels: month,
        datasets : [
          {
            label: ' Total earnings ' + total,
            backgroundColor: color,
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: amt
          }
        ]
      };

      var ctx = $("#myChart2");

      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
</script>

</body>
</html>
