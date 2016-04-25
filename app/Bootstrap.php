<?php
namespace GFormProtected;

/**
* Primary Plugin Bootstrap
*/
class Bootstrap
{
	public function __construct()
	{
		global $gfpd_shortname;
		$this->initializePlugin();
		add_action( 'init', array($this, 'initializeWordPress') );
		add_filter( 'plugin_action_links_' . $gfpd_shortname . '/' . $gfpd_shortname . '.php', array($this, 'settingsLink' ) );
	}

	/**
	* Initialize Plugin
	*/
	private function initializePlugin()
	{
		// new Entities\PostType\RegisterPostTypes;
	}

	/**
	* Wordpress Initialization Actions
	*/
	public function initializeWordPress()
	{
		$this->addLocalization();
	}

	/**
	* Localization Domain
	*/
	public function addLocalization()
	{
		load_plugin_textdomain(
			'gfpd', 
			false, 
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}

	/**
	* Add a link to the settings on the plugin page
	*/
	public function settingsLink($links)
	{ 
		$settings_link = '<a href="options-general.php?page=gravity-forms-protected-downlaods-settings">' . __('Settings') . '</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
}