<!doctype html>
<html lang="en">
  <head>
    <?php include '../link.php'; ?>
    <title>Sea Search</title>
  </head>
  <body class="bg-dark">
<div class="container">
            <form>
                <center>
                <h3 style="margin-top: 20%;"><span class="text-info">Sea <span class="text-success"> Search</span></span></h3>
                <input type="text" style="width:50vw;"  class="form-control" placeholder="Livesearch" name="search" id="search" name="livesearch" onkeyup="showResult(this.value)">
                </center>
                <div id="dataTable" class="card container-fluid" style="width: 50vw;"></div>
            </form>
        </div>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function showResult(str) {
        if (str.length==0) {
    document.getElementById("dataTable").innerHTML="";
    document.getElementById("dataTable").style.border="0px";
    return;
  }
        $.ajax({
            url:"xml.php",
            type: "POST",
            data :{search:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#dataTable').html(obj.res);
                }else if (obj.error == 'yes'){
                    $('#dataTable').html(obj.msg);
                    jQuery('#dataTable')[0].reset();
                }
            }
        });
    }
</script>


<!-- <script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("dataTable").innerHTML="";
    document.getElementById("dataTable").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("dataTable").innerHTML=this.responseText;
      document.getElementById("dataTable").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","search.php?query="+str,true);
  xmlhttp.send();
}
</script> -->
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
