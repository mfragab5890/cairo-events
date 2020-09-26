if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
	
	
	document.getElementById("barcode")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("button-barcode").click();
    }
});
	
	document.getElementById(barcode.id).focus();
    document.getElementById(barcode.id).select();
	
	
}

 function purchaseClicked() {

	var customer = document.getElementById('make').value
	if(customer=='' ||customer==null ){
		alert("please enter the customer name")
		return
	}
	var subtotal= document.getElementById('cart-total').innerHTML
	subtotal = subtotal.substring(subtotal.indexOf("$") + 1);
	var discount= document.getElementById('cart-discount').innerHTML
	discount = discount.substring(discount.indexOf("$") + 1);
	var total= document.getElementById('cart-finaltotal').innerHTML
	total = total.substring(total.indexOf("$") + 1);
	
	/*alert(subtotal)
	alert(discount)
	alert(total)*/
	checkavilability(customer,subtotal,discount,total);
	
	//mainorder(customer,subtotal,discount,total);

   

 
   
	   
   
		     
	

	   
   

	
    //alert('Thank you for your purchase')

}



function mainorder(customer,subtotal,discount,total,avl_qty)
{
	
	if(avl_qty>0){
		
		//alert(avl_qty)
		alert("Cannot procced ,please edit your order")
		return
	}else {
		alert("All items avilable in the inv")
	}
	var mainorder='';
	$.ajax({
    url:"mainorder.php",
    method:"POST",
    data:{

		  customer:customer,
		  subtotal:subtotal,
		  discount:discount,
		  total:total	  
},
    dataType:"JSON",
    success:function(data)
    {  // alert(JSON.stringify(data));    
        var mainorder=data["mainorderid"]
		
		if(data["mainorderid"]){
		alert("Order submitted successfully")	
        creatsub(mainorder);
		}
		//printDiv('printMe')
          var cartItems = document.getElementsByClassName('cart-items')[0]
          while (cartItems.hasChildNodes()) {
           cartItems.removeChild(cartItems.firstChild)
          }
    updateCartTotal()
	
 }
   })
   

	
	
}



function checkavilability(customer,subtotal,discount,total)
{
	var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var avl_qty=0;
	var lenght=cartRows.length;
	var looop=0;
	for (var i = 0; i < cartRows.length; i++) {
		var cartItemContainer = document.getElementsByClassName('cart-items')[0]
        var cartRows = cartItemContainer.getElementsByClassName('cart-row')
	    var cartRow = cartRows[i]
		
		var titleElement = cartRow.getElementsByClassName('cart-item-title')[0]
		var item =titleElement.innerText
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
		var freequantityElement = cartRow.getElementsByClassName('cart-quantity-free-input')[0]

        var quantity = quantityElement.value
		var freequantity = freequantityElement.value
       
//alert("before avilability ajax")
        	$.ajax({
    url:"checkavlqty.php",
    method:"POST",
    data:{

		  item:item,
          quantity:quantity,
		  freequantity:freequantity
},
    dataType:"JSON",
    success:function(data)
    { 
      //alert(JSON.stringify(data)); 
	  if(data["feedback"]){alert(data["feedback"])}
      if(data["avl"]==0)
	  {  
		  avl_qty=avl_qty+1;
	  }	
      looop=looop+1;
if(looop>=lenght){	  
      mainorder(customer,subtotal,discount,total,avl_qty);	
}	  
    }
   })
    }
	

	
}









function creatsub(mainorder)
{
	var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    for (var i = 0; i < cartRows.length; i++) {
		var cartItemContainer = document.getElementsByClassName('cart-items')[0]
        var cartRows = cartItemContainer.getElementsByClassName('cart-row')
	    var cartRow = cartRows[i]
		
		var titleElement = cartRow.getElementsByClassName('cart-item-title')[0]
		var item =titleElement.innerText
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
		var freequantityElement = cartRow.getElementsByClassName('cart-quantity-free-input')[0]
		var discountElement = cartRow.getElementsByClassName('cart-discount')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
		var discount = parseFloat(discountElement.innerText.replace('$', ''))
		if(isNaN(discount)){
		discount="0";
	}
        var quantity = quantityElement.value
		var freequantity = freequantityElement.value
       
//alert("before ajax")
        	$.ajax({
    url:"suborder.php",
    method:"POST",
    data:{

		  item:item,
          mainorder:mainorder,
          quantity:quantity,
		  freequantity:freequantity,
		  price:price,
		  discount:discount
},
    dataType:"JSON",
    success:function(data)
    { 
     // alert(JSON.stringify(data));   
    }
   })
    }
	
	
}

function removeCartItem(event) {
    var buttonClicked = event.target
	/*var cartitem = buttonClicked.parentElement.parentElement
	var title = cartitem.getElementsByClassName('cart-item-title')[0].innerText
	var printcartRow = document.createElement('div')
    printcartRow.classList.add('cart-row')
	printcartRow.classList.add('cart-row-print')
	 
    var printcartItems = document.getElementsByClassName('cart-items-print')[0]
    var printcartItemNames = printcartItems.getElementsByClassName('cart-item-title-print')
	var printcartItemqty = printcartItems.getElementsByClassName('cart-quantity-input-print')
	 for (var i = 0; i < printcartItemNames.length; i++) {
	   
        if (printcartItemNames[i].innerText == title) {
			printcartItemNames[i].parentElement.parentElement.remove()
        }
		
    }
	*/
	
    buttonClicked.parentElement.remove()
    updateCartTotal()
	
	
}

function quantityChanged(event) {
    var input = event.target
	if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
	var cartitem = input.parentElement.parentElement
	var title = cartitem.getElementsByClassName('cart-item-title')[0].innerText
	var printcartRow = document.createElement('div')
    printcartRow.classList.add('cart-row')
	printcartRow.classList.add('cart-row-print')
	 
    var printcartItems = document.getElementsByClassName('cart-items-print')[0]
    var printcartItemNames = printcartItems.getElementsByClassName('cart-item-title-print')
	var printcartItemqty = printcartItems.getElementsByClassName('cart-quantity-input-print')
	 for (var i = 0; i < printcartItemNames.length; i++) {
	   
        if (printcartItemNames[i].innerText == title) {
			printcartItemqty[i].innerText = input.value
        }
		
    }
	
    
    updateCartTotal()
	
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('product')[0].value
//title = title.substring(title.indexOf("$") + 1);
    title = title.substring(0, title.indexOf("$"));
    var price = shopItem.getElementsByClassName('product')[0].value
	price = price.substring(price.indexOf("$") + 1);
	var discount = shopItem.getElementsByClassName('shop-item-price')[0].value
	//price = price -((price*discount)/100)
    addItemToCart(title, price,discount)
    updateCartTotal()
	
	addtoprintcart(title, price,discount)
	
	//updateprintCartTotal()
}




function addtoprintcart(title, price,discount){
	
	
	

    var printcartRow = document.createElement('div')
    printcartRow.classList.add('cart-row')
	printcartRow.classList.add('cart-row-print')
	 
    var printcartItems = document.getElementsByClassName('cart-items-print')[0]
    var printcartItemNames = printcartItems.getElementsByClassName('cart-item-title-print')
	var printcartItemqty = printcartItems.getElementsByClassName('cart-quantity-input-print')
	
if( title == '' || title == null)
   { alert("you didn't choose item yet")
            return}
   for (var i = 0; i < printcartItemNames.length; i++) {
	   
        if (printcartItemNames[i].innerText == title) {
			var qty= printcartItemqty[i].innerText
			qty=Number(qty)+1
			printcartItemqty[i].innerText=qty
            return
        }
		
    }
    var printcartRowContents = `
        <div class="cart-item cart-item-print cart-column">
            <span class="cart-item-title cart-item-title-print">${title}</span>
        </div>
		<div class="cart-quantity cart-quantity-print cart-column">
		<span class="cart-quantity-input cart-quantity-input-print">1</span>
            
        </div>
		<div class="cart-quantity cart-quantity-print cart-column">
		<span class="cart-quantity-free-input cart-quantity-input-print">0</span>
            
        </div>
        <span class="cart-price cart-price-print cart-column">${price}</span>
		<span class="cart-discount cart-discount-print cart-column">${discount}%</span>
        `
    printcartRow.innerHTML = printcartRowContents
    printcartItems.append(printcartRow)
   // printcartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
   // printcartRow.getElementsByClassName('cart-quantity-input-print')[0].addEventListener('change', quantityChanged)
	
   
    
}



var height = 22
function addItemToCart(title, price,discount) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
	var cartItemqty = cartItems.getElementsByClassName('cart-quantity-input')
	
if( title == '' || title == null)
   { alert("you didn't choose item yet")
            return}
   for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
			var qty= cartItemqty[i].value
			qty=Number(qty)+1
			cartItemqty[i].value=qty
            return
        }
		
    }
	height = height + 1.5
    var cartRowContents = `
        <div class="cart-item cart-column">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
		<span class="cart-discount cart-column">${discount}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
        </div>
		<div class="cart-quantity cart-column">
            <input class="cart-quantity-free-input" type="number" value="0">
        </div>
		
		 <button class="btn btn-danger" type="button">X</button>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
	
	////////////////

}







function updateCartTotal() {
	
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
	var totaldiscount = 0
    for (var i = 0; i < cartRows.length; i++) {
	   
	   
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
		
        var discountelement = cartRow.getElementsByClassName('cart-discount')[0]
		var discount=discountelement.innerText
		
        var quantity = quantityElement.value

	//	alert (quantity)
        total = total + (price * quantity)
		totaldiscount = totaldiscount + (discount * quantity)
    }
	   //alert(height)
       var test = '7.6cm '+height+'cm'
       cssPagedMedia.size(test);
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total

	document.getElementsByClassName('cart-total-price-print')[0].innerText = '$' + total
	var delivery = document.getElementById("deliveryfees").value
	document.getElementById("delivery").innerText = '$' + delivery
	 var finaltotal = Number(total) + Number(delivery) - Number(totaldiscount)
	
	document.getElementById("finaltotal").innerText = '$' + finaltotal
	document.getElementById("cart-finaltotal").innerText = '$' + finaltotal
	
  document.getElementById("discounttotal").innerText = '-$' + totaldiscount
  document.getElementById("cart-discount").innerText = '-$' + totaldiscount	
}


function buttonSearch ()
{ var name =document.getElementById("productsearch").value;
  var discount =document.getElementById("productdiscount").value;
	
    $.ajax({
    url:"getitemdetailssearch.php",
    method:"POST",
    data:{
	     
		  name:name
		  
},
    dataType:"JSON",
    success:function(data)
    { 
       var title =data['item']; 
	   var price =data['price'];
       	   
	   addItemToCart(title, price,discount)
	   addtoprintcart(title, price,discount)
       updateCartTotal()
	   
    }
   })
document.getElementById("barcode").value='';
}





function buttonCode()
{ var barcode =document.getElementById("barcode").value;
  var discount =document.getElementById("barcodediscount").value;
	 
    $.ajax({
    url:"getitemdetails.php",
    method:"POST",
    data:{
	     
		  barcode:barcode
		  
},
    dataType:"JSON",
    success:function(data)
    { 
       var title =data['item']; 
	   var price =data['price'];
       
	   addItemToCart(title, price,discount)
	   addtoprintcart(title, price,discount)
       updateCartTotal()
	   
    }
   })
document.getElementById("barcode").value='';
}

function printDiv(divName){
	        
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
             
         setTimeout(function() {
                location.reload();
           }, 100);
			 
		}
		
		
var cssPagedMedia = (function () {
    var style = document.createElement('style');
    document.head.appendChild(style);
    return function (rule) {
        style.innerHTML = rule;
    };
}());

cssPagedMedia.size = function (size) {
    cssPagedMedia('@page {size: ' + size + '}');
};

var test = '7.6cm '+height+'cm'
cssPagedMedia.size(test);
     