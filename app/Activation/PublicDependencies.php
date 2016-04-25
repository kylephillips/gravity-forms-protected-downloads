<?php
namespace GFormProtected\Activation;

class PublicDependencies extends DependencyBase
{
	public function __construct()
	{
		parent::__construct();
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ));
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ));
	}

	/**
	* Public Styles
	*/
	public function styles()
	{
		wp_enqueue_style(
			$this->plugin_shortname, 
			$this->plugin_dir . '/assets/css/public/gravity-forms-protected-downloads.css', 
			array(), 
			$this->version
		);
	}

	/**
	* Public Scripts
	*/
	public function scripts()
	{
		wp_enqueue_script(
			$this->plugin_shortname, 
			$this->plugin_dir . '/assets/js/public/gform-protected-downloads-scripts.min.js', 
			array('jquery'), 
			$this->version
		);
	}
}