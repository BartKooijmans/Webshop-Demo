<div class="orderdetails">

<?php
require 'DBConnect.php';
require 'Voucher.php';

$order = $_REQUEST['order'];
$order = str_replace("[","",$order);
$order = str_replace("]","",$order);
$order = str_replace("\"","",$order);
$order2 = explode(",",$order);
$grandtotal = 0;


for($i = 0; $i < (sizeof($order2) -1); $i+=2)
{
	$j = $i+1;
	$sql = "SELECT ID, Description, Stock, Price, Colour, ImagePath FROM shoes WHERE ID = $order2[$i]";
	$result = mysqli_query($dbhandle, $sql);
	if ($result->num_rows > 0) 
	{
		echo '<table>';
		echo '	<tr>';
		echo '		<th>Product</th>';
		echo '		<th>Price</th>';
		echo '		<th>Quantity</th>';
		echo '		<th>Total amount</th>';
		echo '		<th><th>';
		echo '</tr>';
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr>";			
				echo "<td>" . $row["Description"] . "</td>";
				echo "<td> &pound;" . $row["Price"] . "</td>";
				echo "<td>" . $order2[$j] . "</td>";
				echo "<td> &pound;" . $row["Price"]*$order2[$j] . "</td>";
				echo '<td><button onclick="removeBasket(' . $row["ID"] . ')">Remove from basket</button></td>';
			echo "</tr>";
			$grandtotal += ($row["Price"]*$order2[$j]);
		}
		echo "<tr>";			
			echo "<td></td>";
			echo "<td></td>";
			echo "<td><b>Grand total </b></td>";
			echo "<td><b> &pound;" . $grandtotal . "</b></td>";
		echo "</tr>";
		echo '</table>';
	}	
}

?>



	<br><br>
		<label for="vCode">Voucher code:</label><br>
		<input type="text" id="vCode" name="vCode"></input>
		<button onclick="applyVoucher()">Apply voucher</button>
	<div id="vStatus"></div>

<?php
if(isset($_GET['totaldiscount']))
{
    $totalDiscount = $_REQUEST['totaldiscount'];
}
else
{
	$totalDiscount = 0;
}
			echo "<table>	<tr>";	
			echo "<td><b>Voucher amount applied: </b></td>";
			echo " <td>&pound; " . $totalDiscount . "</td>";
			echo "</tr><tr>";
			echo "<td><b>Amount to be paid: <b></td>";
			echo "<td> &pound; " . ($grandtotal-$totalDiscount) . "</td>";
			echo "</table>	</tr>";
?>
</div>

<div class="payment">
<form action="JavaScript:placeOrder(<?php echo ($grandtotal-$totalDiscount) ?>)">
 <h3>Shipment details</h3>
 <label id="lname" for="name">Name: </label><input type="text" id="name" name="name"><br> 
 <label id="laddress" for="address">Address: </label><textarea id="address" name="address"></textarea><br>
 <label id="lpostcode" for="postcode">Postcode: </label><input type="text" id="postcode" name="postcode"><br>
 <label id="lcity" for="city">City: </label><input type="text" id="city" name="city"><br>
 <label id="lcountry" for="country">Country: </label><input type="text" id="country" name="country"><br>
 <label id="lphone" for="phone">Phone: </label><input type="tel" id="phone" name="phone"><br>
 <label id="lemail" for="email">E-mail: </label><input type="email" id="email" name="email"><br>
 
 <h3>Payment Details</h3>
 Amount to be paid: &pound;<?php echo ($grandtotal-$totalDiscount) ?> <br>
 <label id="lcardtype">Cardtype: </label>
 <select id="cardtype">
	<option value="Maestro">Maestro</option>
	<option value="Mastercard">Mastercard</option>
	<option value="Visa">Visa</option>
 </select><br>
 <label id="lcname" for="cname">Name on card: </label><input type="text" id="cname" name="cname"><br>
 <label id="lcaddress" for="caddress">Billing address: </label><textarea id="caddress" name="caddress"></textarea><br>
 <label id="lcardnumber" for="cardnumber">Cardnumber: </label><input type="text" id="cardnumber" name="cardnumber"><br>
 <label id="lcdate" for="cdate">Expiration date: </label><input type="date" id="cdate" name="cdate"><br>
 <label id="lsecuritycode" for="securitycode">Security code: </label><input type="text" id="securitycode" name="securitycode"><br>
 <input type="submit" value="Place order">
</form>
</div>

 
 
 
 