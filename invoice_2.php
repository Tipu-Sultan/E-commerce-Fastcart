<?php 

echo "<br/>";
echo "<br/>";

echo $URI = $_SERVER['REQUEST_URI'];
echo "<br/>";
echo $URI = $_SERVER['PHP_SELF'];
echo "<br/>";
echo $URI = $_SERVER['SERVER_NAME'];
echo "<br/>";
echo $URI = $_SERVER['HTTP_USER_AGENT'];
echo "<br/>";
echo $URI = $_SERVER['REMOTE_ADDR'];
echo "<br/>";
echo $URI = $_SERVER['REQUEST_METHOD'];
echo "<br/>";
echo $URI = $_SERVER['REQUEST_TIME'];
echo "<br/>";
echo $URI = $_SERVER['SERVER_PORT'];
echo "<br/>";
echo $URI = $_SERVER['HTTP_HOST'];
echo "<br/>";
echo $URI = $_SERVER['DOCUMENT_ROOT'];
echo "<br/>";
echo $URI = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
echo "<br/>";

if(!empty($_FILES['catalog'])){
            $extension=array('jpg', 'png', 'jpeg', 'gif','webp','avif','heic');
            $maxsize = 1048576;
            foreach ($_FILES['catalog']['tmp_name'] as $key => $value) {
            $filename=$_FILES['catalog']['name'][$key];
            $filename_tmp=$_FILES['catalog']['tmp_name'][$key];
            $covert = $_POST['convert'];
            $ext=pathinfo($filename,PATHINFO_EXTENSION);
            $finalimg='';
            if(in_array($ext,$extension))
            {
                if (($_FILES['catalog']['size'][$key] >= $maxsize) || ($_FILES['catalog']['size'] == 0)) {
                 $jsonLimit=array('is_error'=>'file_err');
                 break; 
            }else{
            $fileName = basename($filename,$ext); 
            $newfilename = time().$fileName."$covert";
            move_uploaded_file($filename_tmp, 'converter/'.$newfilename);
            echo "<a href='converter/{$newfilename}' download=''>Download now</a>";
            }
            }else
            {
                $jsonLimit=array('is_error'=>'type_err');
            }
            }
            }
 ?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="catalog[]" multiple="">
    <br>
    <label>jpeg
    <input type="radio" name="convert" value="jpeg"/>
    </label>
    <label>jpg
    <input type="radio" name="convert" value="jpg"/>
    </label>
    <label>png
    <input type="radio" name="convert" value="png"/>
    </label>
    <br>
    <input type="submit" name="submit" value="submit">
</form>

<?php 
session_start();
if (!isset($_SESSION['username'])) {
      header('Location:index.php');
      die();
    }
require('fpdf184/fpdf.php');
	include('themancode.php');
if (isset($_GET['invoice'])){
		$uid = $_SESSION['user_id'];
		$oid = $_GET['invoice'];
		$data = mysqli_fetch_array(mysqli_query($con,"select * from confirm where order_id='$oid' and status='pending' "));
		if ($data) {
		$amt = $data['price'];
		$date = $data['date'];
		$qty = $data['total_item'];
		$cpv = $data['coupon_value'];
class myPDF extends FPDF{
	function header(){
			include('themancode.php');
		if (isset($_GET['invoice'])){
		$uid = $_SESSION['user_id'];
		$oid = $_GET['invoice'];
		$data = mysqli_fetch_array(mysqli_query($con,"select * from confirm where order_id='$oid' and status='pending' "));
		$amt = $data['price'];
		$date = $data['date'];
		$qty = $data['total_item'];
		$cpv = $data['coupon_value'];
		$this->Image('images/mancodes.png',8,4,28,28);
		$this->SetFont('Arial','B',14);
		$this->Cell(90,5,'TheManCode',0,0,'C');
		$this->Ln();
		$this->SetFont('Arial','',12);
		$this->Cell(93,10,'Shopping like fast',0,0,'C');

		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial', '', 12);
		$this->Cell(55, 5, 'ORDER ID', 0, 0);
		$this->Cell(58, 5, ": $oid", 0, 0);
		$this->Cell(25, 5, 'Date', 0, 0);
		$this->Cell(52, 5, ": $date", 0, 1);

		$this->Cell(55, 5, 'Amount', 0, 0);
		$this->Cell(58, 5, ": $amt", 0, 0);
		$this->Cell(25, 5, 'Total Items', 0, 0);
		$this->Cell(52, 5, ": $qty", 0, 1);

		$this->Cell(55, 5, 'Status', 0, 0);
		$this->Cell(58, 5, ": Comfirmed", 0, 1);
		$this->Ln();
	}
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',0);
		$this->Cell(0,10,'Page',$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->Ln();
		$this->SetFont('Times','B',12);
		$this->Cell(20,10,'SR No.',1,0,'C');
		$this->Cell(40,10,'Product View',1,0,'C');
		$this->Cell(80,10,'Product Name',1,0,'C');
		$this->Cell(30,10,'Price',1,0,'C');
		$this->Cell(30,10,'Quantity',1,0,'C');
		$this->Ln();

	}
	function viewTable($con){
		$oid = $_GET['invoice'];
        $items = mysqli_query($con,"SELECT *  from order_items where order_id='$oid' and status='confirmed' ");
        $i = 1;

		while ($res = mysqli_fetch_array($items)) {
		$this->Cell(20,10,"$i",1,0,'C');
		$this->Cell(40,10,$this->Image("product/{$res['image']}",44,70,10,10),1,0,'C');

		$this->Cell(80,10,"{$res['item_name']}",1,0,'C');
		$this->Cell(30,10,"{$res['price_num']}",1,0,'C');
		$this->Cell(30,10,"{$res['quantity']}",1,0,'C');
		$this->Ln();
		$i++;
		}
	}
	function bottom(){
		include('themancode.php');
		$oid = $_GET['invoice'];
		$data = mysqli_fetch_array(mysqli_query($con,"select * from confirm where order_id='$oid' and status='pending' "));
		$amt = $data['price'];
		$date = $data['date'];
		$qty = $data['total_item'];
		$cpv = $data['coupon_value'];

		$bill = mysqli_query($con,"select * from order_items where order_id='$oid' and status='confirmed' ") or die(mysqli_error());
    $bill_amt = 0;
    while ($res = mysqli_fetch_array($bill)) {
        $bill_amt=$bill_amt+$res['price_num'];
    }
    $bill_amt;
    $gst = ($bill_amt*18)/100;
    $top = ($bill_amt+$gst)-$cpv;

$this->Ln(10);//Line break
$this->Cell(55, 5, 'Total Amount', 0, 0);
$this->Cell(58, 5, ": {$bill_amt}", 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'GST', 0, 0);
$this->Cell(58, 5, ":+{$gst}", 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'Coupon_value', 0, 0);
$this->Cell(58, 5, ":-{$cpv}", 0, 1);

$this->Ln(4);//Line break
$this->Cell(55, 5, 'Total Pay', 0, 0);
$this->Cell(58, 5, ":{$top}", 0, 1);

$this->Ln(10);//Line break
$this->SetFont('Times','B',12);
$this->Cell(55, 5, 'This is computer generated Receipt, no signature required', 0, 0);

	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($con);
$pdf->bottom();
$pdf->output();
}else{
	echo "Incorrect query";
}
}


 ?>