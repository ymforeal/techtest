<?php

namespace App\MapElement;

/**
 * 
 */
class Device
{
	private $neighbours = array();

	private $device;


	public function __construct(string $device)
	{
		
		$this->device = $device;
	}

	public function getDevice()
	{
		return $this->device;
	}

	public function getNeighbours()
	{
		return $this->neighbours;
	}

	public function addNeighbour(Device $neighbour, int $latency, bool $return = false)
	{
		$this->neighbours[$latency][] = $neighbour;
		if (!$return) {
			$neighbour->addNeighbour($this, $latency, true);
		}
		
	}
}