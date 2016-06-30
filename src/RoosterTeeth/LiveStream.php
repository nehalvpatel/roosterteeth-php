<?php namespace RoosterTeeth;

class LiveStream
{

	protected $_livestream_data = null;
	protected $_base = null;

	function __construct($livestream_data, $base)
	{
		$this->_livestream_data = $livestream_data;
		$this->_base = $base;
	}

	function getCleanDescription()
	{
		return $this->_livestream_data["description"]["clean"];
	}

	function getHTMLDescription()
	{
		return $this->_livestream_data["description"]["html"];
	}

	function getEndsAt()
	{
		return $this->_livestream_data["endsAt"];
	}

	function getHashtag()
	{
		return $this->_livestream_data["hashtag"];
	}
	
	function getID()
	{
		return $this->_livestream_data["id"];
	}

	function getMedia()
	{
		if (isset($this->_livestream_data["media"]))
		{
			return $this->_livestream_data["media"];
		}
		else
		{
			return array();
		}
	}

	function getPicture()
	{
		return $this->_livestream_data["picture"];
	}

	function getSponsorOnly()
	{
		return filter_var($this->_livestream_data["sponsorOnly"], FILTER_VALIDATE_BOOLEAN);
	}

	function getStartsAt()
	{
		return $this->_livestream_data["startsAt"];
	}
	
	function getTitle()
	{
		return $this->_livestream_data["title"];
	}
}