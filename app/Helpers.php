<?php 
namespace GFormProtected;

class Helpers 
{
	/**
	* Plugin Root Directory
	*/
	public static function plugin_url()
	{
		global $gfpd_shortname;
		return plugins_url() . '/' . $gfpd_shortname;
	}

	/**
	* View
	*/
	public static function view($file)
	{
		return dirname(dirname(__FILE__)) . '/views/' . $file . '.php';
	}

}