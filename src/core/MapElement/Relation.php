<?php

namespace App\MapElement;

use App\MapElement\Graph;
use App\MapElement\Exceptions\InvalidArgumentException;
use App\MapElement\Exceptions\InvalidDeviceException;

class Relation
{
	protected $graph = null;

	public function __construct(Graph $graph)
	{
		if (is_null($this->graph)) {
			$this->graph = $graph;
		}

	}

	public function validation(array $relation)
	{
		$relation = array_map('trim', $relation);

		if (count($relation) != 3) {
			throw new InvalidArgumentException();
		}

		$stored_devices = $this->graph->getDevice();

		if (
			!in_array($relation[0], $stored_devices) ||
			!in_array($relation[1], $stored_devices)
		) {
			throw new InvalidDeviceException();
		}
	}
}