<?php

namespace App\MapElement\Exceptions;

class InvalidArgumentException extends \Exception
{
	public function __toString()
	{
		return "Invalid argument was provided, format: [From Device] [To Device] [Latency]";
	}
}