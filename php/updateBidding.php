<?php 
session_start(); 
if ($_SESSION['user'] == "")
{	

echo "<b>You can not purchase while not logged in. Please sign in <a href='login.html' target='login.html' >HERE</a> to do so.</b>";
exit();	
}

if (isset($_GET['itemNum'])) {
 	
 	$xml = simplexml_load_file("xml/listItem.xml");
	$exists = new SimpleXMLElement($xml->asXML());

	foreach($xml as $elem){
			
	if($elem->itemId == $_GET['itemNum']){
		$elem->custId = trim($_SESSION['user']);
		$elem->sprice = $elem->bprice;
		$elem->status = 'SOLD';
		$xml->asXML("xml/listItem.xml");
		echo '<strong>Thank you for your purchase!</strong></p>'; 
		}
	}
}

if (isset($_GET['newbid'])) {
 	
 	$xml = simplexml_load_file("xml/listItem.xml");
	$exists = new SimpleXMLElement($xml->asXML());

	foreach($xml as $elem){
			
	if($elem->itemId == $_GET['itemNumBid']){
		$elem->custId = trim($_SESSION['user']);
		$elem->bprice = $_GET['newbid'];
		$xml->asXML("xml/listItem.xml");
		echo '<p><strong>Thank you for placing your bid!</strong></p>'; 
		}
	}
}
?>