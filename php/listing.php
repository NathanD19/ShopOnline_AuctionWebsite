<?php

session_start(); 

if ($_SESSION['user'] == "")
{
	echo "<b>You can not make listings while not logged in. Please sign in <a href='login.html' target='login.html' >HERE</a> to do so.</b>";
	exit();	
}

$startDate = date('d/m/Y');
$startTime = date('H:i');

$xmlFile = "xml/listItem.xml";

$id = 1;
$lastId = $id;

//create end date for list item

$startTime = date('H:i');
$startDate = date('m/d/Y');

$d = $_GET['day'];
$m = $_GET['min'];
$h = $_GET['hour'];
		
$date = date_create($startDate ." ". $startTime);
date_modify($date, '+' .$d . ' day +' . $m . ' minute +' . $h . ' hour');

$endDate = date_format($date, 'd/m/Y');
$endTime = date_format($date, 'H:i');

$startDate = date_create($startDate);
$startDate = date_format($startDate, 'd/m/Y');


if (!file_exists($xmlFile)) {
	//create new xml
	$newXml = new SimpleXMLElement("<listings></listings>");
	$newListing = $newXml->addChild("ListItem");
	$newListing->addChild('itemId',$id);
	$newListing->addChild('custId',$_SESSION['custId']);
	$newListing->addChild('item',$_GET['item']);
	$newListing->addChild('category',$_GET['category']);
	$newListing->addChild('desc',$_GET['desc']);
	$newListing->addChild('startDate',$startDate);
	$newListing->addChild('startTime',$startTime);
	$newListing->addChild('endDate',$endDate);
	$newListing->addChild('endTime',$endTime);
	$newListing->addChild('sprice',$_GET['sprice']);
	$newListing->addChild('rprice',$_GET['rprice']);
	$newListing->addChild('bprice',$_GET['bprice']);
	$newListing->addChild('status','in_progress');
	Header('Content-type: text/xml');
	$newXml->asXML("xml/listItem.xml");
	echo '<p><b>Thanks! The item has been sucessfully added to the list, item number: '.$id.'. <br> The bidding starts at: ' . $startTime .' on: '. $startDate.'</b></p>';
}
else
{
	$xml = simplexml_load_file("xml/listItem.xml");

	foreach ($xml as $elem) {
		$lastId = $elem->itemId;
	}

	$lastId = $lastId + $id;

	$xml = simplexml_load_file("xml/listItem.xml");
	$exists = new SimpleXMLElement($xml->asXML()); 
	$listing = $exists->addChild("ListItem");
	$listing->addChild('itemId',$lastId);
	$listing->addChild('custId',$_SESSION['custId']);
	$listing->addChild('item',$_GET['item']);
	$listing->addChild('category',$_GET['category']);
	$listing->addChild('desc',$_GET['desc']);
	$listing->addChild('startDate',$startDate);
	$listing->addChild('startTime',$startTime);
	$listing->addChild('endDate',$endDate);
	$listing->addChild('endTime',$endTime);
	$listing->addChild('sprice',$_GET['sprice']);
	$listing->addChild('rprice',$_GET['rprice']);
	$listing->addChild('bprice',$_GET['bprice']);
	$listing->addChild('status','in-progress');
	Header('Content-type: text/xml');
	$exists->asXML("xml/listItem.xml");
	echo '<p><b>Thanks! The item has been sucessfully added to the list, item number: '.$lastId.'. <br> The bidding starts at: ' . $startTime .' on: '. $startDate.'</b></p>';
}
?>