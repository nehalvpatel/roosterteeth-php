<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class Base
{

	public $_session = null;
	public $_access_token = null;

	const API_ENDPOINT = "http://www.roosterteeth.com/api/v1/";
	
	public $_endpoint_urls = [
		"authorize" => "/authorization/oauth-access-token",
		"recent" => "feed",
		"episode" => "episodes/%s",
		"episodes" => "seasons/%s/episodes",
		"season" => "seasons/%s",
		"seasons" => "shows/%s/seasons",
		"show" => "shows/%s",
		"shows" => "shows"
	];

	function __construct($username = "", $password = "")
	{
		$headers = [
			"Host" => "www.roosterteeth.com",
			"Content-Type" => "application/x-www-form-urlencoded; charset=utf-8",
			"Accept" => "*/*",
			"Connection" => "keep-alive",
			"Proxy-Connection" => "keep-alive",
			"User-Agent" => "Rooster Teeth/com.roosterteeth.roosterteeth (11; OS Version 9.3.1 (Build 13E238))",
			"Accept-Language" => "en-US;q=1.0",
			"Accept-Encoding" => "gzip;q=1.0, compress;q=0.5"
		];
		
		$this->_session = new Client(["base_uri" => self::API_ENDPOINT, "cookies" => true, "headers" => $headers]);

		$auth_data = [
			"client_id" => "aToGIjvJ8Lofqmso",
			"client_secret" => "oW3CtlpnXRznUUiWLXzmaIQryFBfGmNt",
			"grant_type" => "client_credentials"
		];

		if ($username != "")
		{
			$auth_data["grant_type"] = "password";
			$auth_data["scope"] = "user.access";
			$auth_data["username"] = $username;
			$auth_data["password"] = $password;
		}
		
		$auth_request = new Request("POST", $this->_endpoint_urls["authorize"]);
		$auth_response = $this->_session->send($auth_request, ["form_params" => $auth_data]);
		$auth_json = json_decode($auth_response->getBody(), true);
		
		$access_token = $auth_json["access_token"];
		
		$this->_access_token = ["Authorization" => $access_token];
	}
	
	function getSite($site_name)
	{
		return new Site($site_name, $this);
	}
	
	function getShow($show_id)
	{
		$show_request = new Request("GET", sprintf($this->_endpoint_urls["show"], $show_id));
		$show_response = $this->_session->send($show_request, ["headers" => $this->_access_token]);
		$show_json = json_decode($show_response->getBody(), true);

		return new Show($show_json, $this);
	}

	function getSeason($season_id)
	{
		$season_request = new Request("GET", sprintf($this->_endpoint_urls["season"], $season_id));
		$season_response = $this->_session->send($season_request, ["headers" => $this->_access_token]);
		$season_json = json_decode($season_response->getBody(), true);

		return new Season($season_json, $this);
	}

	function getEpisode($episode_id)
	{
		$episode_request = new Request("GET", sprintf($this->_endpoint_urls["episode"], $episode_id));
		$episode_response = $this->_session->send($episode_request, ["headers" => $this->_access_token]);
		$episode_json = json_decode($episode_response->getBody(), true);

		return new Episode($episode_json, $this);
	}

	function getRecentEpisodes($site = "", $count = 20, $page = 1)
	{
		$feed_data = array(
			"count" => $count,
			"page" => $page,
			"site" => $site,
			"type" => "Episode"
		);
		
		$feed_request = new Request("GET", $this->_endpoint_urls["recent"]);
		$feed_response = $this->_session->send($feed_request, ["query" => $feed_data, "headers" => $this->_access_token]);
		$feed_json = json_decode($feed_response->getBody(), true);
		
		$episodes = array();
		foreach ($feed_json as $episode_data)
		{
			$episode = new Episode($episode_data["item"], $this);
			$episodes[] = $episode;
		}
		
		return $episodes;
	}

	function iterateAllEntries($class, $type, $delimiter = 20)
	{
		$all_entries = array();
		$entries_count = $delimiter;
		
		$page = 1;
		do {
			$entries = $class->$type($delimiter, $page);
			$entries_count = count($entries);
			
			$all_entries = array_merge($all_entries, $entries);
			$page++;
		} while ($entries_count == $delimiter);
		
		return $all_entries;
	}
}
