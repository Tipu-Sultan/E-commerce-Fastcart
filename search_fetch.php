    <?php 
    include 'themancode.php';
        
        if (isset($_POST["query"])!="") {
        $noresults = true;
        $query = mysqli_real_escape_string($con,$_POST["query"]);
        $sql =  " SELECT id,name,slug,image,price,size,type,colors,brief_info, 'items' FROM items where name like  '%$query%' or price like '%$query%' or type like  '%$query%'   or colors like  '%$query%' or brief_info like  '%$query%'";
        $result = mysqli_query($con,$sql);
        $count = mysqli_num_rows($result);
$output = "";
echo '<h5 style="color:  #ffbd2f;">Total results : <em style="color: #bd418c;">'.$count.'</em></h5>
';
  $output .="<div class='row'>";
  while ($top = mysqli_fetch_array($result)){
    $last_id = $top['id'];
 $noresults = false;
 $output.= '
 <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
              <div class="card">
                <div
                  class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                  data-mdb-ripple-color="light"
                >
                  <img
                    src="product/'.$top['image'].'"
                    class="w-100"
                    width="200"
                    height="200"
                  />
                  <a href="product_details.php?&slug-id='.$top['slug'].'&type='.$top['type'].'">
                    <div class="mask">
                      <div class="d-flex justify-content-start align-items-end h-100">
                        <h5><span class="badge bg-primary ms-2">'.$top['type'].'</span></h5>
                      </div>
                    </div>
                    <div class="hover-overlay">
                      <div
                        class="mask"
                        style="background-color: rgba(251, 251, 251, 0.15);"
                      ></div>
                    </div>
                  </a>
                </div>
                <div class="card-body">
                  <marquee behavior="alternate" scrollamount="3">  
                  <a href="" class="text-reset " style="max-width: 150px">
                    <h5 class="card-title mb-3">'.$top['name'].'</h5>
                  </a>
                  </marquee> 
                  <p class="text-center">'.$top['price'].' ₹</p>
                  <p>
                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="far fa-star fa-sm"></i></li>
      </ul>
                  </p>
              
                </div>
              </div>
            </div>';
}

$output .="</div>
";

echo $output;
if ($noresults){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-5">No Results Found <span style="font-size:15px;">for '.$query.' </p>
                        <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                        </p>
                    </div>
                 </div>';
        }

}else{
  echo "something hacked";
}
?>