<?php

class BaseTest extends \PHPUnit_Framework_TestCase
{
	protected static $base;

	public static function setUpBeforeClass()
	{
		self::$base = new \RoosterTeeth\Base();
	}

	public function testIsUsernameAvailable()
	{
		$result = self::$base->isUsernameAvailable("gus");
		$this->assertInternalType("boolean", $result);
	}

	public function testGetSite()
	{
		$result = self::$base->getSite("funhaus");
		$this->assertInstanceOf(\RoosterTeeth\Site::class, $result);
	}

	public function testGetShow()
	{
		$result = self::$base->getShow(71);
		$this->assertInstanceOf(\RoosterTeeth\Show::class, $result);
	}

	public function testGetSeason()
	{
		$result = self::$base->getSeason(351);
		$this->assertInstanceOf(\RoosterTeeth\Season::class, $result);
	}

	public function testGetEpisode()
	{
		$result = self::$base->getEpisode(28807);
		$this->assertInstanceOf(\RoosterTeeth\Episode::class, $result);
	}

	public function testGetRecentEpisodes()
	{
		$episode_count = 20;

		$result = self::$base->getRecentEpisodes("", $episode_count);
		$this->assertEquals($episode_count, count($result));
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