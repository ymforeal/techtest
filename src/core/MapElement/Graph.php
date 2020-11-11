<?php

namespace App\MapElement;


use App\MapElement\Exceptions\InvalidCsvContentException;
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
	 * Add element to graph
	 * structure sample:
	 * {
	 *     A : {
	 *         B: 10, C: 20
	 *     }, B: {
	 *         C: 5, E: 50
	 *     }
	 * }
	 */
	public function addContent(
		string $base, 
		string $to, 
		string $latency, 
		bool $is_base
	)
	{
		if ($is_base) {
			$this->content[$base] = [
				$to => $latency
			];
		} else
		{
			$this->content[$base][$to] = $latency;
		}
	}

	protected function hasContentBase(string $base)
	{
		return isset($this->content[$base]);
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

	public function buildGraph(array $relation)
	{
		if (count($relation) != 3) {
			throw new InvalidCsvContentException(implode(",", $relation));
		}
		if (!$this->hasContentBase($relation[0])) {
			$is_base = true;
		} else {
			$is_base = false;
		}
		// building graph
		$this->addContent(
				$relation[0], // from device
				$relation[1], // to device
				$relation[2],  // latency
				$is_base
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