<?php
sleep(1);
if(isset($_POST["botquery"]))
{
include'themancode.php';



$query = mysqli_real_escape_string($con,$_POST["botquery"]);
$tags = explode(" ",$query);
$list = array();
$row="";
foreach($tags as $i =>$key) {
$i >0;

$list[$i] = $key;
$data = "SELECT name,title,price,type,qty,brief_info,category,slug,image,'items' FROM items where category like '%$list[$i]%' or price like '%$list[$i]%' or sub_cat like '$list[$i]%' or type like '$list[$i]%' or name like '%$list[$i]%' or name like '%$query%' or order_now like '%$list[$i]%'";
$sql =  mysqli_query($con,$data);
}

// $data = "SELECT ssid,question,answer ,'training_data' FROM training_data where question like '%$query%' ";


@$row = mysqli_fetch_array($sql);
@$count = mysqli_num_rows($sql);
if($count>0 && $row==true)
{

    if(isset($row['name'])!='' && isset($row['image'])!='')
    {
        while($row = mysqli_fetch_array($sql)){
       echo $row['name'].'<br/><a href="product_details.php?&slug-id='.$row['slug'].'&type='.$row['type'].'"><img src="product/'.$row['image'].'"  class="img-responsive img-fluid rounded mb-2" width="200" height="200"></a>';
}

    }else if(isset($row['title']))
    {
       echo $row['title'];
    }else if(isset($row['price']))
    {
       echo $row['price'];
    }else if(isset($row['type']))
    {
       echo $row['type'];
    }else if(isset($row['category']))
    {
       echo $row['category'];
    }else if(isset($row['brief_info']))
    {
       echo $row['brief_info'];

    }else if(isset($row['answer']))
    {
       echo $row['answer'];
    }

    
}else{
    echo "Sorry, i am not able to find";
}
}




sleep(1);
if(isset($_POST["query"]))
{
 include 'themancode.php';
$query = mysqli_real_escape_string($con,$_POST["query"]);
$proID = mysqli_real_escape_string($con,$_POST["proID"]);

$tags = explode(" ",$query);
$list = array();
$row="";
foreach($tags as $i =>$key) {
$i >0;

$list[$i] = $key;
$data = "SELECT name,title,price,type,qty,brief_info,'trending_item' FROM trending_item where id=$proID and name='$list[$i]' or qty='$list[$i]' or cat_price='$list[$i]' or stock='$list[$i]' ";
$sql =  mysqli_query($con,$data);
}
$row = mysqli_fetch_array($sql);
$count = mysqli_num_rows($sql);
if($count>=0 && $row==true)
{
    if($row['name']!='')
    {
        echo $row['name'];
        echo "</br>";
        echo $row['price'];
    }else if($row['title']!='')
    {
        echo $row['title'];
    }
    else if($row['price']!='')
    {
        echo $row['price'];
    }
    else if($row['qty']!='')
    {
        echo $row['qty'];
    }

    
}else{
    echo "Sorry, i am not able to find";
}
}
?>