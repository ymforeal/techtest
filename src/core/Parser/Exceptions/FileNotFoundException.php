<?php

namespace App\Parser\Exceptions;

class FileNotFoundException extends \Exception
{
	public function __toString()
	{
		return "Invalid file location was provided, detail:\n$this->message\n";
	}
}