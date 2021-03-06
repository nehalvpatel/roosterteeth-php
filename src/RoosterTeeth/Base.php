<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class Base
{

	public $_session = null;
	public $_access_token = null;
	private $_current_user = null;

	const API_ENDPOINT = "https://www.roosterteeth.com/api/v1/";
	
	public $_endpoint_urls = [
		"authorize" => "/authorization/oauth-access-token",
		"recent" => "feed",
		"episode" => "episodes/%s",
		"episode_watched" => "episodes/%s/mark-as-watched",
		"episodes" => "seasons/%s/episodes",
		"live" => "live",
		"register" => "register",
		"queue" => "users/%s/queue",
		"queue_add" => "episodes/%s/add-to-queue",
		"queue_remove" => "episodes/%s/remove-from-queue",
		"season" => "seasons/%s",
		"seasons" => "shows/%s/seasons",
		"show" => "shows/%s",
		"shows" => "shows",
		"user" => "users/%s",
		"username" => "users/username-exists/%s"
	];

	function __construct($username = "", $password = "")
	{
		$headers = [
			"User-Agent" => "Rooster Teeth/com.roosterteeth.roosterteeth (11; OS Version 9.3.2 (Build 13F69))"
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

		if ($auth_response->hasHeader("X-User-Id"))
		{
			$user_id = $auth_response->getHeader("X-User-Id")[0];

			if (is_int($user_id))
			{
				$this->_current_user = $this->getUser($user_id);
			}
		}
	}

	function currentUser()
	{
		return $this->_current_user;
	}

	function registerUser($username, $email, $password)
	{
		$register_data = array(
			"username" => $username,
			"email" => $email,
			"password" => $password,
			"password_confirmation" => $password
		);
		
		try
		{
			$register_request = new Request("POST", $this->_endpoint_urls["register"]);
			$register_response = $this->_session->send($register_request, ["form_params" => $register_data, "headers" => $this->_access_token]);
			$register_json = json_decode($register_response->getBody(), true);

			return new User($register_json, $this);
		}
		catch (\GuzzleHttp\Exception\ClientException $e)
		{
			$error_json = json_decode($e->getResponse()->getBody(), true);
			throw new \Exception ($error_json["message"]);
		}
	}

	function isUsernameAvailable($username)
	{
		$username_request = new Request("GET", sprintf($this->_endpoint_urls["username"], $username));
		$username_response = $this->_session->send($username_request, ["headers" => $this->_access_token]);
		$username_json = json_decode($username_response->getBody(), true);

		return !filter_var($username_json["exists"], FILTER_VALIDATE_BOOLEAN);
	}
	
	function getSite($site_name)
	{
		return new Site($site_name, $this);
	}
	
	function getUser($user_id)
	{
		$user_request = new Request("GET", sprintf($this->_endpoint_urls["user"], $user_id));
		$user_response = $this->_session->send($user_request, ["headers" => $this->_access_token]);
		$user_json = json_decode($user_response->getBody(), true);

		return new User($user_json, $this);
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

	function getAllLiveStreams()
	{
		$all_streams = $this->iterateAllEntries($this, "getLiveStreams", $delimiter);
		return $all_streams;
	}

	function getLiveStreams($count = 20, $page = 1)
	{
		$live_data = array(
			"count" => $count,
			"page" => $page
		);
		
		$live_request = new Request("GET", $this->_endpoint_urls["live"]);
		$live_response = $this->_session->send($live_request, ["query" => $live_data, "headers" => $this->_access_token]);
		$live_json = json_decode($live_response->getBody(), true);
		
		$streams = array();
		foreach ($live_json as $stream_data)
		{
			$stream = new LiveStream($stream_data, $this);
			$streams[] = $stream;
		}
		
		return $streams;
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
