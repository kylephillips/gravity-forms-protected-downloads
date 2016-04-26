<?php
namespace GFormProtected\Events;

use GFormProtected\Listeners\GetAllDownloads;
use GFormProtected\Listeners\GetAllForms;
use GFormProtected\Listeners\GetFormFields;

class RegisterAdminEvents
{
	public function __construct()
	{
		add_action( 'wp_ajax_gfpd_all_downloads', array($this, 'AllDownloadsRequested' ));
		add_action( 'wp_ajax_gfpd_all_forms', array($this, 'AllFormsRequested' ));
		add_action( 'wp_ajax_gfpd_form_fields', array($this, 'FormFieldsRequested' ));
	}

	/**
	* Get all the download posts
	*/
	public function AllDownloadsRequested()
	{
		new GetAllDownloads;
	}

	/**
	* Get all Gravity Forms
	*/
	public function AllFormsRequested()
	{
		new GetAllForms;
	}

	/**
	* Fields requested for a specific Gravity Form
	*/
	public function FormFieldsRequested()
	{
		new GetFormFields;
	}
}