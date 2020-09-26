<?php
//fetch.php
 include("connection.php");
$columns = array(
				 'id',
				 'code',
				 'price',
				 'status',
				 'customer_name'
				   );

$query = "SELECT * FROM `chairs` ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE id LIKE "%'.$_POST["search"]["value"].'%" 
 OR code LIKE "%'.$_POST["search"]["value"].'%"  
 OR status LIKE "%'.$_POST["search"]["value"].'%" 
 OR customer_name LIKE "%'.$_POST["search"]["value"].'%" 

 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($link, $query));

$result = mysqli_query($link, $query . $query1);

$data = array();



while($row = mysqli_fetch_array($result))
{ 	


$querycustomer = "SELECT * FROM `customers` WHERE `id`='".$row['customer_id']."' ";
$resultcustomer = mysqli_query($link,$querycustomer);
$rowcustomer = mysqli_fetch_array($resultcustomer)  ;
 $sub_array = array();
 

 $sub_array[] =  $row["id"] ; 
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="reqdate">' . $row["code"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="reqdate">' . $row["price"] . '</div>';
 
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="qty">' . $row["status"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="deldate">' . $row["customer_name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="paid">' . $rowcustomer["mobile"] . '</div>';

 

 $data[] = $sub_array;
}




function get_all_data($link)
{
 $query = "SELECT * FROM `chairs`";
 $result = mysqli_query($link, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($link),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>


