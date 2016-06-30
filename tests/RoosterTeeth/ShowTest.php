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
		$this->assertEquals("258", $result);
	}

	public function testGetName()
	{
		$result = self::$show->getName();
		$this->assertEquals("Theater Mode", $result);
	}

	public function testGetHTMLSummary()
	{
		$result = self::$show->getHTMLSummary();
		$this->assertEquals("<p>Achievement Hunter is determined to sit through some of the worst movies ever made, and they want you to suffer with them.</p>", $result);
	}

	public function testGetCleanSummary()
	{
		$result = self::$show->getCleanSummary();
		$this->assertEquals("Achievement Hunter is determined to sit through some of the worst movies ever made, and they want you to suffer with them.", $result);
	}

	public function testGetSlug()
	{
		$result = self::$show->getSlug();
		$this->assertEquals("theater-mode", $result);
	}

	public function testGetSeasonCount()
	{
		$result = self::$show->getSeasonCount();
		$this->assertGreaterThan(0, $result);
	}

	public function testGetCoverPicture()
	{
		$result = self::$show->getCoverPicture();
		$this->assertEquals("http://s3.amazonaws.com/cdn.roosterteeth.com/uploads/images/164e3c69-99c2-4b83-b368-595dfc066a87/original/2013912-1461866368253-ah_theatermode_rt.jpg", $result["content"]["lg"]);
	}

	public function testGetProfilePicture()
	{
		$result = self::$show->getProfilePicture();
		$this->assertEquals("http://s3.amazonaws.com/cdn.roosterteeth.com/uploads/images/6b58b031-22e4-47bd-ad87-a8069724fab1/original/2013912-1461866368256-ah_theatermode_rtavatar.jpg", $result["content"]["lg"]);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$show->getCanonicalURL();
		$this->assertEquals("http://www.roosterteeth.com/show/theater-mode", $result);
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