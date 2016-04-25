<?php
namespace GFormProtected\WPData;

/**
* Meta Fields for Download Post Type
*/
class PostMeta
{
	/**
	* Meta Data
	*/
	private $meta;

	/**
	* Fields
	*/
	public $fields;

	/**
	* Download Post Info
	*/
	private $download_meta = array();

	function __construct()
	{
		$this->setFields();
		add_action( 'add_meta_boxes', array( $this, 'metaBox' ));
		add_action( 'save_post', array($this, 'savePost' ));
	}

	/**
	* Set the Fields for use in custom meta
	*/
	private function setFields()
	{
		$this->fields = array(
			'download' => 'gfpd_download',
		);
	}

	/**
	* Register the Meta Box
	*/
	public function metaBox() 
	{
    	add_meta_box( 
    		'gfpd-meta-box', 
    		__('File', 'gfpd'), 
    		array($this, 'displayMeta'), 
    		'download', 
    		'normal', 
    		'high' 
    	);
	}

	/**
	* Meta Boxes for Output
	*/
	public function displayMeta($post)
	{
		$this->setData($post);
		$this->setDownloadMeta();
		include( \GFormProtected\Helpers::view('post-meta/download-meta') );
	}

	/**
	* Set the Field Data
	*/
	private function setData($post)
	{
		foreach ( $this->fields as $key=>$field )
		{
			$this->meta[$key] = get_post_meta( $post->ID, $field, true );
		}
	}

	/**
	* Set the Download Meta Data
	*/
	private function setDownloadMeta()
	{
		if ( !$this->meta['download'] ) return;
		$post = get_post($this->meta['download']);
		if ( !$post ) return;		

		$this->download_meta['title'] = $post->post_title;
		$this->download_meta['link'] = $post->guid;
		$this->download_meta['file'] = $post->post_name;
		$this->download_meta['ext'] = \GFormProtected\Helpers::fileExtension($post->post_mime_type);
	}


	/**
	* Save the custom post meta
	*/
	public function savePost( $post_id ) 
	{
		if ( get_post_type($post_id) == 'download') :
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
			if( !isset( $_POST['gfpd_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['gfpd_meta_box_nonce'], 'my_gfpd_meta_box_nonce' ) ) return $post_id;

			update_post_meta( $post_id, 'gfpd_download', esc_attr( $_POST['gfpd_download'] ) );
		endif;
	} 

}