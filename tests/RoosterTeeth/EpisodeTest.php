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
		$this->assertEquals("28807", $result);
	}

	public function testGetTitle()
	{
		$result = self::$episode->getTitle();
		$this->assertEquals("Getting Snoop Dogg With High - #382", $result);
	}

	public function testGetCaption()
	{
		$result = self::$episode->getCaption();
		$this->assertEquals("RT Discusses Cannabis", $result);
	}

	public function testGetHTMLDescription()
	{
		$result = self::$episode->getHTMLDescription();
		$this->assertEquals("<p>Join Gus Sorola, Gavin Free, Barbara Dunkelman and Burnie Burns as they discuss second-hand highs, Kanye West, Game of Thrones and more on this week's RT Podcast! This episode originally aired on June 27, 2016, sponsored by Pizza Hut (http://bit.ly/290v288), Mike and Dave Need Wedding Dates (http://fox.co/28SaleM), Naturebox (http://bit.ly/290uyzc) and Squarespace (http://bit.ly/290ucbK). </p>", $result);
	}

	public function testGetCleanDescription()
	{
		$result = self::$episode->getCleanDescription();
		$this->assertEquals("Join Gus Sorola, Gavin Free, Barbara Dunkelman and Burnie Burns as they discuss second-hand highs, Kanye West, Game of Thrones and more on this week's RT Podcast! This episode originally aired on June 27, 2016, sponsored by Pizza Hut (http://bit.ly/290v288), Mike and Dave Need Wedding Dates (http://fox.co/28SaleM), Naturebox (http://bit.ly/290uyzc) and Squarespace (http://bit.ly/290ucbK). ", $result);
	}

	public function testGetSlug()
	{
		$result = self::$episode->getSlug();
		$this->assertEquals("rt-podcast-2016-382", $result);
	}

	public function testGetSite()
	{
		$result = self::$episode->getSite();
		$this->assertEquals("roosterTeeth", $result);
	}

	public function testGetNumber()
	{
		$result = self::$episode->getNumber();
		$this->assertEquals("382", $result);
	}

	public function testGetLength()
	{
		$result = self::$episode->getLength();
		$this->assertEquals("7576", $result);
	}

	public function testGetProfilePicture()
	{
		$result = self::$episode->getProfilePicture();
		$this->assertEquals("http://s3.amazonaws.com/cdn.roosterteeth.com/uploads/images/6f5b0215-c1ff-4aff-bc69-53d7616e0a94/original/2013912-1467129353783-rtp382_-_THUMB.jpg", $result["content"]["lg"]);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$episode->getCanonicalURL();
		$this->assertEquals("http://www.roosterteeth.com/episode/rt-podcast-2016-382", $result);
	}

	public function testGetMedia()
	{
		$result = self::$episode->getMedia();
		$this->assertEquals("video", $result["videos"][0]["type"]);
	}

	public function testGetSponsorOnly()
	{
		$result = self::$episode->getSponsorOnly();
		$this->assertFalse($result);
	}

	public function testGetWatched()
	{
		$result = self::$episode->getWatched();
		$this->assertFalse($result);
	}

	public function testGetShow()
	{
		$result = self::$episode->getShow(71);
		$this->assertEquals("Rooster Teeth Podcast", $result->getName());
	}

	public function testGetSeason()
	{
		$result = self::$episode->getSeason(351);
		$this->assertEquals(2016, $result->getNumber());
	}

	public static function tearDownAfterClass()
	{
		self::$episode = null;
	}
}