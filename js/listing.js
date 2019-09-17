var xHRObject = false;

if (window.XMLHttpRequest) 
{
	xHRObject = new XMLHttpRequest();
}
else if (window.ActiveXObject) 
{
	//For Internet Explorer
	xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function sendData()
{
	var validation = false;
	//validation = checkData();

	var item = document.getElementById('item').value.trim();
	var category = document.getElementById('category').value;
	var desc = document.getElementById('desc').value.trim();
	var sprice = document.getElementById('sprice').value;
	var spricec = document.getElementById('spricec').value;
	var rprice = document.getElementById('rprice').value;
	var rpricec = document.getElementById('rpricec').value;
	var bprice = document.getElementById('bprice').value;
	var bpricec = document.getElementById('bpricec').value;
	var day = document.getElementById('day').value;
	var hour = document.getElementById('hour').value;
	var min = document.getElementById('min').value;

	if (item=="" || category=="" || desc=="" || sprice=="" || rprice=="" || bprice=="" || hour=="" || min=="" || day==""  ) 
	{
  		alert("Please enter in all information");
		validation = false;
		//alert("ho");
  	}
  	else
  	{
  		//combine prices
  		var spricecom = sprice + "." + spricec;
		var rpricecom = rprice + "." + rpricec;
		var bpricecom = bprice + "." + bpricec;

		if (Number(spricecom) >= Number(rpricecom))
		{
			alert("The Start Price cannot be more than the Reserve Price");
		} 
		else if (Number(rpricecom) >= Number(bpricecom))
		{
			alert("The Reserve Price cannot be more than the Buy It Now Price");
		}
		else
		{
	  		//alert("hey");
			xHRObject.open("GET", "php/listing.php?id=" + Number(new Date) + "&item=" + encodeURIComponent(item) + "&category=" + encodeURIComponent(category) + "&desc=" + encodeURIComponent(desc) + "&sprice=" + encodeURIComponent(spricecom) + "&rprice=" + encodeURIComponent(rpricecom) + "&bprice=" + encodeURIComponent(bpricecom) + "&day=" + encodeURIComponent(day) + "&hour=" + encodeURIComponent(hour) + "&min=" + encodeURIComponent(min), true);
			
			xHRObject.onreadystatechange = function() {
		    if (xHRObject.readyState == 4 && xHRObject.status == 200)
		    	document.getElementById('notify').innerHTML = xHRObject.responseText;
		    }
		}
	}
	xHRObject.send(null); 
}
