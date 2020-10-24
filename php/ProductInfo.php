<?php
require 'DBConnect.php';

$ID = $_REQUEST['ID'];


$sql = "SELECT ID, Description, Size, Stock, Price, Colour, ImagePath FROM shoes WHERE ID = '$ID'";
$result = mysqli_query($dbhandle, $sql);

	$row1 = $result -> fetch_assoc();
	echo '<div class="pDescription">';
	echo '<img src="' . $row1['ImagePath'] . '"><br>' ;
	echo '<p><b>Description: </b>' . $row1['Description'] . '</p>';
	$temp = $row1['Description'];
	
	echo '<label for="shoeSizeSizes"><b> Size: </b></label>';
	echo '<select id="shoeSize" onchange="checkDifferentSize()">';
	$sql2 = 'SELECT DISTINCT ID, Description, Size FROM shoes WHERE Description = "' . $temp . '"';
	$result2 = mysqli_query($dbhandle, $sql2);
	if ($result2->num_rows > 0) {
		// output data of each row
		while($row = $result2->fetch_assoc()) 
		{
			if($row1['Size'] == $row["Size"])
			{
				echo '<option value="' . $row["ID"] . '" selected="selected" >' .  $row["Size"] . '</option>';
			}
			else
			{
				echo '<option value="' . $row["ID"] . '">' .  $row["Size"] . '</option>';
			}
		}
	}
	echo '</select>';
	echo '<br>';
	echo '<b>Price per pair:</b> &pound;' . $row1['Price'] . '<br>' ;
	echo '<b>In Stock: </b>' . $row1['Stock'] . '<br>';
	echo '<label for="quantity"><b> How many would you like to order?: </b></label>';
	echo '<input id="quantity" type="number" min="1" value="1"><br>';
	echo '<button onclick="addBasket('. $row1['ID'] . ')">Add to basket</button>';
	echo '</div>';
?>