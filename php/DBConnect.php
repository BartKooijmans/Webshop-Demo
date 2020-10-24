<?php
$mydatabase='shoes';
$username='goldenshoe';
$password='TestGS';
$hostname = 'localhost';
$dbhandle = mysqli_connect( $hostname, $username, $password ) or die( "Unable to connect to MySQL");
$selected = mysqli_select_db(  $dbhandle, $mydatabase ) or die("Unable to connect to " . $mydatabase );
?>
