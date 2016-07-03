<?php

class EpisodeTest extends \PHPUnit_Framework_TestCase
{
	protected static $episode;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$episode = $base->getEpisode(28807);
	}

	public function testGetID()
	{
		$result = self::$episode->getID();
		$this->assertInternalType("integer", $result);
	}

	public function testGetTitle()
	{
		$result = self::$episode->getTitle();
		$this->assertInternalType("string", $result);
	}

	public function testGetCaption()
	{
		$result = self::$episode->getCaption();
		$this->assertInternalType("string", $result);
	}

	public function testGetHTMLDescription()
	{
		$result = self::$episode->getHTMLDescription();
		$this->assertInternalType("string", $result);
	}

	public function testGetCleanDescription()
	{
		$result = self::$episode->getCleanDescription();
		$this->assertInternalType("string", $result);
	}

	public function testGetSlug()
	{
		$result = self::$episode->getSlug();
		$this->assertInternalType("string", $result);
	}

	public function testGetSite()
	{
		$result = self::$episode->getSite();
		$this->assertInternalType("string", $result);
	}

	public function testGetNumber()
	{
		$result = self::$episode->getNumber();
		$this->assertInternalType("integer", $result);
	}

	public function testGetLength()
	{
		$result = self::$episode->getLength();
		$this->assertInternalType("integer", $result);
	}

	public function testGetProfilePicture()
	{
		$result = self::$episode->getProfilePicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$episode->getCanonicalURL();
		$this->assertInternalType("string", $result);
	}

	public function testGetMedia()
	{
		$result = self::$episode->getMedia();
		$this->assertInternalType("array", $result);
	}

	public function testGetSponsorOnly()
	{
		$result = self::$episode->getSponsorOnly();
		$this->assertInternalType("boolean", $result);
	}

	public function testGetWatched()
	{
		$result = self::$episode->getWatched();
		$this->assertInternalType("boolean", $result);
	}

	public function testGetShow()
	{
		$result = self::$episode->getShow(71);
		$this->assertInstanceOf(\RoosterTeeth\Show::class, $result);
	}

	public function testGetSeason()
	{
		$result = self::$episode->getSeason(351);
		$this->assertInstanceOf(\RoosterTeeth\Season::class, $result);
	}

	public static function tearDownAfterClass()
	{
		self::$episode = null;
	}
}