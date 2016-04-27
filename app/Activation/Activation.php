<?php 
namespace GFormProtected\Activation;

/**
* Plugin Activation
*/
class Activation 
{
	/**
	* Plugin Version
	*/
	private $version;

	public function __construct()
	{
		global $gfpd_version;
		$this->version = $gfpd_version;
		$this->setVersion();
	}

	/**
	* Set the Plugin Version
	*/
	private function setVersion()
	{
		update_option('gfpd_version', $this->version);
	}

}