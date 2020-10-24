<?php
require 'DBConnect.php';
$discount = 0;
$voucherCode = "";

$sql = "SELECT Code, Amount FROM vouchers WHERE Code = $voucherCode";
$result = mysqli_query($dbhandle, $sql);
if($result)
{
	if ($result->num_rows > 0) 
	{
		$row1 = mysql_fetch_assoc($result);
		$discount += $row1["Amount"];
	}
}
?>
