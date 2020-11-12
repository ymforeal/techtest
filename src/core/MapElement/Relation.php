<?php

namespace App\MapElement;

use App\MapElement\Graph;
use App\MapElement\Exceptions\InvalidArgumentException;
use App\MapElement\Exceptions\InvalidDeviceException;

class Relation
{
	private $graph = null;

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

		return $relation;
	}


	/**
	 * array $search:{$from, $to, $latency}
	 * use array to simulate priority queue
	 */
	public function best_first_search(array $search)
	{
		$visited = array();
		$priority_queue = array();
		// priority queue: {B:20, C: 30}
		$fromDevice = $this->graph->findOrCreateDevice($search[0]);
		
		$priority_queue[$fromDevice->getDevice()] = [
			"latency" => 0,
			"obj" => $fromDevice,
			"visited" => [$fromDevice->getDevice()],
			"level" => 0
		];
		// skip when visited device attemps
		// back to the queue


		while (count($priority_queue)) 
		{
			$current_index = $this->get_element_with_lowest_latency($priority_queue);

			$current = [
				$current_index => $priority_queue[$current_index]
			];
			
			unset($priority_queue[$current_index]);

			$cost = $current[array_key_first($current)]["latency"];
			
			if (
				preg_match("/".$search[1]."$/", array_key_first($current)) &&
				$cost <= $search[2]
			) {
				return array_key_first($current)."=>".$cost;
			}

			$neighbours = $current[array_key_first($current)]["obj"]->getNeighbours();


			foreach ($neighbours as $latency => $objs) {
				foreach ($objs as $obj) {
					if (!in_array($obj->getDevice(),$current[array_key_first($current)]["visited"])) {
						
						$visited = array_merge($current[array_key_first($current)]["visited"], (array)$obj->getDevice());
						
						$priority_queue[array_key_first($current)."=>".$obj->getDevice()] = [
							"latency" => $cost + $latency,
							"obj" => $obj,
							"visited" => $visited,
							"level" => $current[array_key_first($current)]["level"] + 1
						];
					}

				}
			}

		}

		return "Path not found";

	}
	
	private function get_element_with_lowest_latency(array $priority_queue) : string
	{
		$selected = array_key_first($priority_queue);
		$lowest_level = $priority_queue[$selected]["level"];
		foreach ($priority_queue as $device => $stack) {
			if ($stack["level"] < $lowest_level) {
				$selected = $device;
				$lowest_level = $stack["level"];
			}
		}

		return $selected;
	}

}