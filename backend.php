<?php
 session_start();
      include("connection.php");
$error='';
$success='';
$sumbitted='';
 if (array_key_exists("submit", $_POST)) {
	 if (!$_POST['name']) {
            
            $error .= "Your name  is required <br> ";
            
        } 
		if (!$_POST['mobile']) {
            
            $error .= "your mobile  is required <br> ";
            
        }else{
			$querymobile ="select * from `customers` where `mobile`='".$_POST['mobile']."' ";
            $resultmobile = mysqli_query($link,$querymobile);
			$rowmobile = mysqli_fetch_array($resultmobile);
			if($rowmobile['id']){
				 $error .= "This mobile  is already registered <br> ";
			}
		}
		
		if (!$_POST['mail']) {
            
            $error .= "your E-mail  is required <br> ";
            
        }
		if (!$_POST['seatcode']) {
            
            $error .= "seat code  is required <br> ";
            
        }else{
			$queryseat ="select * from `chairs` where `code`='".$_POST['seatcode']."' ";
            $resultseat= mysqli_query($link,$queryseat);
			$rowseat = mysqli_fetch_array($resultseat);
			if($rowseat['status']!="avilable"){
				 $error .= "This seat is not avilable <br> ";
			}
			
		}
		if (!$_POST['price']) {
            
            $error .= "price  is required <br> ";
            
        }
		if (!$_POST['paymentmethod']) {
            
            $error .= "paymentmethod  is required <br> ";
            
        }else {
			if($_POST['paymentmethod']=="Credit Card")
			{
				if (!$_POST['cardnumber']) {
            
					$error .= "Card Number  is required <br> ";
            
                   }
				 if (!$_POST['expirydatemonth']) {
            
					$error .= "Expiry Date month  is required <br> ";
            
                   }
				   if (!$_POST['expirydateyear']) {
            
					$error .= "Expiry Date year  is required <br> ";
            
                   }
				 if (!$_POST['cvv']) {
            
					$error .= "CVV  is required <br> ";
            
                   }
			}
		}
		
		
		if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            setcookie("error-msg", $error, time() + 5);
            header("Location: #");
        } else {
			
			$query="INSERT INTO `customers`
			(`id`, `name`, `mobile`, `email`, `address`)
			VALUES
			(NULL,
			'".mysqli_real_escape_string($link, $_POST['name'])."',
			'".mysqli_real_escape_string($link, $_POST['mobile'])."',
			'".mysqli_real_escape_string($link, $_POST['mail'])."',
			'".mysqli_real_escape_string($link, $_POST['address'])."'
			)";
			 if(!mysqli_query($link, $query))  
			  {  $error = "can't submit  <br> ";
							   
			  }else
			  {
				  
		       $querycustomer = "SELECT * FROM `customers` ORDER By id DESC LIMIT 1";
			   $resultcustomer = mysqli_query($link, $querycustomer);
			   $rowcustomer = mysqli_fetch_array($resultcustomer);
			   
			 $query = "UPDATE chairs SET status='pending',customer_id='".$rowcustomer['id']."',customer_name='".$rowcustomer['name']."' WHERE code = '".$_POST["seatcode"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update chair  <br> "; 
			 }
			 $amount= $_POST['price']+($_POST['price']*(3/100)+4);
			 $amount= number_format((float)$amount, 2, '.', '');
			 $extrafess=$_POST['price']*(3/100)+4;
			 
			 $query="INSERT INTO `payment_request` (`id`, `payment_method`, `customer_id`, `customer_name`, `amount`, `chair_id`, `status`) VALUES 
			  (NULL,
			  '".mysqli_real_escape_string($link, $_POST['paymentmethod'])."',
			  '".$rowcustomer['id']."',
			  '".$rowcustomer['name']."',
			  '".$amount."',
			  '".$rowseat['id']."',
			  'Sent'
			  );";
			  
			  }
			  if(mysqli_query($link, $query))
			 {
			 $success = "<p>payment insert successfully <p>";
			 }
			 $queryoperation = "SELECT * FROM `payment_request` ORDER By id DESC LIMIT 1";
			 $resultoperation = mysqli_query($link, $queryoperation);
			 $rowoperation = mysqli_fetch_array($resultoperation);
			 	
				$merchant_code= 'INaLF12gHAqa';
			    $merchant_reference_id= $rowoperation['id'];
			    $customer_merchant_profile_id= $rowcustomer['id'];
			    $customer_name=$rowcustomer['name'];
			    $customer_mobile= $rowcustomer['mobile'];
			    $customer_email= $rowcustomer['email'];
			
			if($_POST['paymentmethod']=="Fawry")
			{
				
				
				$client = new http\Client;
				$request = new http\Client\Request;


		        $payment_method= 'PAYATFAWRY';
				$currency_code = 'EGP';
				$securehas="$2y$10$/6YL7ln9K.viLqHTbN0/hO9z18dHHC9LYEAu5eMk86GCemcPGj1/m";
				$signature=$merchant_code.$merchant_reference_id.$customer_merchant_profile_id.$payment_method.$amount.$securehas ;
			    $signature=hash('sha256',$signature );
				
				$request->setRequestUrl('https://cowpay.me/api/fawry/charge-request');
				$request->setRequestMethod('POST');
				$request->setQuery(new http\QueryString(array(
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
				)));

				$request->setHeaders(array(

				  'Content-Type' => 'application/json',
				  'Accept' => 'application/json'
				));

				$client->enqueue($request)->send();
				$response = $client->getResponse();
				$array= $response->getbody();
				echo $response->getresponseCode();
				echo "<br>".$array;
				$responsecode=$response->getresponseCode();
				$array=json_decode($response->getbody(), true);
				if($responsecode=="200"){
		$fawrycode=$array['payment_gateway_reference_id'];
		$emailTo = $rowcustomer['email'];
        $subject = "Cairo Events Fashion Show";
        $content = "Hello ".$rowcustomer['name'].",

Thanks for Booking your chair in our fashion show we hope you enjoy it

your reservation request to Cairo gates has been sent successfully  
your chair no. is : ".$_POST['seatcode']."
ticket fees: ".$_POST['price']." LE
online payment fees: ".$extrafess." LE
required fees :".$amount." LE 
payment method: PAYATFAWRY
fawry code: ".$fawrycode."
reservation status: Waiting Payments

you must pay in fawry within 48 hours or your reservation will be cancelled

Payment Steps:
* Go to any Fawry retail store
* Choose 'Fawry Pay | فورى باى' from the main menu
* Choose Pay by Reference number 
* Enter the reference number: REF_NUM (Also sent through email)
* Make sure your data is correct
* Pay and keep the receipt

خطوات الدفع:
* انتقل إلى أي متجر للبيع بالتجزئة في فوري
* أختر 'فورى باى' من القائمة الرئيسية
* اختر الدفع باستخدام الكود او الرقم المرجعى
* أدخل الرقم المرجعي: REF_NUM (ريد الإلكتروني والرسائل النصية القصيرة)
* تأكد من صحة البيانات الخاصة بك
* ادفع وحافظ على الايصال

Cairo Gate Events
thank you";
        $headers = "From: info@cairogates.com ";
            
            if (mail($emailTo, $subject, $content, $headers)) {
                
                $success .= 'email sent  <br> your fawry code is : '.$fawrycode.'<br> ';
                $success.="Payment Steps:<br>
* Go to any Fawry retail store<br>
* Choose 'Fawry Pay | فورى باى' from the main menu<br>
* Choose Pay by Reference number <br>
* Enter the reference number: REF_NUM (Also sent through email )<br>
* Make sure your data is correct<br>
* Pay and keep the receipt<br>
";
              setcookie("success-msg", $success, time() + 5);
              header("Location: #");  
            }
			}else
	             {
			$query = "UPDATE chairs SET status='avilable',customer_id='0',customer_name='' WHERE code = '".$_POST["seatcode"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update chair  <br> "; 
			 }

			 $query = "UPDATE payment_request SET status='Failed' WHERE id = '".$rowoperation["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update chair  <br> "; 
			 } 
			 
			 $query="DELETE FROM `customers` WHERE `customers`.`id` =".$rowcustomer['id'].";";
			 if(mysqli_query($link, $query))
			 {
			 
			 }else{
				 $error = "can't delet customer  <br> "; 
			 } 
				$error ="payment failed please try again later <br>"	;
				 $errors=$array["errors"];
				 $arraykey=array_keys($errors);
				 $arraylenght= count($errors);
				 for ($x = 0; $x < $arraylenght; $x++) {
					
					$error .= $errors[$arraykey[$x]]."<br>";
				 }		 
				 setcookie("error-msg",$error , time() + 5);
                 header("Location: #");
			    }
		
		
		}else if($_POST['paymentmethod']=="Credit Card")
		{
			  
				$client = new http\Client;
				$request = new http\Client\Request;

			  $payment_method= 'CARD';
			  $card_number=$_POST['cardnumber'];
			  $expiry_year= $_POST['expirydateyear'];
			  $expiry_month=$_POST['expirydatemonth'];
			  $cvv=$_POST['cvv'];
			  $save_card= '0';
			  $amount= $amount;
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
			
            $customercode=	(($rowseat['id']*121)+67)*2;
			$query = "UPDATE chairs SET status='notavilable' WHERE code = '".$_POST["seatcode"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update chair  <br> "; 
			 }

			 $query = "UPDATE payment_request SET status='Paid' WHERE id = '".$rowoperation["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update operation  <br> "; 
			 } 
			 
	

		$emailTo = $rowcustomer['email'];
        $subject = "Cairo Events Fashion Show";
        $content = "Hello ".$rowcustomer['name']."

thanks for Booking your chair in our fashion show we hope you enjoy it

your reservation request to Cairo gates has been sent successfully  
your chair no. is : ".$_POST['seatcode']."
ticket fees: ".$_POST['price']." LE
online payment fees: ".$extrafess." LE
required fees :".$amount." LE 
payment method: Credit Card
reservation status: PAID
Enterance code= ".$customercode."


Cairo Gate Events
thank you";
        $headers = "From: info@cairogates.com ";
            
            if (mail($emailTo, $subject, $content, $headers)) {
                
                $success .= 'email sent  <br> your payment done successfully<br>Enterance code= '.$customercode.' <br> KEEP IT';
                
              setcookie("success-msg", $success, time() + 5);
              header("Location: #");  
            }
			}
			else{
				
				
			$query = "UPDATE chairs SET status='avilable',customer_id='0',customer_name='' WHERE code = '".$_POST["seatcode"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update chair  <br> "; 
			 }

			 $query = "UPDATE payment_request SET status='Failed' WHERE id = '".$rowoperation["id"]."' ";
			 if(mysqli_query($link, $query))
			 {
			 $success = "<p>sumbitted successfully <p>";
			 }else{
				 $error = "can't update operation  <br> "; 
			 } 
			 
			 $query="DELETE FROM `customers` WHERE `customers`.`id` =".$rowcustomer['id'].";";
			 if(mysqli_query($link, $query))
			 {
			 
			 }else{
				 $error = "can't delet customer  <br> "; 
			 } 
				$error ="payment failed please try again later <br>"	;
				 $errors=$array["status_description"];
                 $error .= $errors."<br>";		 
				 setcookie("error-msg",$error , time() + 5);
                 header("Location: #");
	
			}
			
		}
				
		}
 }
 


$querychair ="	select * from `chairs`";
													
$resultchair= mysqli_query($link,$querychair);



?>