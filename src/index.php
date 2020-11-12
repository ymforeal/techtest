<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Parser\Csv\DeviceMapCsvParser;
use App\MapElement\Relation;

if (!isset($argv[1])) {

	echo "Argument [PATH TO CSV FILE] is missing. \n";
	exit;
}

try {
	$deviceMapParser = new DeviceMapCsvParser($argv[1]);
	$graph = $deviceMapParser->read();
	
} catch(\Exception $ex) {
	echo "Error: ".(string)$ex."\n";
}

$relation = new Relation($graph);

while( true )
{
	$search = readline();

	if (trim($search) == "QUIT") {
		exit();
	}

	try {
		$task = $relation->validation(explode(' ', $search));

		$response = $relation->best_first_search($task);

		echo $response."\n";

	} catch(\Exception $ex) {
		echo "Error: ".(string)$ex."\n";
	}
}