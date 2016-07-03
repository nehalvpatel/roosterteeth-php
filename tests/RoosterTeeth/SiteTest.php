<?php

class SiteTest extends \PHPUnit_Framework_TestCase
{
	protected static $site;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$site = $base->getSite("funhaus");
	}

	public function testGetName()
	{
		$result = self::$site->getName();
		$this->assertInternalType("string", $result);
	}

	public function testGetRecentEpisodes()
	{
		$result = self::$site->getRecentEpisodes();
		$this->assertEquals(20, count($result));
	}

	public function testGetAllShows()
	{
		$result = self::$site->getAllShows();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetShows()
	{
		$result = self::$site->getShows();
		$this->assertGreaterThan(0, count($result));
	}

	public static function tearDownAfterClass()
	{
		self::$site = null;
	}
}