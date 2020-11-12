<?php

namespace App\MapElement;


use App\MapElement\Exceptions\InvalidCsvContentException;

use App\MapElement\Device;
/**
 * 
 */
class Graph
{
	
	private $content = array();

	private $devices = array();

	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Add neighbour to devices
	 */
	public function addContent(
		string $base, 
		string $to, 
		string $latency
	)
	{
		$baseObj = $this->findOrCreateDevice($base);
		$toObj = $this->findOrCreateDevice($to);
		$baseObj->addNeighbour($toObj, $latency);
	}

	public function getDevice()
	{
		return $this->devices;
	}

	public function hasDevice(string $device)
	{
		return in_array($device, $this->devices);
	}

	public function addDevice(string $device)
	{
		$this->devices[] = $device;
	}

	public function findOrCreateDevice(string $device)
	{
		foreach ($this->content as $obj) {
			if ($obj->getDevice() == $device) {
				return $obj;
			}
		}
		$newObj = new Device($device);
		$this->content[] = $newObj;
		return $newObj;
	}

	public function buildGraph(array $relation)
	{
		if (count($relation) != 3) {
			throw new InvalidCsvContentException(implode(",", $relation));
		}
		
		// building graph
		$this->addContent(
				$relation[0], // from device
				$relation[1], // to device
				$relation[2]  // latency
				// $is_base
			);
		// building devices collection for quick validation
		if (!$this->hasDevice($relation[0])) {
			$this->addDevice($relation[0]);
		}
		if (!$this->hasDevice($relation[1])) {
			$this->addDevice($relation[1]);
		}
	}
}