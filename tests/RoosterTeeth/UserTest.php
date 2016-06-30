<?php

class UserTest extends \PHPUnit_Framework_TestCase
{
	private $user;

	public function setUp()
	{
		$base = new \RoosterTeeth\Base();
		$this->user = $base->getUser(3);
	}

	public function testGetCleanAbout()
	{
		$result = $this->user->getCleanAbout();
		$this->assertEquals("", $result);
	}

	public function testGetHTMLAbout()
	{
		$result = $this->user->getHTMLAbout();
		$this->assertEquals("", $result);
	}

	public function testGetCanonicalURL()
	{
		$result = $this->user->getCanonicalURL();
		$this->assertEquals("http://www.roosterteeth.com/user/gus", $result);
	}

	public function testGetCoverPicture()
	{
		$result = $this->user->getCoverPicture();
		$this->assertEquals("picture", $result["type"]);
	}

	public function testGetDisplayTitle()
	{
		$result = $this->user->getDisplayTitle();
		$this->assertEquals("Elite Staff", $result);
	}

	public function testGetHasUsedTrial()
	{
		$result = $this->user->getHasUsedTrial();
		$this->assertFalse($result);
	}

	public function testGetID()
	{
		$result = $this->user->getID();
		$this->assertEquals("3", $result);
	}

	public function testGetLocation()
	{
		$result = $this->user->getLocation();
		$this->assertEquals("Austin, TX", $result);
	}

	public function testGetName()
	{
		$result = $this->user->getName();
		$this->assertEquals("Gustavo Sorola", $result);
	}

	public function testGetOccupation()
	{
		$result = $this->user->getOccupation();
		$this->assertEquals("Tall Mexican", $result);
	}

	public function testGetProfilePicture()
	{
		$result = $this->user->getProfilePicture();
		$this->assertEquals("picture", $result["type"]);
	}

	public function testGetSex()
	{
		$result = $this->user->getSex();
		$this->assertEquals("m", $result);
	}

	public function testGetSponsor()
	{
		$result = $this->user->getSponsor();
		$this->assertTrue($result);
	}

	public function testGetUsername()
	{
		$result = $this->user->getUsername();
		$this->assertEquals("gus", $result);
	}
}