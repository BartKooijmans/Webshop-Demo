<form >
<?php
require 'DBConnect.php';

if(isset($_GET['filter']))
{
    $filters = $_REQUEST['filter'];
}
else{
	$filters = "All,0";
}

$filter = explode(",",$filters);

	echo '<label id="cLabel" for="Category">Filter by category: </label>';
	echo '<select id="Category">';	
	echo '<option value="All">All</option>';
	$sql = "SELECT DISTINCT Category FROM shoes";
	$result = mysqli_query($dbhandle, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			if($filter[0] == $row["Category"])
			{
				echo '<option value="' . $row["Category"] . '" selected="selected" >' .  $row["Category"] . '</option>';
			}
			else
			{
				echo '<option value="' . $row["Category"] . '">' .  $row["Category"] . '</option>';
			}
		}
	}
	echo '</select>';
	
	echo '<label for="Sizes"> Filter by size: </label>';
	echo '<select id="Sizes">';
	echo '<option value="0">All</option>';
	$sql = "SELECT DISTINCT Size FROM shoes";	
	$result = mysqli_query($dbhandle, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			if($filter[1] == $row["Size"])
			{
				echo '<option value="' . $row["Size"] . '" selected="selected" >' .  $row["Size"] . '</option>';
			}
			else
			{
				echo '<option value="' . $row["Size"] . '">' .  $row["Size"] . '</option>';
			}
		}
	}
	echo '</select>';
?>
 <button onclick="applyFilters()"> Apply Filters</button>
</form>
