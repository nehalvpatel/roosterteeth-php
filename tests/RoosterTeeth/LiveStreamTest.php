<?php

class LiveStreamTest extends \PHPUnit_Framework_TestCase
{
	protected static $livestream;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();

		foreach ($base->getLiveStreams() as $livestream)
		{
			if ($livestream->getID() == 19)
			{
				self::$livestream = $livestream;
			}
		}
	}

	public function testGetCleanDescription()
	{
		$result = self::$livestream->getCleanDescription();
		$this->assertEquals("", $result);
	}

	public function testGetHTMLDescription()
	{
		$result = self::$livestream->getHTMLDescription();
		$this->assertEquals("", $result);
	}

	public function testGetEndsAt()
	{
		$result = self::$livestream->getEndsAt();
		$this->assertEquals("2016-07-01T19:45:00+00:00", $result);
	}

	public function testGetHashtag()
	{
		$result = self::$livestream->getHashtag();
		$this->assertEquals("OffTopicAH", $result);
	}

	public function testGetID()
	{
		$result = self::$livestream->getID();
		$this->assertEquals("19", $result);
	}

	public function testGetMedia()
	{
		$result = self::$livestream->getMedia();
		$this->assertInternalType("array", $result);
	}

	public function testGetPicture()
	{
		$result = self::$livestream->getPicture();
		$this->assertEquals("picture", $result["type"]);
	}

	public function testGetSponsorOnly()
	{
		$result = self::$livestream->getSponsorOnly();
		$this->assertTrue($result);
	}

	public function testGetStartsAt()
	{
		$result = self::$livestream->getStartsAt();
		$this->assertEquals("2016-07-01T16:45:00+00:00", $result);
	}

	public function testGetTitle()
	{
		$result = self::$livestream->getTitle();
		$this->assertEquals("Off Topic", $result);
	}

	public static function tearDownAfterClass()
	{
		self::$livestream = null;
	}
}