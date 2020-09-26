<?php


 $merchant_code= 'INaLF12gHAqa';
  $merchant_reference_id= '569933347';
  $customer_merchant_profile_id= '586966';
  $customer_name='amr%20telp';
  $customer_mobile= '01120802222';
  $customer_email= 'amr_tlep@hotmail.com';
  $payment_method= 'PAYATFAWRY';
  $amount= '10.00';
  $currency_code = 'EGP';
  $securehas="$2y$10$/6YL7ln9K.viLqHTbN0/hO9z18dHHC9LYEAu5eMk86GCemcPGj1/m";
  $signature=$merchant_code.$merchant_reference_id.$customer_merchant_profile_id.$payment_method.$amount.$securehas ;
  
$signature=hash('sha256',$signature );

$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->addForm(array(
'merchant_code' =>$merchant_code,
  'merchant_reference_id' => $merchant_reference_id,
  'customer_merchant_profile_id' => $customer_merchant_profile_id,
  'customer_name' => $customer_name,
  'customer_mobile' => $customer_mobile,
  'customer_email' => $customer_email,
  'payment_method' => $payment_method,
  'amount' => $amount,
  'currency_code' =>$currency_code,
  'signature' => $signature
), NULL);

$request->setRequestUrl('https://cowpay.me/api/fawry/charge-request');
$request->setRequestMethod('POST');
$request->setBody($body);




$client->enqueue($request)->send();
$response = $client->getResponse();

//print_r($response);
$array= $response->getbody();
//echo $response->getresponseCode();
$responsecode=$response->getresponseCode();
echo $array;
$array=json_decode($response->getbody(), true);

//echo "<br>".$errors[1];
if($responsecode=="200"){
	echo "<br>success";
}
else{
	$errors=$array["errors"];
$arraykey=array_keys($errors);
$arraylenght= count($errors);
echo $array["status_description"];
for ($x = 0; $x < $arraylenght; $x++) {
    echo $errors[$arraykey[$x]]."<br>";
}
	echo "<br>failed";
	}

?>