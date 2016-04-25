<?php
namespace GFormProtected\Activation;

abstract class DependencyBase
{
	/**
	* Plugin Directory
	*/
	protected $plugin_dir;

	/**
	* Plugin Version
	* @var string
	*/
	protected $version;

	/**
	* Plugin Shortname
	*/
	protected $plugin_shortname;

	public function __construct()
	{
		$this->setShortname();
		$this->setVersion();
		$this->plugin_dir = \GFormProtected\Helpers::plugin_url();
	}

	/**
	* Set the Plugin Shortname
	*/
	protected function setShortname()
	{
		global $gfpd_shortname;
		$this->plugin_shortname = $gfpd_shortname;
	}

	/**
	* Set the Plugin Version for dependency versioning
	*/
	protected function setVersion()
	{
		global $gfpd_version;
		$this->version = $gfpd_version;
	}
}