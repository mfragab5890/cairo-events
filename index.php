<?php


    //  include("backend.php");

?>

<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.35">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Metal+Mania&display=swap" rel="stylesheet">
		<script type="text/javascript">

			$(window).load(function() {
			// Animate loader off screen
			$(".loading").fadeOut("slow");;
			});

		</script>

		<title>Cairo-Events</title>


		<style type="text/css">

			html{

				background: url(background.jpg) no-repeat;
				background-color:#021221;
				background-size: cover;
				width:100%;
				margin:0 auto;
				padding:0;
				text-align:center;
				height:2000px;

			}
			body{

				background-color:transparent;
				font-family: arial Black;
				text-align:center;
				width:100%;
				margin:0;
				padding:0;
			}

			.no-js #loader {
				display: none;
			}

			.js #loader {
				display: block;
				position: absolute;
				left: 100px;
				top: 0;
			}

			.loading {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url("loading.gif") center no-repeat #fff;
				background-size: 580px;
				background-color:white;
				font-size:75px;
				text-align: center;
				font-family: 'Metal Mania', cursive;
			}
			#container{
				display: grid;
				grid-template-columns: 1670px;
				padding: 0px;
				text-align:center;
				width:100%;
				margin:auto;
			}

			#logo{
				background-color:transparent;
				text-align: center;
				font-family: Bronzetti;
				margin-bottom:40px;
				margin-top:200px;
				line-height: 450%;

			}

			#screen{
				width:100%;
				padding;0px;
				border:4px #581B23 inset;
				border-radius:3%;
				background-color:#021221;
				margin:auto;
				display:none;
			}

			#seats{
				width:99%;
				margin:auto;
				border:4px #581B23 groove;
				border-radius:3.5%;
				padding:4px;
				background-color:#021221;

			}
			.back{
				padding:0px;
				margin:0px;
				width:80px;
				height:80px;
				background-color:transparent;
				color:white;
				border:0;
				position:relative;
				left:-790px;
			}
			.back2{
				padding:0px;
				margin:0px;
				width:80px;
				height:80px;
				background-color:transparent;
				color:white;
				border:0;
				position:relative;
				left:-460px;

			}

			.cat-walk{
				border:none;
				width:100%;
				height:113px;
				padding:1px;
				font-size:25px;
				font-weight:bold;
				margin:3px;
				background-image: url("cat walk.jpg");
				background-repeat: no-repeat;
				background-size: 100% 113px;
				background-color:transparent;
			}
			#keymap{
				padding:10px;
				width:100%;
				margin:3px;
				background-color:transparent;
				horizontal-align:center;
				text-align: center;
				clear:both;
				display:inline-block;
				color:white;

			}

			#form{
				padding:5px;
				background-color:#021221;
				margin:auto;
				border:4px #581B23 inset;
				border-radius:5%;
				width:60%;
				display:none;
			}

			.button{
				margin:1px;
				padding:1px;
				width:41px;
				height:41px;
				font-size:8px;
				font-weight:bold;
				margin-bottom:3px;
				vertical-align:top;
				background-color:white;
				opacity:0.2;
				border-radius:15%;
				border:1px #581B23 solid;

			}


			.clickable{
				border: none;
				cursor: default;
				opacity: 1;
			}
			.unclickable{
				border:none;
				background-image: url("X seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
				}
			.upperside{
				border:none;
			}
			.lowerside{
				-webkit-transform: rotate(180deg);
				-moz-transform: rotate(180deg);
				-ms-transform: rotate(180deg);
				-o-transform: rotate(180deg);
				transform: rotate(180deg);
			}
			.clicked{
				background-image: url("selected seat.png") !important;
			}
			.green{
			    background-image: url("5 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}
			.violet{
			    background-image: url("2 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}
			.orange{
			    background-image: url("1 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}
			.yellow{
			    background-image: url("6 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}
			.blue{
			    background-image: url("3 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}
			.red{
			    background-image: url("4 seat.png");
				background-repeat: no-repeat;
				background-size: 40px 40px;
			}

			#CCform
			{
				display:none;
			}

			.coredor{
			margin-left:15px;
			}

			.modal-body{
				text-align:left;
			}

			.caton{

				width:75%;
				background-color:#021221;
				color:white;
				font-size:37;
				border-radius:7%;
			}
			.control{

				width:49.17%;
				height:calc(1.5em + .75rem + 2px);
				padding:.375rem .75rem;
				font-size:1rem;
				font-weight:400;
				line-height:1.5;
				color:#495057;
				background-color:#fff;
				background-clip:padding-box;
				border:1px solid #ced4da;
				border-radius:.25rem;

				}

				.control2{

				width:40%;
				height:calc(1.5em + .75rem + 2px);
				padding:.375rem .75rem;
				font-size:1rem;
				font-weight:400;
				line-height:1.5;
				color:#495057;
				background-color:#fff;
				background-clip:padding-box;
				border:1px solid #ced4da;
				border-radius:.25rem;

				}
				.control3{

				width:91%;
				height:calc(1.5em + .75rem + 2px);
				padding:.375rem .75rem;
				font-size:1rem;
				font-weight:400;
				line-height:1.5;
				color:#495057;
				background-color:#fff;
				background-clip:padding-box;
				border:1px solid #ced4da;
				border-radius:.25rem;

				}

		</style>


	</head>

	<body>

		<div class="loading">
			<p>please wait while loading<p/>

		</div>


		<div id="container">

			<div id="logo">

				<p> <img src="logo-new.png" width="370px" height="370px" style="margin-bottom:30px;">
					<br><span id="enter" style="font-size:100px; color:white;">choose your class</span>
					<br><span style="font-size:38px; color:white;">you must be at least 16 years old.</span>
					<br><span style="font-size:28px; color:white;">DRESS CODE: HAUTE COUTURE/TUXEDO, FORMAL SOIREE/FORMAL SUITS.</span>
			</div>
			<div id="error"><?php  if (array_key_exists("error-msg", $_COOKIE) ) {
						echo '<div class="alert alert-danger" role="alert">'.$_COOKIE['error-msg'].'<br><br>
						<A HREF="https://karezma.co/cairo-events">submit another form</A></div>';
                        $sumbitted="yes";
					} ?></div>

					<div id="error"><?php  if (array_key_exists("success-msg", $_COOKIE) ) {
						echo '<div class="alert alert-success" role="alert">'.$_COOKIE['success-msg'].'<br><br><A HREF="https://karezma.co/cairo-events">submit another form</A></div>';
                        $sumbitted="yes";
					} ?></div>
			<div id="keymap" <?if($sumbitted=="yes"){echo'style="display:none;"';}?>>
					<button class="caton" value="violet"><img src="2 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">REGULAR 300LE <br>(Excluding party and dinner)</p></button>
					<br>
					<button class="caton" value="orange"><img src="1 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">REGULAR 500LE <br>(Excluding party and dinner)</p></button>
					<br>
					<button class="caton" value="green"><img src="5 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">REGULAR 600LE <br>(Excluding party and dinner)</p></button>
					<br>
					<button class="caton" value="yellow"><img src="6 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">VIP 700LE <br>(Including party and dinner)</p></button>
					<br>
					<button class="caton" value="blue"><img src="3 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">VIP+ 800LE <br>(Including party and dinner)</p></button>
					<br>
					<button class="caton" disabled><img src="4 seat.png" style="width:90px;height:90px; margin-right:100px; margin-top:20px; display:inline-block;vertical-align:top;"><p style="display:inline-block;vertical-align:top; width:600;">VIP Celebrities<br>(Including party and dinner)</p></button>
					<br>
			</div>

			<div id="screen">

				<button class="back"><p><img src="back-button-icon-png-15.jpg" width="60px" height="60px"><br>Back</p></button><br>
				<div id="seats">
				<?

					while($rowchair = mysqli_fetch_array($resultchair))
					{
						if($rowchair['id']!=297)
						{
							$code=$rowchair['code'];
							$code = substr($code, 1, 2);
							if($rowchair['status']=="avilable")
							{
								$color=$rowchair['color'];
								if($code!=11&&$code!=48&&$code!=28&&$code!=65)
								{
									echo'<button class="button clickable '.$color.'" value="'.$rowchair['price'].'$'.$rowchair['code'].'" "  ></button>';

								}
								else
								{
									echo'<button class="button clickable coredor '.$color.'" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " " ></button>';
								}
							}

							else if($rowchair['status']=="notavilable"||$rowchair['status']=="pending")
							{
								if($code!=11&&$code!=48&&$code!=28&&$code!=65)
								{
									$color=$rowchair['color'];
									echo'<button class="button unclickable" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' white white white;" ></button>';
								}
								else
								{
									$color=$rowchair['color'];
									echo'<button class="button unclickable coredor" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' white white white;" ></button>';
								}
							}
						}
						else
						{
							echo'<button class="cat-walk" disabled></button><br>';
							if($rowchair['status']=="avilable")
							{
								$color=$rowchair['color'];
								if($code!=11&&$code!=48&&$code!=27&&$code!=64)
								{
									echo'<button class="button clickable" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' ; background-color:'.$color.';" ></button>';
								}
								else
								{
									echo'<button class="button clickable coredor" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' ; background-color:'.$color.';" ></button>';
								}
							}
							else if($rowchair['status']=="notavilable"||$rowchair['status']=="pending")
							{
								if($code!=11&&$code!=48&&$code!=27&&$code!=64)
								{
									$color=$rowchair['color'];
									echo'<button class="button unclickable" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' white white white;" ></button>';
								}
								else
								{
									$color=$rowchair['color'];
									echo'<button class="button unclickable coredor" value="'.$rowchair['price'].'$'.$rowchair['code'].'" " style="color:'.$color.';border-color:'.$color.' ; background-color:'.$color.';" ></button>';
								}
							}

						}
					}
				?>

				</div>
				</div>

				<div id="form">

					<button class="back2"><p><img src="back-button-icon-png-15.jpg" width="60px" height="60px"><br>Back</p></button><br>


					<form method="post" id = "logInForm">

						<p></p>

						<fieldset class="form-group">

							<input class="form-control" id="first" type="text" placeholder="Full name" name="name" required>

						</fieldset>

						<fieldset class="form-group">

							<input class="form-control" type="tel" placeholder="01XXXXXXXXX" name="mobile" required>

						</fieldset>

						<fieldset class="form-group">

							<input class="form-control" type="email" placeholder="someone@email.com" name="mail" required>

						</fieldset>

						<fieldset class="form-group">
							<input class="form-control" type="text" placeholder="Current address" name="address" >
						</fieldset>


						<fieldset class="form-group" style="color:white;">
							Seat No.: <input id="seatNum" class="control3" type="text" name="seatcode" placeholder="selected chair" readonly required>
						</fieldset>

						<fieldset class="form-group" style="color:white;">
							Price: <input id="price" class="control2" type="text" name="price" placeholder="price" readonly required>
							Payment Fees: <input id="paymentFees" class="control2" type="text" name="fees" placeholder="payment fees" readonly >
						</fieldset>

						<fieldset class="form-group">
							<select id="options" class="form-control" name="paymentmethod" required>
								<option selected disabled>Choose payment option</option>
								<option value="Fawry">Fawry</option>
								<option value="Credit Card">Credit Card</option>
							</select>
						</fieldset>

						<div id="CCform">
							<fieldset class="form-group">
								<input id="ccn" class="form-control" type="text" pattern="[0-9]{16}" name="cardnumber" placeholder="enter your credit card number here" >
							</fieldset>

							<fieldset class="form-group">
								<input id="ccem" class="control" type="text" maxlength="2" size="2" pattern="[0-9]{2}" placeholder="MM" name="expirydatemonth" title="Enter a date in this format MM"/><span style="color:white;"> / </span><input id="ccey" class="control" type="text" maxlength="2" size="2" pattern="[0-9]{2}" placeholder="YY" name="expirydateyear" title="Enter a date in this format MM/YY"/>
							</fieldset>

							<fieldset class="form-group">
								<input id="ccc" class="form-control" type="number" name="cvv" pattern="[0-9]{2}" placeholder="CVV">
							</fieldset>
						</div>

						<fieldset class="form-group">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" style="color:white; background-color:transparent; border:0; padding:0;">
									<INPUT TYPE="checkbox" id="agree" name="Terms" VALUE="Conditions" required> I have read and agree to the following Terms & Conditions
								</button>
						</fieldset>

						<fieldset class="form-group">
								<input class="btn btn-success" type="submit" name="submit" value="submit">
						</fieldset>

					</form>

				</div>
			</div>


<!-- Modal -->
			<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">TERMS & CONDITIONS:- </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								<ul>
									<li>THIS (TICKETE) IS A MUST TO ALLOW YOUR ENTERY TO THE EVENT.</li>
									<li>THIS (TICKET) ALLOWS THE ENTERY OF ONLY ONE PERSON.</li>
									<li>KIDS BELOW 16 ARE NOT ALLOWED TO ENTER THE FASHION SHOW.</li>
									<li>PLEASE KEEP YOUR (TICKETE) WITH YOU AT ALL TIME.</li>
									<li>PLEASE ONLY SIT ON THE SEAT WRITTEN ON THE (TICKETE).</li>
									<li>PROFESSIONAL CAMERAS ARE NOT ALLOWED TO ENTER WITH THIS TYPE OF  TICKETE</li>
									<li>GATES WILL BE CLOSED AT 8:00pm.</li>
									<li>NO FOOD OR DRINKS ARE ALLOWED INSIDE THE BALLROOM.</li>
									<li>THE VIP TICKETES INCLUDED DINNER & PARTY </li>
								</ul><br>
								-DRESS CODE
								<ul>
									<li>HAUTE COUTURE/TUXEDO</li>
									<li>FORMAL SOIREE/FORMAL SUITS</li>
									</ul><br>
								*NO OTHER KIND OF CLOTHING WILL BE ALLOWED.


							</P>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Reject</button>
							<button type="button" onclick="check()" class="btn btn-primary" data-dismiss="modal">Accept</button>
						</div>
					</div>
				</div>
			</div>



	</body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
  <script src="main.js" async></script>
	<script type="text/javascript">
		function check()
		{
			document.getElementById("agree").checked = true;
		}


	</script>





</html>
