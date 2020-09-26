<?php
include("connection.php");


$query ="select * from `chairs` where `customer_name`!='' ";
$result = mysqli_query($link,$query);
while($row = mysqli_fetch_array($result))
{
$query = "UPDATE chairs SET price='0' WHERE id = '".$row['id']."'";
 if(mysqli_query($link, $query))
 {
  echo 'Data Updated';
 }
	
}







?>