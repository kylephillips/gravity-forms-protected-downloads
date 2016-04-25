<?php
namespace GFormProtected\Activation;

class AdminDependencies extends DependencyBase
{
	public function __construct()
	{
		parent::__construct();
		add_action( 'admin_enqueue_scripts', array( $this, 'styles' ));
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ));
	}

	/**
	* Admin Styles
	*/
	public function styles()
	{
		wp_enqueue_style(
			$this->plugin_shortname . '-admin', 
			$this->plugin_dir . '/assets/css/admin/gravity-forms-protected-downloads.css', 
			array(), 
			$this->version
		);
	}

	/**
	* Admin Scripts
	*/
	public function scripts()
	{
		wp_enqueue_script(
			$this->plugin_shortname . '-admin', 
			$this->plugin_dir . '/assets/js/admin/gform-protected-downloads-scripts.min.js', 
			array('jquery'), 
			$this->version
		);
	}
}