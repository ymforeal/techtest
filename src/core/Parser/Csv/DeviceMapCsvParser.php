<?php

namespace App\Parser\Csv;

use App\Parser\Csv\GeneralCsvParser;
use App\MapElement\Graph;


class DeviceMapCsvParser extends GeneralCsvParser
{

	protected $graph;

	public function __construct(string $filepath)
	{
		parent::__construct($filepath);
		$this->graph = new Graph();
	}

	public function serialize(array $relation)
	{
		$this->graph->buildGraph($relation);
		return $this->graph->getContent();
	}

	public function after_read(array $content) {
		return $this->graph;
	}
}