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
		$this->assertInternalType("integer", $result);
	}

	public function testGetTitle()
	{
		$result = self::$season->getTitle();
		$this->assertInternalType("string", $result);
	}

	public function testGetDescription()
	{
		$result = self::$season->getDescription();
		$this->assertInternalType("string", $result);
	}

	public function testGetNumber()
	{
		$result = self::$season->getNumber();
		$this->assertInternalType("integer", $result);
	}

	public function testGetSlug()
	{
		$result = self::$season->getSlug();
		$this->assertInternalType("string", $result);
	}

	public function testGetShow()
	{
		$result = self::$season->getShow();
		$this->assertInstanceOf(\RoosterTeeth\Show::class, $result);
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