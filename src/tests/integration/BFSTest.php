<?php

use PHPUnit\Framework\TestCase;
use App\Parser\Csv\DeviceMapCsvParser;
use App\MapElement\Relation;

class BFSTest extends TestCase
{
	protected $graph;
	protected $relation;

	protected function setUp() : void
	{
		$deviceMapParser = new DeviceMapCsvParser("./map.csv");
		$this->graph = $deviceMapParser->read();
		$this->relation = new Relation($this->graph);
	}

	public function test_not_found() : void
	{
		$response = $this->relation->best_first_search(["A","F",1000]);

		$expect = "Path not found";

		$this->assertEquals($response, $expect);
	}

	public function test_A_D_bigger_latency() : void
	{
		$response = $this->relation->best_first_search(["A","D",200]);

		$expect = "A=>B=>D=>110";

		$this->assertEquals($response, $expect);
	}

	public function test_A_D_smaller_latency() : void
	{
		$response = $this->relation->best_first_search(["A","D",100]);

		$expect = "A=>C=>D=>50";

		$this->assertEquals($response, $expect);
	}

	public function test_reverse_E_A_bigger_latency() : void
	{
		$response = $this->relation->best_first_search(["E","A",400]);

		$expect = "E=>D=>B=>A=>120";

		$this->assertEquals($response, $expect);
	}

	public function test_reverse_E_A_smaller_latency() : void
	{
		$response = $this->relation->best_first_search(["E","A",80]);

		$expect = "E=>D=>C=>A=>60";

		$this->assertEquals($response, $expect);
	}
}