<?php
require 'DBConnect.php';

$sql = "SELECT ID, Description, Stock, Size, Price, ImagePath FROM shoes WHERE Stock in (SELECT MAX(Stock) FROM `shoes` GROUP BY Description) GROUP BY Description ORDER BY Stock DESC LIMIT 12";
$result = mysqli_query($dbhandle, $sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
		$outputstring ="Description: {$row["Description"]} - Size: {$row["Size"]} - Price: £{$row["Price"]}";
        echo "<div class=\"products\"><a onclick=\"callProductInfo(" . $row["ID"] . ")\" href=\"javascript:void(0);\"><img src=\"" . $row["ImagePath"] . "\"></a>  <br>" . htmlspecialchars($outputstring) . "</div>" ;
    }
} 
else 
{
    echo "0 results";
}
?>
