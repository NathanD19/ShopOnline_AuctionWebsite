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

function processItems()
{
	var request = true;
	
	xHRObject.open("GET", "php/maintenance.php?id=" + Number(new Date) + "&process=" + encodeURIComponent(request), true);

	xHRObject.onreadystatechange = function() {
	if (xHRObject.readyState == 4 && xHRObject.status == 200)
	   	document.getElementById('notify').innerHTML = xHRObject.responseText;
	}
	alert("Process Complete");

	
	xHRObject.send(null); 
}

function generateReport()
{
	var request = true;

	xHRObject.open("GET", "php/maintenance.php?id=" + Number(new Date) + "&generate=" + encodeURIComponent(request), true);
			
	xHRObject.onreadystatechange = function() {
	if (xHRObject.readyState == 4 && xHRObject.status == 200)
	   	document.getElementById('notify').innerHTML = xHRObject.responseText;
	}
	alert("Form Generated");
	
	xHRObject.send(null); 
}
