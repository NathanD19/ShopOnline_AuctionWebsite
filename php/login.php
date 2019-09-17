<?php

$check = false;
$xml = simplexml_load_file("xml/customer.xml");

foreach($xml as $elem)
{
	if(strcasecmp($elem->email, $_GET['email']) == 0 && $elem->password == $_GET['password'])
	{
		session_start();
		$custId = (string)$elem->custId;
		$_SESSION['user'] = $_GET['email'];
		$_SESSION['custId'] = $custId;
		session_write_close();
		$check = true;
	}
}

if ($check == false)
{
	echo '<p><b>Email and Password do not match, please try again</b></p>';
}
else
{
	echo '<p><b>Login Successful</b></p>';
}


?>