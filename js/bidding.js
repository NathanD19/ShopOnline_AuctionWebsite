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

function Bidding()
{

  	xHRObject.open("GET", "php/bidding.php?id=" + Number(new Date), true);
		
	xHRObject.onreadystatechange = function() {
	if (xHRObject.readyState == 4 && xHRObject.status == 200)
	  	document.getElementById('notify').innerHTML = xHRObject.responseText;
	}
	
	xHRObject.send(null); 
	setTimeout(Bidding, 5000);
	//setTimeout(Bidding, 1000);
}

function purchase(itemNum)
{
	xHRObject.open("GET", "php/updateBidding.php?id=" + Number(new Date) + "&itemNum=" + encodeURIComponent(itemNum), true);
		
	xHRObject.onreadystatechange = function() {
	if (xHRObject.readyState == 4 && xHRObject.status == 200)
	  	document.getElementById('notify').innerHTML = xHRObject.responseText;
	}
	
	xHRObject.send(null); 
	//setTimeout(Bidding, 5000);
}

function placeBid(itemNum, currentBid)
{
	//open up window to place bid
	var newbid = prompt("Current Bid: " + currentBid + ".  Please enter an amount higher than the current bid:");
	if (newbid==null || newbid.trim()=="" ) {
		
		alert("Bid is not valid!  You must input a number.");

	} 
	else if (currentBid >= newbid) 
	{ 
		alert("Bid is not valid! Your bid must be higher than current bid.");
	}
	else
	{
		xHRObject.open("GET", "php/updateBidding.php?id=" + Number(new Date) + "&itemNumBid=" + encodeURIComponent(itemNum) + "&newbid=" + encodeURIComponent(newbid), true);
		
		xHRObject.onreadystatechange = function() {
		if (xHRObject.readyState == 4 && xHRObject.status == 200)
		  	document.getElementById('notify').innerHTML = xHRObject.responseText;
		}
		
		xHRObject.send(null); 
	}
}