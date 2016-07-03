<?php

class LiveStreamTest extends \PHPUnit_Framework_TestCase
{
	protected static $livestream;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();

		self::$livestream = $base->getLiveStreams()[0];
	}

	public function testGetCleanDescription()
	{
		$result = self::$livestream->getCleanDescription();
		$this->assertInternalType("string", $result);
	}

	public function testGetHTMLDescription()
	{
		$result = self::$livestream->getHTMLDescription();
		$this->assertInternalType("string", $result);
	}

	public function testGetEndsAt()
	{
		$result = self::$livestream->getEndsAt();
		$this->assertInternalType("string", $result);
	}

	public function testGetHashtag()
	{
		$result = self::$livestream->getHashtag();
		$this->assertInternalType("string", $result);
	}

	public function testGetID()
	{
		$result = self::$livestream->getID();
		$this->assertInternalType("integer", $result);
	}

	public function testGetMedia()
	{
		$result = self::$livestream->getMedia();
		$this->assertInternalType("array", $result);
	}

	public function testGetPicture()
	{
		$result = self::$livestream->getPicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetSponsorOnly()
	{
		$result = self::$livestream->getSponsorOnly();
		$this->assertInternalType("boolean", $result);
	}

	public function testGetStartsAt()
	{
		$result = self::$livestream->getStartsAt();
		$this->assertInternalType("string", $result);
	}

	public function testGetTitle()
	{
		$result = self::$livestream->getTitle();
		$this->assertInternalType("string", $result);
	}

	public static function tearDownAfterClass()
	{
		self::$livestream = null;
	}
}