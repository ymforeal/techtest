<?php

namespace App\MapElement\Exceptions;

class InvalidCsvContentException extends \Exception
{
	public function __toString()
	{
		return "Invalid CSV content was provided, format: [From Device] [To Device] [Latency]";
	}
}