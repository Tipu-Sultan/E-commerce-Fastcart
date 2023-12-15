<style type="text/css">
        h3,p{
            color: #bd418c;
        }
 
    </style>
    <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section
      class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
    >
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->
  
      <!-- Right -->
      <div>
        <!-- Facebook -->
<a class="me-4" style="color: #3b5998;" href="https://www.linkedin.com/in/tipu-sultan-47b4221b4/" role="button">
  <i class="fab fa-linkedin"></i>
</a>

<!-- Twitter -->
<a class="me-4" style="color: #55acee;" href="https://twitter.com/Tipu_Sultan07" role="button">
  <i class="fab fa-twitter fa-lg"></i>
</a>


<!-- Instagram -->
<a class="me-4" style="color: #ac2bac;" href="https://www.instagram.com/dev_sultan_2.0/" role="button">
  <i class="fab fa-instagram fa-lg"></i>
</a>

<!-- Google -->
<a class="me-4" style="color: #dd4b39;" href="#!" role="button">
  <i class="fab fa-google fa-lg"></i>
</a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <img src="images/mancode.jpg" alt="TMC" class="img-responsive w-50 h-50 rounded"> FASTCART
            </h6>
            <p>
              FASTCART is a E-commerce wetobsite to  provide anywhere you daily routines use products.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset" value="MEN" id="men" onclick="men()">MENS</a>
            </p>
            <p>
              <a href="#!" class="text-reset" value="WOMEN" id="women" onclick="women()">WOMEN</a>
            </p>
            <p>
              <a href="#!" class="text-reset" value="electronic" id="elctronics" onclick="electronics()">Electronic</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
            <p>
              <a href="#!" class="text-reset">Refund & Return policy</a>
            </p>
            <p>
              <a href="order.php" class="text-reset">Help</a>
            </p>
            <p>
              <a href="sheet.php" class="text-reset">Feedback</a>
            </p>
            <p>
              <a href="javascript:void(0)" class="text-reset" id = "clock" onload="currentTime()"></a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>
            <p><i class="fas fa-home me-3"></i> Lucknow, LU 226026, India</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              teepukhan@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 99 194 088 17</p>
            <p><i class="fas fa-print me-3"></i> + 63 888 199 29</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      <a href="http://localhost/fastcart/admin/index.php">©</a> <script type="text/javascript">
          const currentDate = new Date();
          const currentYear = currentDate.getFullYear();
          document.write(currentYear)
       </script> Copyright:
      <a class="text-reset fw-bold" href="http://themancode.epizy.com/">TheManCode.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

<script src="bootstrap/js/googleapis-jquery.min.js"></script>
  <!-- MDB -->
<script
type="text/javascript"
src="bootstrap/js/all-mdb.min.js"
>
</script>
<script src="bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script src="bootstrap/js/owl-jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script src="bootstrap/js/all-owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="bootstrap/js/googlesignupapiplatform.js?onload=onLoad" async defer></script>
<script type="text/javascript">
         function onLoad(){
            gapi.load('auth2',function(){
                gapi.auth2.init();
            });
        }
        function logout()
        {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut();

            jQuery.ajax({
                url:"logout.php",
                type:"post",
                data:'session_logout=done',
                success:function(result){
                    window.location.href="index.php";
                }
            });

        }

          function gmailLogIn(userInfo)
          {
                var profile = userInfo.getBasicProfile();
               

                jQuery.ajax({
                    url:'g-callback.php',
                    type:'post',
                    data:'client_id='+profile.getId()+'&name='+profile.getName()+'&last_name='+profile.getFamilyName()+'&picture_link='+profile.getImageUrl()+'&google_email='+profile.getEmail(),
                    success:function(result){
                       var obj = jQuery.parseJSON(result);
                       if(obj.msg=="login")
                       {
                            var currentPage = window.location.href;
                            window.location.href = currentPage;
                       }else if(obj.error=="login"){
                            var currentPage = window.location.href;
                            window.location.href = currentPage;

                       }
                    }
                });
          }
        </script>
<script type="text/javascript">
    $(window).on('load', function() {
      if(localStorage.getItem('#login')!='true')
      {
        $('#login').modal('show');
      }
      localStorage.setItem('#login','true');
    });
</script>

<script type="text/javascript">

var owl = $('.owl-carousel');
owl.owlCarousel({
  stagePadding: 50,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
        600:{
            items:2
        },
        1000:{
            items:5
        }
    },
    loop:true,
    margin:10,
    autoplay:true,
    nav:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[2000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})
</script>

<script type="text/javascript">
  function change_image(image){

var container = document.getElementById("main-image");

container.src = image.src;
}

document.addEventListener("DOMContentLoaded", function(event) {
});
</script>

<script type="text/javascript">
  function currentTime() {
  let date = new Date(); 
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();
  let session = "AM";

  if(hh === 0){
      hh = 12;
  }
  if(hh > 12){
      hh = hh - 12;
      session = "PM";
   }

   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " " + session;

  document.getElementById("clock").innerText = time; 
  let t = setTimeout(function(){ currentTime() }, 1000);
}

currentTime();
</script>

