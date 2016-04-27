<?php 
namespace GFormProtected\Settings;

use GFormProtected\Settings\SettingsRepository;

/**
* Settings page
*/
class Settings 
{
	/**
	* Settings Repository
	*/
	private $settings_repo;

	/**
	* Form Objects
	*/
	private $forms;

	public function __construct()
	{
		$this->settings_repo = new SettingsRepository;
		add_action( 'admin_menu', array( $this, 'registerPage' ) );
		add_action( 'admin_init', array($this, 'registerSettings' ) );
	}

	/**
	* Add the admin menu item
	*/
	public function registerPage()
	{
		add_options_page( 
			'Gravity Forms Protected Downloads',
			'Gravity Forms Protected Downloads',
			'manage_options',
			'gfpd', 
			array( $this, 'settingsPage' ) 
		);
	}

	/**
	* Register the settings
	*/
	public function registerSettings()
	{
		register_setting( 'gfpd-general', 'gfpd_forms' );
	}

	/**
	* Set the Forms
	*/
	private function setForms()
	{
		$this->forms = \GFAPI::get_forms();
	}

	/**
	* Display the Settings Page
	*/
	public function settingsPage()
	{
		$this->setForms();
		include( \GFormProtected\Helpers::view('settings/settings') );
	}

}