<?php

class UserTest extends \PHPUnit_Framework_TestCase
{
	protected static $user;
	protected static $user2;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$user = $base->getUser(3);
		self::$user2 = $base->getUser(1116206);
	}

	public function testGetCleanAbout()
	{
		$result = self::$user->getCleanAbout();
		$this->assertEquals("", $result);
	}

	public function testGetHTMLAbout()
	{
		$result = self::$user->getHTMLAbout();
		$this->assertEquals("", $result);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$user->getCanonicalURL();
		$this->assertEquals("http://www.roosterteeth.com/user/gus", $result);
	}

	public function testGetCoverPicture()
	{
		$result = self::$user->getCoverPicture();
		$this->assertEquals("picture", $result["type"]);
	}

	public function testGetDisplayTitle()
	{
		$result = self::$user->getDisplayTitle();
		$this->assertEquals("Elite Staff", $result);
	}

	public function testGetHasUsedTrial()
	{
		$result = self::$user->getHasUsedTrial();
		$this->assertFalse($result);
	}

	public function testGetID()
	{
		$result = self::$user->getID();
		$this->assertEquals("3", $result);
	}

	public function testGetLocation()
	{
		$result = self::$user->getLocation();
		$this->assertEquals("Austin, TX", $result);
	}

	public function testGetName()
	{
		$result = self::$user->getName();
		$this->assertEquals("Gustavo Sorola", $result);
	}

	public function testGetOccupation()
	{
		$result = self::$user->getOccupation();
		$this->assertEquals("Tall Mexican", $result);
	}

	public function testGetAllQueued()
	{
		$result = self::$user2->getAllQueued();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetQueue()
	{
		$result = self::$user2->getQueue();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetProfilePicture()
	{
		$result = self::$user->getProfilePicture();
		$this->assertEquals("picture", $result["type"]);
	}

	public function testGetSex()
	{
		$result = self::$user->getSex();
		$this->assertEquals("m", $result);
	}

	public function testGetSponsor()
	{
		$result = self::$user->getSponsor();
		$this->assertTrue($result);
	}

	public function testGetUsername()
	{
		$result = self::$user->getUsername();
		$this->assertEquals("gus", $result);
	}

	public static function tearDownAfterClass()
	{
		self::$user = null;
		self::$user2 = null;
	}
}