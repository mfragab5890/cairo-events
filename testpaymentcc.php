<?php





$client = new http\Client;
$request = new http\Client\Request;


  $merchant_code= 'INaLF12gHAqa';
  $merchant_reference_id= '12247778';
  $customer_merchant_profile_id= '586966';
  $customer_name='amr telp';
  $customer_mobile= '01120802222';
  $customer_email= 'amr_tlep@hotmail.com';
  $payment_method= 'CARDd';
  $card_number="4005550000000001";
  $expiry_year= "21";
  $expiry_month="05";
  $cvv="123";
  $save_card= '0';
  $amount= '10.00';
  $currency_code = 'EGP';
  $securehas="$2y$10$/6YL7ln9K.viLqHTbN0/hO9z18dHHC9LYEAu5eMk86GCemcPGj1/m";
  $signature=$merchant_code.$merchant_reference_id.$customer_merchant_profile_id.$payment_method.$amount.$securehas ;
  
$signature=hash('sha256',$signature );


$body = new http\Message\Body;
$body->addForm(array(
  'merchant_code' => $merchant_code,
  'customer_name' => $customer_name,
  'customer_mobile' => $customer_mobile,
  'customer_email' => $customer_email,
  'customer_merchant_profile_id' => $customer_merchant_profile_id,
  'card_number' => $card_number,
  'expiry_year' => $expiry_year,
  'expiry_month' => $expiry_month,
  'cvv' => $cvv,
  'save_card' => '0',
  'merchant_reference_id' => $merchant_reference_id,
  'amount' => $amount,
  'currency_code' => $currency_code,
  'signature' => $signature,
  'payment_method' => $payment_method
), NULL);

$request->setRequestUrl('https://cowpay.me/api/fawry/charge-request-cc');
$request->setRequestMethod('POST');
$request->setBody($body);


$client->setCookies(array(
  'laravel_session' => 'RzYk87RLN0ieyahk2XvWxzjyaGeGuImuwWF0IY5X'
));

$client->enqueue($request)->send();
$response = $client->getResponse();


$array= $response->getbody();
$responsecode=$response->getresponseCode();
$array=json_decode($response->getbody(), true);

if($responsecode=="200"){
	echo "<br>success";
}
else{
	$errors=$array["status_description"];

    echo $errors."<br>";
}

?>