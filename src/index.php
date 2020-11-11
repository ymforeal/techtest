<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Parser\Csv\DeviceMapCsvParser;

if (!isset($argv[1])) {

	echo "Argument [PATH TO CSV FILE] is missing. \n";
	exit;
}

try {
	$deviceMapParser = new DeviceMapCsvParser($argv[1]);

	$graph = $deviceMapParser->read();
	var_dump($graph->getContent());
} catch(\Exception $ex) {
	echo "Error: ".(string)$ex."\n";
}

while( true )
{
	$search = readline();

	if (trim($search) == "QUIT") {
		exit();
	}


}