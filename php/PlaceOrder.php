<?php 
require 'DBConnect.php';


$order = $_REQUEST['order'];
$order = str_replace("[","",$order);
$order = str_replace("]","",$order);
$order = str_replace("\"","",$order);
$order2 = explode(",",$order);

$amount = $_REQUEST['amount'];
$name = $_REQUEST['name'];
$address = $_REQUEST['address'];
$postcode = $_REQUEST['postcode'];
$city = $_REQUEST['city'];
$country = $_REQUEST['country'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$cardtype = $_REQUEST['cardtype'];
$cname = $_REQUEST['cname'];
$caddress = $_REQUEST['caddress'];
$cardnumber = $_REQUEST['cardnumber'];
$cdate = $_REQUEST['cdate'];
$securitycode = $_REQUEST['securitycode'];
$last_c_id = 0;
$last_o_id = 0;
$last_p_id = 0;

$sql = "INSERT INTO customers (Name, Address, Postcode, City, Country, Phone, Email) VALUES ('$name', '$address', '$postcode', '$city', '$country', '$phone', '$email')";
if ($dbhandle->query($sql) === TRUE) {
  $last_c_id = $dbhandle->insert_id;
}
else
{
	echo "Error: " . $sql . "<br>" . $dbhandle->error;
}
if($last_c_id != 0)
{
	$sql2 = "INSERT INTO orders (CustomerID, Amount) VALUES ($last_c_id, $amount)";
	if ($dbhandle->query($sql2) === TRUE) {
	  $last_o_id = $dbhandle->insert_id;
	}
	else
	{
		echo "Error: " . $sql2 . "<br>" . $dbhandle->error;
	}
}

if($last_c_id != 0 && $last_o_id != 0)
{
	for($i = 0; $i < (sizeof($order2) -1); $i+=2)
	{
		$j = $i+1;
		$sql3 = "INSERT INTO orderitems (OrderID, ItemID, Quantity) VALUES ($last_o_id, $order2[$i], $order2[$j])";
		if ($dbhandle->query($sql3) != TRUE)
		{
			echo "Error: " . $sql3 . "<br>" . $dbhandle->error;
		}
	}
}

if($last_c_id != 0 && $last_o_id != 0)
{
	$sql4 = "INSERT INTO payment (Amount, CustomerID, CardType, ExpDate, NameCard, CardNumber, SecurityCode, OrderID, Status) 
	VALUES ($amount, $last_c_id, '$cardtype', '$cdate', '$cname', '$cardnumber', '$securitycode', $last_o_id ,0)";
	if ($dbhandle->query($sql4) === TRUE) {
	$last_p_id = $dbhandle->insert_id;
	echo '<h1>Payment succesful</h1><br>';
	echo '<h3>Payment reference is '. $last_p_id . '</h3>';
	}
	else
	{
		echo "Error: " . $sql4 . "<br>" . $dbhandle->error;
	}
}

?>