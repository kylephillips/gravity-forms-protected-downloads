<?php
namespace GFormProtected\Events;

use GFormProtected\Listeners\GetAllDownloads;

class RegisterAdminEvents
{
	public function __construct()
	{
		add_action( 'wp_ajax_gfpd_all_downloads', array($this, 'AllDownloadsRequested' ));
	}

	/**
	* Get all the download posts
	*/
	public function AllDownloadsRequested()
	{
		new GetAllDownloads;
	}
}