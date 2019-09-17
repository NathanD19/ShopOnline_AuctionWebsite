<?php
error_reporting(0);
session_start(); 

if ($_SESSION['user'] == "")
{	

echo "<b>You can not place bids while not logged in. Please sign in <a href='login.html' target='login.html' >HERE</a> to do so.</b>";
exit();	
}

$xml = simplexml_load_file("xml/listItem.xml");				
foreach($xml as $elem){

	$create= DateTime::createFromFormat('d/m/Y H:i:s', $elem->endDate." ".$elem->endTime.":00");
	$start = new DateTime(date('Y-m-d H:i:s'));
	$timesince = $start->diff(new DateTime(date_format( $create,'Y-m-d H:i:s'))); + 1;
	$timesince->d = $timesince->d + 2;
	$duration = $timesince->d.' days, '.$timesince->h. ' hours, ' .$timesince->i. ' minutes and '.$timesince->s. ' seconds';


	echo "<fieldset><form>";
		
	echo "Item No: ". $elem->itemId . "<br>";
	echo "Item Name: ". $elem->item . "<br>";
	echo "Category: ". $elem->category . "<br>";
	echo "Description: ". $elem->desc . "<br>";
	echo "Buy it Now Price: $". $elem->sprice . "<br>";
	echo "Bid Price: $". $elem->bprice . "<br>";
	                        		
	if ($elem->status != "SOLD") 
	{
		echo "Time Remaining: <i>". $duration . "</i><br>";	
		echo "<input type='button' style='background-color:blue; color:white' onClick='placeBid(".$elem->itemId.",".$elem->bprice.")' id='placebid' value='Place Bid'/> ";
		echo "<input type='button' style='background-color:green; color:white' onClick='purchase(".$elem->itemId.")' id='buynow' value='Purchase'/> ";
	} 
	else if ($elem->status == "SOLD")
	{
		echo "<b>SOLD</b>";	
	} 
	else 
	{
		echo "<i>Time Expired</i>";	
	}

	echo "</form> </fieldset>" . "<br>";
} 


?>
