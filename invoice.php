<?php 
  require ("fpdf184/fpdf.php");
    include('themancode.php');
  session_start();

  //customer and invoice details
    $j = 0;
    if(isset($_GET['invoice']) && isset($_SESSION['user_id'])){
    $oid = $_GET['invoice'];
    $dataquery = mysqli_query($con,"select * from confirm where order_id='$oid' and status='pending' ");
    $data = mysqli_fetch_array($dataquery);
    $counts = mysqli_num_rows($dataquery);
    if($counts==1){
    $uid = $_SESSION['user_id'];
    $username = $data['username'];
    $number = $data['number'];
    $address = $data['address'];
    $zip = $data['zip'];
    $order_id = $data['order_id'];
    $amt = $data['price'];
    $date = $data['date'];
    $qty = $data['total_item'];
    $cpv = $data['coupon_value'];
  $info=[
    "customer"=>"$username",
    "address"=>"$address",
    "city"=>"$number",
    "invoice_no"=>"$order_id",
    "invoice_date"=>"$date",
    "total_amt"=>"5200.00",
    "words"=>"Rupees Five Thousand Two Hundred Only",
  ];
  
  
  //invoice Products
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      $this->Image('images/stamp.png',170,7,28,28);
      $this->SetFont('Arial','B',14);
      $this->Cell(1,10,"FASTCART PVT. LTD",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"WEST UP",0,1);
      $this->Cell(50,7,"BARABANKI FATEHPUR 225305",0,1);
      $this->Cell(50,7,"PH : 9919408817",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-39);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,50,"INVOICE",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$j){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["city"],0,1);
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-80);
      $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-80);
      $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(20,12,"Images",1,0);
      $this->Cell(110,12,"DESCRIPTION",1,0);
      $this->Cell(20,12,"PRICE",1,0,"C");
      $this->Cell(20,12,"QTY",1,0,"C");
      $this->Cell(25,12,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      include('themancode.php');
      $oid = $_GET['invoice'];
      $query = mysqli_query($con,"select * from order_items where order_id='$oid' and status='confirmed' ");
      $amt = 0;
      $x = 0;
      while($row = mysqli_fetch_array($query)){
        $amt = $amt + $row["price_num"];
        $this->Cell(20,12,$this->Image("product/{$row['image']}",15,108+$x,9,9),"LR",0);
        $this->Cell(110,12,$row["item_name"],"LR",0);
        $this->Cell(20,12,$row["price_num"],"R",0,"R");
        $this->Cell(20,12,$row["quantity"],"R",0,"C");
        $this->Cell(25,12,$row["price_num"],"R",1,"R");
        $x += 12;
      }
      //Display table empty rows
      for($i=0;$i<6-$j;$i++)
      {
        $this->Cell(20,12,"","LR",0);
        $this->Cell(110,12,"","LR",0);
        $this->Cell(20,12,"","R",0,"R");
        $this->Cell(20,12,"","R",0,"C");
        $this->Cell(25,12,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(170,9,"TOTAL",1,0,"R");
      $this->Cell(25,9,$amt,1,1,"R");

      include('themancode.php');
    $oid = $_GET['invoice'];
    $data = mysqli_fetch_array(mysqli_query($con,"select * from confirm where order_id='$oid' and status='pending' "));
    $amt = $data['price'];
    $date = $data['date'];
    $qty = $data['total_item'];
    $cpv = $data['coupon_value'];

    $bill = mysqli_query($con,"select * from order_items where order_id='$oid' and status='confirmed' ") or die(mysqli_error());
    $amt_vat = 0;
    while ($res = mysqli_fetch_array($bill)) {
        $amt_vat=$amt_vat+$res['price_num'];
    }
          $gst = 0;
          $order_shipped = 0;
          $gst = ($amt_vat*18)/100;
          $tot = $amt_vat + $gst;
          if ($tot>1500) {
             $order_shipped  = "Free";
             $order_totals = ($amt_vat+$gst-$cpv);
           }else{
            $order_shipped = 70;
            $order_totals = ($amt_vat+$gst+$order_shipped-$cpv);
           }

$this->Ln(10);//Line break
$this->Cell(55, 5, 'Total Amount', 0, 0);
$this->Cell(58, 5, ": {$amt_vat}", 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'GST 18%', 0, 0);
$this->Cell(58, 5, "+ ".round($gst), 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'Shipping Charged', 0, 0);
$this->Cell(58, 5, "+ ".$order_shipped, 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'Coupon_value', 0, 0);
$this->Cell(58, 5, "- ".round($cpv), 0, 1);
$this->Line(0,245,80,245);
$this->Ln(4);//Line break
$this->Cell(55, 5, 'Total Pay', 0, 0);
$this->Cell(58, 5,": ".round($order_totals), 0, 1);
      
      
    }
  
    function Footer(){
      
      //set footer position
      $this->SetY(-40);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,15,"FASTCART PVT. LTD",0,1,"R");
      $this->Cell(0,10,$this->Image("images/stamp.png",170,240,20,20),0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,-55,"Authorized Signature",0,1,"R");
      $this->Cell(0,70,"This is computer generated Receipt, no signature required",0,1,"L");
      $this->Image("images/tipuSig.png",160,272,40,9);
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->SetY(-15);
      $this->SetFont('Arial','',0);
      $this->Cell(0,10,'Page',$this->PageNo().'/{nb}',0,0,'C');
      
    }
    
 } 
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$j);
  $pdf->Output();
}
else{
  echo "<h3 style='text-align:center;margin-top:200px;'>Invaild Invoice Number<h3>";
}
}
else{
  echo "<h3 style='text-align:center;margin-top:200px;'>Invaild Invoice Number<h3>";
}
?>