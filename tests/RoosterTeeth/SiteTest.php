<?php

class SiteTest extends \PHPUnit_Framework_TestCase
{
	private $site;

	public function setUp()
	{
		$base = new \RoosterTeeth\Base();
		$this->site = $base->getSite("funhaus");
	}

	public function testGetName()
	{
		$result = $this->site->getName();
		$this->assertEquals("funhaus", $result);
	}

	public function testGetRecentEpisodes()
	{
		$result = $this->site->getRecentEpisodes();
		$this->assertEquals(20, count($result));
	}

	public function testGetAllShows()
	{
		$result = $this->site->getAllShows();
		$this->assertGreaterThan(0, count($result));
	}

	public function testGetShows()
	{
		$result = $this->site->getShows();
		$this->assertGreaterThan(0, count($result));
	}
}