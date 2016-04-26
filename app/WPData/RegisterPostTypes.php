<?php
namespace GFormProtected\WPData;

/**
* Register the Required Post Types
*/
class RegisterPostTypes
{
	public function __construct()
	{
		add_action( 'init', array( $this, 'downloads') );
	}

	/**
	* Downloads
	*/
	public function downloads()
	{
		$labels = array(
			'name' => __('Downloads', 'gfpd'),  
			'singular_name' => __('Download', 'gfpd'),
			'add_new_item'=> __('Add Download', 'gfpd'),
			'edit_item' => __('Edit Download', 'gfpd'),
			'view_item' => __('View Download', 'gfpd')
		);
		$args = array(
			'labels' => $labels,
			'public' => true, 
			'show_ui' => true,
			'menu_position' => 5,
			'capability_type' => 'post',  
			'hierarchical' => false, 
			'has_archive' => false, 
			'menu_icon' => 'dashicons-download',
			'supports' => array('title'),
			'rewrite' => array('slug' => 'download', 'with_front' => false)
		);

		register_post_type( 'download' , apply_filters('gfpd_posttype_args', $args) );
	}
}