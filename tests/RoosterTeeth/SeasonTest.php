<?php

class SeasonTest extends \PHPUnit_Framework_TestCase
{
	private $season;

	public function setUp()
	{
		$base = new \RoosterTeeth\Base();
		$this->season = $base->getSeason(423);
	}

	public function testGetID()
	{
		$result = $this->season->getID();
		$this->assertEquals("423", $result);
	}

	public function testGetTitle()
	{
		$result = $this->season->getTitle();
		$this->assertEquals("2016", $result);
	}

	public function testGetDescription()
	{
		$result = $this->season->getDescription();
		$this->assertEquals("", $result);
	}

	public function testGetNumber()
	{
		$result = $this->season->getNumber();
		$this->assertEquals("1", $result);
	}

	public function testGetSlug()
	{
		$result = $this->season->getSlug();
		$this->assertEquals("theater-mode-2016", $result);
	}

	public function testGetShow()
	{
		$result = $this->season->getShow()->getID();
		$this->assertEquals("258", $result);
	}

	public function testGetAllEpisodes()
	{
		$result = $this->season->getAllEpisodes();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetEpisodes()
	{
		$result = $this->season->getEpisodes();
		$this->assertGreaterThan(0, count($result));
	}
}