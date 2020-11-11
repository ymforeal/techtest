<?php

require_once __DIR__ . '/vendor/autoload.php';

if (!isset($argv[1])) {

	echo "Argument [PATH TO CSV FILE] is missing. \n";
	exit;
}

while( true )
{
	$search = readline();

	if (trim($search) == "QUIT") {
		exit();
	}
}