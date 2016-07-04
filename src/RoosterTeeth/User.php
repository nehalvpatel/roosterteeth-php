<?php namespace RoosterTeeth;

use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;

class User
{

	protected $_user_data = null;
	protected $_base = null;

	function __construct($user_data, $base)
	{
		$this->_user_data = $user_data;
		$this->_base = $base;
	}
	
	function getCleanAbout()
	{
		return $this->_user_data["about"]["clean"];
	}

	function getHTMLAbout()
	{
		return $this->_user_data["about"]["html"];
	}

	function setAbout($about)
	{
		$update_data = [
			"about" => $about,
			"location" => $this->getLocation(),
			"name" => $this->getName(),
			"occupation" => $this->getOccupation(),
			"sex" => $this->getSex()
		];

		$update_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["user"], $this->getID()));
		$update_response = $this->_base->_session->send($update_request, ["form_params" => $update_data, "headers" => $this->_base->_access_token]);
		$update_json = json_decode($update_response->getBody(), true);

		$this->_user_data = $update_json;
	}
	
	function getCanonicalURL()
	{
		return $this->_user_data["canonicalUrl"];
	}

	function getCoverPicture()
	{
		return $this->_user_data["coverPicture"];
	}

	function getDisplayTitle()
	{
		return $this->_user_data["displayTitle"];
	}

	function getHasUsedTrial()
	{
		return filter_var($this->_user_data["hasUsedTrial"], FILTER_VALIDATE_BOOLEAN);
	}

	function getID()
	{
		return $this->_user_data["id"];
	}

	function getLocation()
	{
		return $this->_user_data["location"];
	}

	function setLocation($location)
	{
		$update_data = [
			"about" => $this->getCleanAbout(),
			"location" => $location,
			"name" => $this->getName(),
			"occupation" => $this->getOccupation(),
			"sex" => $this->getSex()
		];

		$update_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["user"], $this->getID()));
		$update_response = $this->_base->_session->send($update_request, ["form_params" => $update_data, "headers" => $this->_base->_access_token]);
		$update_json = json_decode($update_response->getBody(), true);

		$this->_user_data = $update_json;
	}

	function getName()
	{
		return $this->_user_data["name"];
	}

	function setName($name)
	{
		$update_data = [
			"about" => $this->getCleanAbout(),
			"location" => $this->getLocation(),
			"name" => $name,
			"occupation" => $this->getOccupation(),
			"sex" => $this->getSex()
		];

		$update_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["user"], $this->getID()));
		$update_response = $this->_base->_session->send($update_request, ["form_params" => $update_data, "headers" => $this->_base->_access_token]);
		$update_json = json_decode($update_response->getBody(), true);

		$this->_user_data = $update_json;
	}

	function getOccupation()
	{
		return $this->_user_data["occupation"];
	}

	function setOccupation($occupation)
	{
		$update_data = [
			"about" => $this->getCleanAbout(),
			"location" => $this->getLocation(),
			"name" => $this->getName(),
			"occupation" => $occupation,
			"sex" => $this->getSex()
		];

		$update_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["user"], $this->getID()));
		$update_response = $this->_base->_session->send($update_request, ["form_params" => $update_data, "headers" => $this->_base->_access_token]);
		$update_json = json_decode($update_response->getBody(), true);

		$this->_user_data = $update_json;
	}

	function addEpisodeToQueue($episode)
	{
		$add_request = new Request("POST", sprintf($this->_base->_endpoint_urls["queue_add"], $episode));
		$add_response = $this->_base->_session->send($add_request, ["headers" => $this->_base->_access_token]);
		$add_json = json_decode($add_response->getBody(), true);

		return filter_var($add_json["success"], FILTER_VALIDATE_BOOLEAN);
	}

	function getAllQueued($delimiter = 20)
	{
		$all_episodes = $this->_base->iterateAllEntries($this, "getQueue", $delimiter);
		return $all_episodes;
	}

	function getQueue($count = 20, $page = 1)
	{
		$queue_data = array(
			"count" => $count,
			"page" => $page
		);

		$queue_request = new Request("GET", sprintf($this->_base->_endpoint_urls["queue"], $this->getID()));
		$queue_response = $this->_base->_session->send($queue_request, ["query" => $queue_data, "headers" => $this->_base->_access_token]);
		$queue_json = json_decode($queue_response->getBody(), true);

		$episodes = array();
		foreach ($queue_json as $episodes_data)
		{
			$episode = new Episode($episodes_data, $this->_base);
			$episodes[] = $episode;
		}
		
		return $episodes;
	}

	function removeEpisodeFromQueue($episode)
	{
		$remove_request = new Request("DELETE", sprintf($this->_base->_endpoint_urls["queue_remove"], $episode));
		$remove_response = $this->_base->_session->send($remove_request, ["headers" => $this->_base->_access_token]);
		$remove_json = json_decode($remove_response->getBody(), true);

		return filter_var($remove_json["success"], FILTER_VALIDATE_BOOLEAN);
	}

	function getProfilePicture()
	{
		return $this->_user_data["profilePicture"];
	}

	function getSex()
	{
		return $this->_user_data["sex"];
	}

	function setSex($sex)
	{
		$update_data = [
			"about" => $this->getCleanAbout(),
			"location" => $this->getLocation(),
			"name" => $this->getName(),
			"occupation" => $this->getOccupation(),
			"sex" => $sex
		];

		$update_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["user"], $this->getID()));
		$update_response = $this->_base->_session->send($update_request, ["form_params" => $update_data, "headers" => $this->_base->_access_token]);
		$update_json = json_decode($update_response->getBody(), true);

		$this->_user_data = $update_json;
	}
	
	function getSponsor()
	{
		return filter_var($this->_user_data["sponsor"], FILTER_VALIDATE_BOOLEAN);
	}

	function getUsername()
	{
		return $this->_user_data["username"];
	}

	function setEpisodeAsWatched($episode)
	{
		$watched_request = new Request("PUT", sprintf($this->_base->_endpoint_urls["episode_watched"], $episode));
		$watched_response = $this->_base->_session->send($watched_request, ["headers" => $this->_base->_access_token]);
		$watched_json = json_decode($watched_response->getBody(), true);

		return filter_var($watched_json["success"], FILTER_VALIDATE_BOOLEAN);
	}
}