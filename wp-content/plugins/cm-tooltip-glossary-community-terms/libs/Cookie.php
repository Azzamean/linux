<?php
class Cookie
{	
	/**
	 * Cookie name
	 * @var string
	 */
	const COMMUNITYTERMS_COOKIE_NAME = 'cmttct_data';
	
	/**
	 * Cookie data array
	 * @var array
	 */
	private $_data = array();
	
	/**
	 * Save data to cookie.
	 */
	public function save()
	{
		setcookie(self::COMMUNITYTERMS_COOKIE_NAME, json_encode($this->_data));
	}
	
	/**
	 * Get data from cookie
	 * @return array
	 */
	public function getData()
	{
		$data_string = (!empty($_COOKIE[self::COMMUNITYTERMS_COOKIE_NAME])?$_COOKIE[self::COMMUNITYTERMS_COOKIE_NAME]:'');
		return json_decode(stripslashes($data_string), true);
	}
	
	/**
	 * Save value in data array.
	 * @param string $key
	 * @param mixed $value
	 */
	public function __set($key, $value)
	{
		$this->_data[$key] = $value;
	}
	
	/**
	 * Clear cookie data.
	 */
	public function clear()
	{
		// Set expired cookie
		setcookie(self::COMMUNITYTERMS_COOKIE_NAME, 0, time() - 3600);
	}
}