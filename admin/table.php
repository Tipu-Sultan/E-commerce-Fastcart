
<?php include 'sidebar.php' ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="input-group">
  <div class="form-outline">
    <input type="search"  id="myInput" onkeyup="searchTable()" class="form-control" />
    <label class="form-label" for="form1">Search</label>
  </div>
  <button type="button" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Stocks</th>
                                            <th>Opeartions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            <th>Stocks</th>
                                            <th>Opeartions</th>
                                        </tr>

                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <?php include '../footer.php' ?>
        <script src="js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
   
function searchTable() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("dataTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
       
      }
    }       
  }
}

</script>
        <script type="text/javascript">
$(document).ready(function(){
  function loadTable(page){
    $.ajax({
      url : "load_data.php",
      type : "POST",
      data : {Page_no : page},
      success : function(data){
        if (data) {
          $("#pagination").remove();
           $("#dataTable").append(data);
           $("#ajaxbtn").html("Load More");
          $("#ajaxbtn").attr("disabled",false);
        }else{
          $("#ajaxbtn").html("Finished");
          $("#ajaxbtn").attr("disabled",true);
        }
      }
    });
  }
  loadTable();

  $(document).on("click","#ajaxbtn",function(){
    $("#ajaxbtn").html("<div class='spinner-border text-warning spinner-border-sm'></div> <span style='font-size:12px;'>Fetching...</span>");
        $("#ajaxbtn").attr("disabled",false);
    var pid = $(this).data("id");
    loadTable(pid);
  });
});    
</script>

<script type="text/javascript">
    
</script>
    </body>
</html>
