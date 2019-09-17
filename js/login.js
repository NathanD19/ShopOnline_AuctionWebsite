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

function login()
{
	var validation = false;
	//validation = checkData();

	var email = document.getElementById('email').value.trim();
	var password = document.getElementById('password').value.trim();
	
	if (email=="" || password=="" || email=="") 
	{
  		alert("Please enter in all information");
		validation = false;
		//alert("ho");
  	}
  	else
  	{
  		//alert("hey");
		xHRObject.open("GET", "php/login.php?id=" + Number(new Date) + "&email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password), true);
		

		
		xHRObject.onreadystatechange = function() {
	    if (xHRObject.readyState == 4 && xHRObject.status == 200)
	    	document.getElementById('notify').innerHTML = xHRObject.responseText;
	    }
	}

	xHRObject.send(null); 
}
