<?php

class BaseTest extends \PHPUnit_Framework_TestCase
{
	protected static $base;

	public static function setUpBeforeClass()
	{
		self::$base = new \RoosterTeeth\Base();
	}

	public function testGetSite()
	{
		$result = self::$base->getSite("funhaus");
		$this->assertEquals("funhaus", $result->getName());
	}

	public function testGetShow()
	{
		$result = self::$base->getShow(71);
		$this->assertEquals("Rooster Teeth Podcast", $result->getName());
	}

	public function testGetSeason()
	{
		$result = self::$base->getSeason(351);
		$this->assertEquals(2016, $result->getNumber());
	}

	public function testGetEpisode()
	{
		$result = self::$base->getEpisode(28807);
		$this->assertEquals("Getting Snoop Dogg With High - #382", $result->getTitle());
	}

	public function testGetRecentEpisodes()
	{
		$result = self::$base->getRecentEpisodes();
		$this->assertEquals(20, count($result));
	}

	public function testIterateAllEntries()
	{
		$season = self::$base->getSeason(339);
		$result = $season->getAllEpisodes();

		$this->assertGreaterThan(20, count($result));
	}

	public static function tearDownAfterClass()
	{
		self::$base = null;
	}
}