<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class Site
{

	protected $_site_name = null;
	protected $_base = null;
	
	function __construct($site_name, $base)
	{
		$this->_site_name = $site_name;
		$this->_base = $base;
	}
	
	function getName()
	{
		return $this->_site_name;
	}

	function getRecentEpisodes($count = 20, $page = 1)
	{
		return $this->_base->getRecentEpisodes($this->_site_name, $count, $page);
	}

	function getAllShows($delimiter = 20)
	{
		$all_shows = $this->_base->iterateAllEntries($this, "getShows", $delimiter);
		return $all_shows;
	}

	function getShows($count = 20, $page = 1)
	{
		$shows_data = array(
			"count" => $count,
			"page" => $page,
			"site" => $this->_site_name
		);

		$shows_request = new Request("GET", $this->_base->_endpoint_urls["shows"]);
		$shows_response = $this->_base->_session->send($shows_request, ["query" => $shows_data, "headers" => $this->_base->_access_token]);
		$shows_json = json_decode($shows_response->getBody(), true);

		$shows = array();
		foreach ($shows_json as $show_data)
		{
			$show = new Show($show_data, $this->_base);
			$shows[] = $show;
		}

		return $shows;
	}
}