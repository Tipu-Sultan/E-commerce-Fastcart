<?php 
sleep(1);
include '../themancode.php';
$xls = mysqli_query($con,"select * from redcart");
$output = '<table class="table table-bordered"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>OTP</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>';
while($row = mysqli_fetch_array($xls))
{
	 $output.= "<tr>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['mobile']}</td>
            <td>{$row['address']}</td>
            <td>{$row['otp']}</td>
            <td>{$row['status']}</td>
            </tr>";
}
 header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=report.xls');
$output.='</table>';
echo $output;
 ?>