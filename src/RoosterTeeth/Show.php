<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class Show
{

	protected $_show_data = null;
	protected $_base = null;

	function __construct($show_data, $base)
	{
		$this->_show_data = $show_data;
		$this->_base = $base;
	}
	
	function getID()
	{
		return $this->_show_data["id"];
	}
	
	function getName()
	{
		return $this->_show_data["name"];
	}
	
	function getHTMLSummary()
	{
		return $this->_show_data["summary"]["html"];
	}
	
	function getCleanSummary()
	{
		return $this->_show_data["summary"]["clean"];
	}
	
	function getSlug()
	{
		return $this->_show_data["slug"];
	}
	
	function getSeasonCount()
	{
		return $this->_show_data["seasonCount"];
	}
	
	function getCoverPicture()
	{
		return $this->_show_data["coverPicture"];
	}
	
	function getProfilePicture()
	{
		return $this->_show_data["profilePicture"];
	}
	
	function getCanonicalURL()
	{
		return $this->_show_data["canonicalUrl"];
	}
	
	function getAllSeasons($delimiter = 20)
	{
		$all_seasons = $this->_base->iterateAllEntries($this, "getSeasons", $delimiter);
		return $all_seasons;
	}

	function getSeasons($count = 20, $page = 1)
	{
		$seasons_data = array(
			"count" => $count,
			"page" => $page
		);

		$seasons_request = new Request("GET", sprintf($this->_base->_endpoint_urls["seasons"], $this->getID()));
		$seasons_response = $this->_base->_session->send($seasons_request, ["query" => $seasons_data, "headers" => $this->_base->_access_token]);
		$seasons_json = json_decode($seasons_response->getBody(), true);

		$seasons = array();
		foreach ($seasons_json as $season_data)
		{
			$season = new Season($season_data, $this->_base);
			$seasons[] = $season;
		}
		
		return $seasons;
	}
}