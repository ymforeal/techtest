<?php

namespace App\Parser\Csv;

use App\Parser\Interfaces\BaseParserInterface;
use App\Parser\Exceptions\FileNotFoundException;

class CsvBase implements BaseParserInterface
{
	private $filepath = '';

	public function __construct(string $filepath)
	{
		if (!file_exists($filepath) || !is_readable($filepath))
			throw new FileNotFoundException($filepath);
		$this->filepath = $filepath;
	}

	public function read(callable $callable = null)
	{
		return $this->loadfile($callable);
	}

	protected function loadfile(callable $callback, $delimiter = ',') : array
	{
		$result = [];
		if (($handle = fopen($this->filepath, 'r')) !== FALSE)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	        {
	            $row = array_map('trim', $row);
	            if (is_callable($callback)) {
	            	$result = $callback($row);
	            } else {
	            	$result[] = $row;
	            }
	        }
	        fclose($handle);
	        return $result;
	    }
	}
}