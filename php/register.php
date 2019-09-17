<?php

$xmlFile = "xml/customer.xml";

//php generate password
$passwordvalues = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$password = substr(str_shuffle($passwordvalues), 0,10);
//php generat cust num
$id = '1';
//if (!($_GET['first'] == "" || $_GET['surname'] == "" ||  $_GET['email'] = "" )){
if (!file_exists($xmlFile)) {
	//create new xml
	$newXml = new SimpleXMLElement("<customers></customers>");
	$cust = $newXml->addChild("customer");
	$cust->addChild('custId', $id);
	$cust->addChild('firstname', $_GET['first']);
	$cust->addChild('surname', $_GET['surname']);
	$cust->addChild('email', $_GET['email']);
	$cust->addChild('password', $password);
	Header('Content-type: text/xml');
	$newXml->asXML("xml/customer.xml");
	echo '<p><b>Registration successful.<br>Please check '.$_GET['email'].' for password</b></p>';
	$lastId = $id;
}
else
{
	$xml = simplexml_load_file("xml/customer.xml");

	foreach ($xml as $elem) {
		$lastId = $elem->custId;
		if (strcasecmp($elem->email, $_GET['email']) == 0) {
			echo '<p><b>Error: '.$_GET['email']. ' is already registered. Please provide unique email address</b></p>';		
			exit();
		}
	}

	$lastId = $lastId + $id;

	$exists = new SimpleXMLElement($xml->asXML()); 
	$customer = $exists->addChild("customers");
	$customer->addChild('customerid', $lastId);
	$customer->addChild('firstname', $_GET['first']);
	$customer->addChild('surname', $_GET['surname']);
	$customer->addChild('email', $_GET['email']);
	$customer->addChild('password', $password);
	$exists->asXML("xml/customer.xml");  
	echo '<p><b>Registration successful.<br>Please check '.$_GET['email'].' for password</b></p>';		
	}


//Email to customer
$to = $_GET['email'];
$subject = 'Welcome to ShopOnline!';			
$message = 'Dear '.$_GET['first'].', welcome to ShopOnline! Your customer id is: '.$lastId.' and the password is: '.$password;
$headers = 'From registration@shoponline.com.au';
mail($to, $subject, $message, $headers, '-r 101094460@student.swin.edu.au');
//}
?>