<?php

class ShowTest extends \PHPUnit_Framework_TestCase
{
	protected static $show;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$show = $base->getShow(258);
	}

	public function testGetID()
	{
		$result = self::$show->getID();
		$this->assertInternalType("integer", $result);
	}

	public function testGetName()
	{
		$result = self::$show->getName();
		$this->assertInternalType("string", $result);
	}

	public function testGetHTMLSummary()
	{
		$result = self::$show->getHTMLSummary();
		$this->assertInternalType("string", $result);
	}

	public function testGetCleanSummary()
	{
		$result = self::$show->getCleanSummary();
		$this->assertInternalType("string", $result);
	}

	public function testGetSlug()
	{
		$result = self::$show->getSlug();
		$this->assertInternalType("string", $result);
	}

	public function testGetSeasonCount()
	{
		$result = self::$show->getSeasonCount();
		$this->assertGreaterThan(0, $result);
	}

	public function testGetCoverPicture()
	{
		$result = self::$show->getCoverPicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetProfilePicture()
	{
		$result = self::$show->getProfilePicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$show->getCanonicalURL();
		$this->assertInternalType("string", $result);
	}

	public function testGetAllSeasons()
	{
		$result = self::$show->getAllSeasons();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetSeasons()
	{
		$result = self::$show->getSeasons();
		$this->assertGreaterThan(0, count($result));
	}

	public static function tearDownAfterClass()
	{
		self::$show = null;
	}
}