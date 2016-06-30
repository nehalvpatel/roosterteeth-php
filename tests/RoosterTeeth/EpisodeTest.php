<?php

class EpisodeTest extends \PHPUnit_Framework_TestCase
{
	private $episode;

	public function setUp()
	{
		$base = new \RoosterTeeth\Base();
		$this->episode = $base->getEpisode(28807);
	}

	public function testGetID()
	{
		$result = $this->episode->getID();
		$this->assertEquals("28807", $result);
	}

	public function testGetTitle()
	{
		$result = $this->episode->getTitle();
		$this->assertEquals("Getting Snoop Dogg With High - #382", $result);
	}

	public function testGetCaption()
	{
		$result = $this->episode->getCaption();
		$this->assertEquals("RT Discusses Cannabis", $result);
	}

	public function testGetHTMLDescription()
	{
		$result = $this->episode->getHTMLDescription();
		$this->assertEquals("<p>Join Gus Sorola, Gavin Free, Barbara Dunkelman and Burnie Burns as they discuss second-hand highs, Kanye West, Game of Thrones and more on this week's RT Podcast! This episode originally aired on June 27, 2016, sponsored by Pizza Hut (http://bit.ly/290v288), Mike and Dave Need Wedding Dates (http://fox.co/28SaleM), Naturebox (http://bit.ly/290uyzc) and Squarespace (http://bit.ly/290ucbK). </p>", $result);
	}

	public function testGetCleanDescription()
	{
		$result = $this->episode->getCleanDescription();
		$this->assertEquals("Join Gus Sorola, Gavin Free, Barbara Dunkelman and Burnie Burns as they discuss second-hand highs, Kanye West, Game of Thrones and more on this week's RT Podcast! This episode originally aired on June 27, 2016, sponsored by Pizza Hut (http://bit.ly/290v288), Mike and Dave Need Wedding Dates (http://fox.co/28SaleM), Naturebox (http://bit.ly/290uyzc) and Squarespace (http://bit.ly/290ucbK). ", $result);
	}

	public function testGetSlug()
	{
		$result = $this->episode->getSlug();
		$this->assertEquals("rt-podcast-2016-382", $result);
	}

	public function testGetSite()
	{
		$result = $this->episode->getSite();
		$this->assertEquals("roosterTeeth", $result);
	}

	public function testGetNumber()
	{
		$result = $this->episode->getNumber();
		$this->assertEquals("382", $result);
	}

	public function testGetLength()
	{
		$result = $this->episode->getLength();
		$this->assertEquals("7576", $result);
	}

	public function testGetProfilePicture()
	{
		$result = $this->episode->getProfilePicture();
		$this->assertEquals("http://s3.amazonaws.com/cdn.roosterteeth.com/uploads/images/6f5b0215-c1ff-4aff-bc69-53d7616e0a94/original/2013912-1467129353783-rtp382_-_THUMB.jpg", $result["content"]["lg"]);
	}

	public function testGetCanonicalURL()
	{
		$result = $this->episode->getCanonicalURL();
		$this->assertEquals("http://www.roosterteeth.com/episode/rt-podcast-2016-382", $result);
	}

	public function testGetMedia()
	{
		$result = $this->episode->getMedia();
		$this->assertEquals("video", $result["videos"][0]["type"]);
	}

	public function testGetShow()
	{
		$result = $this->episode->getShow(71);
		$this->assertEquals("Rooster Teeth Podcast", $result->getName());
	}

	public function testGetSeason()
	{
		$result = $this->episode->getSeason(351);
		$this->assertEquals(2016, $result->getNumber());
	}
}