	
	
	function zoomOutMobile() 
	{
		var viewport = document.querySelector('meta[name="viewport"]');

		if ( viewport ) 
		{
			viewport.content = "initial-scale=1";
			viewport.content = "width=100";
			$('html,body').animate({
			scrollTop: $("#form").offset().top},
			'slow');
	
		}
	}
	
	$(window).load(function() {
			zoomOutMobile();
			});
	
	
	
	$(".back").click(function()
	{
		$("#screen").hide();
		$("#keymap").show();
		$("#form").hide();
		document.getElementById("enter").innerHTML = "Choose your class";
		zoomOutMobile();
		$('html,body').animate({
			scrollTop: $("#keymap").offset().top},
			'slow');
	});
	
	$(".back2").click(function()
	{
		$("#screen").show();
		$("#keymap").hide();
		$("#form").hide();
		document.getElementById("enter").innerHTML = "Choose your seat";
		zoomOutMobile();
		$('html,body').animate({
			scrollTop: $("#screen").offset().top},
			'slow');
	});
	
	$('.caton').on('click', function()
	{
		var clr = $(this).val();
		clr = "." + clr;
		$(".clickable").removeClass("clickable");	
	    $(clr).addClass("clickable");
		$("#screen").show();
		$("#keymap").hide();
		document.getElementById("enter").innerHTML = "Choose your seat";
		zoomOutMobile();
		
	});
	
	

	$('.clickable').on('click',function()
	{ 	
		var alltext = $(this).val();
		$(".clicked").removeClass("clicked");	
		$(this).addClass("clicked");
		if(confirm("Do You want to choose this seat?"))
		{
			zoomOutMobile();
			$("#screen").hide();
			$("#form").show();
			document.getElementById("enter").innerHTML = "Please fill your data";
			$('html,body').animate({
			scrollTop: $("#form").offset().top},
			'slow');
			var price = alltext.substring(0, alltext.indexOf("$"));
			var seatNum =alltext.substring(alltext.indexOf("$") + 1)
			var paymentFees = (price*"0.03")+3;
			
			document.getElementById("price").value = price;
			document.getElementById("seatNum").value = seatNum; 
			document.getElementById("paymentFees").value = paymentFees;	
		}
		
	
	});
	
	
	
	document.getElementById("options").onchange = function()
	{
		var sel = document.getElementById('options').value;
		if(sel == "Credit Card")
		{
			document.getElementById("CCform").style.display = "inline";
			document.getElementById("cco").setAttribute("required","false");
			document.getElementById("ccn").setAttribute("required","false");
			document.getElementById("ccem").setAttribute("required","false");
			document.getElementById("ccey").setAttribute("required","false");
			document.getElementById("ccc").setAttribute("required","false");
		}
		else
		{
			document.getElementById("CCform").style.display = "none";
		}
	}
	
		$('.btn-primary').on('click',function()
	{ 	
		
		zoomOutMobile();
		
	});
	
	
	
	
function hidekeymap()
{
	
}

	
	