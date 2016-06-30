<?php namespace RoosterTeeth;

class Episode
{

	protected $_episode_data = null;
	protected $_base = null;

	function __construct($episode_data, $base)
	{
		$this->_episode_data = $episode_data;
		$this->_base = $base;
	}
	
	function getID()
	{
		return $this->_episode_data["id"];
	}
	
	function getTitle()
	{
		return $this->_episode_data["title"];
	}
	
	function getCaption()
	{
		return $this->_episode_data["caption"];
	}
	
	function getHTMLDescription()
	{
		return $this->_episode_data["description"]["html"];
	}
	
	function getCleanDescription()
	{
		return $this->_episode_data["description"]["clean"];
	}
	
	function getSlug()
	{
		return $this->_episode_data["slug"];
	}
	
	function getSite()
	{
		return $this->_episode_data["site"];
	}
	
	function getNumber()
	{
		return $this->_episode_data["number"];
	}
	
	function getLength()
	{
		return $this->_episode_data["length"];
	}
	
	function getProfilePicture()
	{
		return $this->_episode_data["profilePicture"];
	}
	
	function getCanonicalURL()
	{
		return $this->_episode_data["canonicalUrl"];
	}
	
	function getMedia()
	{
		return $this->_episode_data["media"];
	}

	function getSponsorOnly()
	{
		return filter_var($this->_episode_data["sponsorOnly"], FILTER_VALIDATE_BOOLEAN);
	}

	function getWatched()
	{
		if ($this->_episode_data["watched"] == "watched")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getShow()
	{
		return new Show($this->_episode_data["show"], $this->_base);
	}
	
	function getSeason()
	{
		return new Season($this->_episode_data["season"], $this->_base);
	}
}
