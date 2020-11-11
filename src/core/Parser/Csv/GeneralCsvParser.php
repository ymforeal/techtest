<?php

namespace App\Parser\Csv;

use App\Parser\Csv\CsvBase;

abstract class GeneralCsvParser
{
	protected $csvBase = null;

	public function __construct(string $filepath)
	{
		$this->csvBase = new CsvBase($filepath);
	}

	public function read()
	{
		if (method_exists($this, 'serialize')) {
			$content = $this->csvBase->read([$this, 'serialize']);
		} else {
			$content = $this->csvBase->read();
		}

		if (method_exists($this, 'after_read')) {
			return $this->after_read($content);
		}
		return $content;
	}

	abstract public function serialize(array $content);
}