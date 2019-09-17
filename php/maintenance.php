<?php
error_reporting(0);
session_start(); 

if ($_SESSION['user'] == "")
{
	echo "<b>You can not Process Items or Generate Reports without being logged in. Please sign in <a href='login.html' target='login.html' >HERE</a> to do so.</b>";
	exit();	
}

//Process Items
$exists = "";
if (isset($_GET['process'])) {
	$xml = simplexml_load_file("xml/listItem.xml");
	$exists = new simpleXMLElement($xml->asXML());


	foreach ($xml as $elem) {
		$create= DateTime::createFromFormat('d/m/Y H:i:s', $elem->endDate." ".$elem->endTime.":00");
		$start = new DateTime(date('Y-m-d H:i:s'));
		$timesince = $start->diff(new DateTime(date_format( $create,'Y-m-d H:i:s'))); + 1;
		$timesince->d = $timesince->d + 2;
		$duration = $timesince->d.' days, '.$timesince->h. ' hours, ' .$timesince->i. ' minutes and '.$timesince->s. ' seconds';
		
		if (date_format( $create,'Y-m-d H:i:s') <= date('Y-m-d H:i:s')) {

			if(intval($elem->rprice) < intval($elem->bprice)){
				$elem->status = 'SOLD';
			} 
			else if(intval($elem->rprice) > intval($elem->bprice)) 
			{
				$elem->status = 'FAILED';
			}
			$xml->asXML("xml/listItem.xml");
		}
	}
	echo "<b>Processing of auction items complete</b>";
}
//Generate Report
if (isset($_GET['generate'])) {
	echo "<p><b>Revenue and Sales Report</b></p>";
	//DOM
	$doc = new DomDocument('1.0');
	$doc->formatOuput = true;
	$doc->preserveWhiteSpace = false;
	$doc->load("xml/listItem.xml");

	//XSL
	$xsl = new DomDocument('1.0');
	$xsl->load("report.xsl");

	$import = new XSLTProcessor;
	$import->importStyleSheet($xsl);

	$print = $import->transformToXML($doc);

	echo $print;
}
?>