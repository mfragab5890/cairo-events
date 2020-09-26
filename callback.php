<?php
date_default_timezone_set("Africa/Cairo"); 
  $data['file']="opened";
  
  $entityBody = file_get_contents('php://input');
$data['body']= $entityBody;
$data['body']=json_decode($data['body'], true);
$data['cowpay_reference_id']='';
$data['cowpay_reference_id']=$data['body']['cowpay_reference_id'];


  if($data['cowpay_reference_id']!='')
{
  include("connection.php");
  $data['merchant_reference_id']=$data['body']['merchant_reference_id'];
  $data['order_status']=$data['body']['order_status'];
  $data['signature']=$data['body']['signature'];

$queryrequest = "SELECT * FROM `payment_request` WHERE id='".$data["merchant_reference_id"]."'";
$resultrequest = mysqli_query($link, $queryrequest);
$rowrequest = mysqli_fetch_array($resultrequest);

$securhash="$2y$10$/6YL7ln9K.viLqHTbN0/hO9z18dHHC9LYEAu5eMk86GCemcPGj1/m";
$amount=$rowrequest['amount'];
$amount= number_format((float)$amount, 2, '.', '');

$signature=$securhash.$amount.$data["cowpay_reference_id"].$data["merchant_reference_id"].$data["order_status"];

$signature=hash('md5',$signature );
$data['signaturelocal']=$signature;
 if($signature==$data["signature"])
 {
 
$querychair = "SELECT * FROM `chairs` WHERE id='".$rowrequest["chair_id"]."'";
$resultchair = mysqli_query($link, $querychair);
$rowchair = mysqli_fetch_array($resultchair);
if($rowchair['status']!="notavilable")
{   if($data["order_status"]=='PAID')
{
	$query = "UPDATE chairs SET status='notavilable' WHERE id = '".$rowchair["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $data['paid']="success";
			 }else{
			 $data['paid']="failed";
			 }
			 
	$query = "UPDATE payment_request SET status='Paid' WHERE id = '".$rowrequest["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			$data['operation']="success";
			 }else{
			$data['operation']="failed";
			 } 
			 
     }else if($data["order_status"]=='EXPIRED'){
		 
		 $query = "UPDATE chairs SET status='avilable' WHERE id = '".$rowchair["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			  $data['expired']="success";
			 }else{
			  $data['expired']="failed";
			 }
			 
			 $query = "UPDATE payment_request SET status='Expired' WHERE id = '".$rowrequest["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			$data['operation']="success";
			 }else{
			$data['operation']="failed";
			 }
			 
	 }
}else {
	if($data["order_status"]=='PAID')
		{
			$query = "UPDATE payment_request SET status='double payment' WHERE id = '".$rowrequest["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			$data['operation']="success";
			 }else{
			$data['operation']="failed";
			 }
		}	
	
	}
			   
}else{
	$data['signature']="failed";
}
}
$text=json_encode($data);
 
 
 $query="INSERT INTO `request_log` (`id`, `created_on`, `body`) VALUES (NULL, '".date("Y-m-d H:i:s")."', '".mysqli_real_escape_string($link, $text)."')";
			 if(!mysqli_query($link, $query))  
			  {  	$data['log']="failed";
			   
			  }else{$data['log']="success";}
			  
			   echo json_encode($data);
?>
