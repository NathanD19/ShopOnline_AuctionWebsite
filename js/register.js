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

function register()
{
	var validation = false;
	//validation = checkData();

	var first = document.getElementById('first').value.trim();
	var surname = document.getElementById('surname').value.trim();
	var email = document.getElementById('email').value.trim();

	if (first=="" || surname=="" || email=="") 
	{
  		alert("Please enter in all information");
		validation = false;
		//alert("ho");
  	}
  	else
  	{
  		//alert("hey");
		xHRObject.open("GET", "php/register.php?id=" + Number(new Date) + "&first=" + encodeURIComponent(first) + "&surname=" + encodeURIComponent(surname) + "&email=" + encodeURIComponent(email), true);
		
		xHRObject.onreadystatechange = function() {
	    if (xHRObject.readyState == 4 && xHRObject.status == 200)
	    	document.getElementById('xhrid').innerHTML = xHRObject.responseText;
	    }
	}
	xHRObject.send(null); 
}