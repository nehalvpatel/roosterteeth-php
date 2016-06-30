<?php

class SeasonTest extends \PHPUnit_Framework_TestCase
{
	protected static $season;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$season = $base->getSeason(423);
	}

	public function testGetID()
	{
		$result = self::$season->getID();
		$this->assertEquals("423", $result);
	}

	public function testGetTitle()
	{
		$result = self::$season->getTitle();
		$this->assertEquals("2016", $result);
	}

	public function testGetDescription()
	{
		$result = self::$season->getDescription();
		$this->assertEquals("", $result);
	}

	public function testGetNumber()
	{
		$result = self::$season->getNumber();
		$this->assertEquals("1", $result);
	}

	public function testGetSlug()
	{
		$result = self::$season->getSlug();
		$this->assertEquals("theater-mode-2016", $result);
	}

	public function testGetShow()
	{
		$result = self::$season->getShow()->getID();
		$this->assertEquals("258", $result);
	}

	public function testGetAllEpisodes()
	{
		$result = self::$season->getAllEpisodes();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetEpisodes()
	{
		$result = self::$season->getEpisodes();
		$this->assertGreaterThan(0, count($result));
	}

	public static function tearDownAfterClass()
	{
		self::$season = null;
	}
}