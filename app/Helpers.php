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
	* Site URL
	*/
	public static function site_url()
	{
		return get_bloginfo('url');
	}

	/**
	* View
	*/
	public static function view($file)
	{
		return dirname(dirname(__FILE__)) . '/views/' . $file . '.php';
	}

	/**
	* Get file extension based on mime/type
	*/
	public static function fileExtension($mime_type)
	{
		switch ($mime_type) {
			case 'image/jpeg':
				return "jpg";
				break;
			case 'image/png':
				return "png";
				break;
			case 'image/gif':
				return "gif";
				break;
			case 'application/pdf':
				return "pdf";
				break;
			case 'video/mpeg':
				return "mpeg";
				break;
			case 'video/mp4': 
				return "mp4";
				break;
			case 'text/csv':
				return "csv";
				break;
			case 'text/plain': 
				return "txt";
				break;
			case 'text/xml':
				return "xml";
				break;
			default:
				return "pdf";
		}
	}

}