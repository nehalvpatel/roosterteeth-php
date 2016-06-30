<?php

class BaseTest extends \PHPUnit_Framework_TestCase
{
	private $base;

	public function setUp()
	{
		$this->base = new \RoosterTeeth\Base();
	}

	public function testGetSite()
	{
		$result = $this->base->getSite("funhaus");
		$this->assertEquals("funhaus", $result->getName());
	}

	public function testGetShow()
	{
		$result = $this->base->getShow(71);
		$this->assertEquals("Rooster Teeth Podcast", $result->getName());
	}

	public function testGetSeason()
	{
		$result = $this->base->getSeason(351);
		$this->assertEquals(2016, $result->getNumber());
	}

	public function testGetEpisode()
	{
		$result = $this->base->getEpisode(28807);
		$this->assertEquals("Getting Snoop Dogg With High - #382", $result->getTitle());
	}

	public function testGetRecentEpisodes()
	{
		$result = $this->base->getRecentEpisodes();
		$this->assertEquals(20, count($result));
	}

	public function testIterateAllEntries()
	{
		$season = $this->base->getSeason(339);
		$result = $season->getAllEpisodes();

		$this->assertGreaterThan(20, count($result));
	}
}