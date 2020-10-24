<?php
require 'DBConnect.php';
$voucherCode = "";
if(isset($_GET['code']))
{
    $voucherCode = $_REQUEST['code'];
}
$sql = "SELECT Code, Amount, Used FROM vouchers WHERE Code = '" . $voucherCode . "'";
$result = mysqli_query($dbhandle, $sql);

if($result)
{
	
	if ($result->num_rows > 0) 
	{
		$row1 = $result -> fetch_assoc();
		if($row1["Used"] == 0)
		{
			$discount = $row1["Amount"];
			echo '<input type="hidden" id="vdiscount" value="' . $discount . '">';
			$sql1 = "UPDATE vouchers SET Used=1 WHERE Code = '" . $voucherCode . "'";
			if ($dbhandle->query($sql1) === TRUE) {
			}
		}
	}
}
?>
