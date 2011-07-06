<?php

require_once APPLICATION_PATH . '/models/Stats.php';

class Model_StatsTest extends ControllerTestCase
{
	protected $stats;

	public function setUp()
	{
		parent::setUp();
		$this->stats = new Model_Stats();
	}

	public function testCanAddCountry()
	{
		$testCountry = "Canada";

		$this->assertEquals(0, count($this->stats->getCountries()));
		
		$this->stats->addCountry($testCountry);

		foreach ($this->stats->getCountries() as $country){
			if($country == $testCountry)
			$this->assertEquals($country, $testCountry);
		}

		$this->assertEquals(1, count($this->stats->getCountries()));
	}

}