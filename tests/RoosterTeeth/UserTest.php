<?php

class UserTest extends \PHPUnit_Framework_TestCase
{
	protected static $user;
	protected static $user2;

	public static function setUpBeforeClass()
	{
		$base = new \RoosterTeeth\Base();
		self::$user = $base->getUser(3);
	}

	public function testGetCleanAbout()
	{
		$result = self::$user->getCleanAbout();
		$this->assertInternalType("string", $result);
	}

	public function testGetHTMLAbout()
	{
		$result = self::$user->getHTMLAbout();
		$this->assertInternalType("string", $result);
	}

	public function testGetCanonicalURL()
	{
		$result = self::$user->getCanonicalURL();
		$this->assertInternalType("string", $result);
	}

	public function testGetCoverPicture()
	{
		$result = self::$user->getCoverPicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetDisplayTitle()
	{
		$result = self::$user->getDisplayTitle();
		$this->assertInternalType("string", $result);
	}

	public function testGetHasUsedTrial()
	{
		$result = self::$user->getHasUsedTrial();
		$this->assertInternalType("boolean", $result);
	}

	public function testGetID()
	{
		$result = self::$user->getID();
		$this->assertInternalType("integer", $result);
	}

	public function testGetLocation()
	{
		$result = self::$user->getLocation();
		$this->assertInternalType("string", $result);
	}

	public function testGetName()
	{
		$result = self::$user->getName();
		$this->assertInternalType("string", $result);
	}

	public function testGetOccupation()
	{
		$result = self::$user->getOccupation();
		$this->assertInternalType("string", $result);
	}

	public function testGetAllQueued()
	{
		$result = self::$user->getAllQueued();
		$this->assertInternalType("array", $result);
	}

	public function testGetQueue()
	{
		$result = self::$user->getQueue();
		$this->assertInternalType("array", $result);
	}

	public function testGetProfilePicture()
	{
		$result = self::$user->getProfilePicture();
		$this->assertInternalType("array", $result);
	}

	public function testGetSex()
	{
		$result = self::$user->getSex();
		$this->assertInternalType("string", $result);
	}

	public function testGetSponsor()
	{
		$result = self::$user->getSponsor();
		$this->assertInternalType("boolean", $result);
	}

	public function testGetUsername()
	{
		$result = self::$user->getUsername();
		$this->assertInternalType("string", $result);
	}

	public static function tearDownAfterClass()
	{
		self::$user = null;
		self::$user2 = null;
	}
}