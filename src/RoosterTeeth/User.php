<?php namespace RoosterTeeth;

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

	function getName()
	{
		return $this->_user_data["name"];
	}

	function getOccupation()
	{
		return $this->_user_data["occupation"];
	}

	function getProfilePicture()
	{
		return $this->_user_data["profilePicture"];
	}

	function getSex()
	{
		return $this->_user_data["sex"];
	}
	
	function getSponsor()
	{
		return filter_var($this->_user_data["sponsor"], FILTER_VALIDATE_BOOLEAN);
	}

	function getUsername()
	{
		return $this->_user_data["username"];
	}
}