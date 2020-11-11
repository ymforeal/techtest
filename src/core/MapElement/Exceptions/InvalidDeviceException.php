<?php

namespace App\MapElement\Exceptions;

class InvalidDeviceException extends \Exception
{
	public function __toString()
	{
		return "Invalid device was provided";
	}
}