<?php
require 'DBConnect.php';

if(isset($_GET['filter']))
{
    $filters = $_REQUEST['filter'];
}
else{
	$filters = "All,0";
}

$where = "";
$filter = explode(",",$filters);
if($filter[0] == "All" && $filter[1] == 0)
{

}
else if($filter[0] == "All")
{
	$where = " WHERE Size =" . $filter[1];
}
else if($filter[1] == 0)
{
	$where = " WHERE Category =\"" . $filter[0] . "\"";
}
else
{
	$where = " WHERE Category =\"" . $filter[0] . "\" AND " . "Size =" . $filter[1];
}

$sql = "SELECT ID, Size, Price, Description, ImagePath FROM shoes" . $where;
$result = mysqli_query($dbhandle, $sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
		$outputstring ="Description: {$row["Description"]} - Size: {$row["Size"]} - Price: £{$row["Price"]}";
        echo "<div class=\"shopproducts\"><a onclick=\"callProductInfo(" . $row["ID"] . ")\" href=\"javascript:void(0);\"><img src=\"" . $row["ImagePath"] . "\"></a>  <br>" . htmlspecialchars($outputstring) . "</div>" ;
    }
} 
else 
{
    echo "0 results";
}
?>
