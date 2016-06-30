<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class Season
{

	protected $_season_data = null;
	protected $_base = null;
	
	function __construct($season_data, $base)
	{
		$this->_season_data = $season_data;
		$this->_base = $base;
	}
	
	function getID()
	{
		return $this->_season_data["id"];
	}
	
	function getTitle()
	{
		return $this->_season_data["title"];
	}
	
	function getDescription()
	{
		return $this->_season_data["description"];
	}
	
	function getNumber()
	{
		return $this->_season_data["number"];
	}
	
	function getSlug()
	{
		return $this->_season_data["slug"];
	}
	
	function getShow()
	{
		return new Show($this->_season_data["show"], $this->_base);
	}

	function getAllEpisodes($delimiter = 20)
	{
		$all_episodes = $this->_base->iterateAllEntries($this, "getEpisodes", $delimiter);
		return $all_episodes;
	}

	function getEpisodes($count = 20, $page = 1)
	{
		$episodes_data = array(
			"count" => $count,
			"page" => $page
		);

		$episodes_request = new Request("GET", sprintf($this->_base->_endpoint_urls["episodes"], $this->getID()));
		$episodes_response = $this->_base->_session->send($episodes_request, ["query" => $episodes_data, "headers" => $this->_base->_access_token]);
		$episodes_json = json_decode($episodes_response->getBody(), true);

		$episodes = array();
		foreach ($episodes_json as $episodes_data)
		{
			$episode = new Episode($episodes_data, $this->_base);
			$episodes[] = $episode;
		}
		
		return $episodes;
	}
}