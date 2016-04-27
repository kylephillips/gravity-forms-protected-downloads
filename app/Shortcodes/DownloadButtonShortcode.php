<?php
namespace GFormProtected\Shortcodes;

use GFormProtected\Shortcodes\DownloadButtonModal;

/**
* Display a download button that opens a form modal for lead gen
*/
class DownloadButtonShortcode
{
	/**
	* Shortcode Options
	* @var array
	*/
	private $options;

	/**
	* The Download Post
	*/
	private $download_id;

	public function __construct()
	{
		add_shortcode('protected_download_button', array($this, 'renderView'));
	}

	/**
	* Shortcode Options
	*/
	private function setOptions($options)
	{
		$this->options = shortcode_atts(array(
			'text' => __('Download', 'gfpd'), // Button Text
			'download' => null, // Download Post ID
			'class' => 'btn', // Button CSS Class(es)
			'modal-title' => null, // Modal Title Text
			'modal_id' => substr(md5(microtime()),rand(0,26),5), // Unique ID for Modal (for multiple buttons on the same page)
			'form-id' => null, // Gravity Forms Form ID
			'field-id' => null // Field ID for Capturing Download Title
		), $options);
	}

	public function renderView($options)
	{
		$this->setOptions($options);
		if ( !$this->options['download'] ) return;
		if ( !$this->options['form-id'] ) return;

		$filter = "gform_confirmation_" . $this->options['form-id'];
		add_filter($filter, array($this, 'downloadMessage'), 10, 4);

		return $this->renderButton();
	}

	/**
	* Render the download button
	*/
	public function renderButton()
	{
		$modal = new DownloadButtonModal($this->options);
		return '<a href="#" data-download="' . $this->options['download'] . '" class="' . $this->options['class'] . '" data-gfpd-modal-toggle="download-modal-' . $this->options['modal_id'] . '">' . $this->options['text'] . '</a>';
	}

	/**
	* File Download Confirmation Message
	*/
	public function downloadMessage($confirmation, $form, $entry, $ajax)
	{
		// $file = get_field('download_file', intval($entry['6']));
		// if ( !$file ) return $confirmation; // No PDF download

		// $time = time();
		// $code = $time - ($time % 1800);

		// $link = plugins_url() . '/goentergy/download-file.php?code=' . $code . '&file=' . urlencode($file['url']);
		// $out = '<div class="download-confirmation">';
		// $out .= get_field('download_confirmation', 'options');
		// $out .= '<button id="downloadlink" class="btn btn-large">' . __('Download', 'goentergy') . '</button>';
		// $out .= '</div>';
		// $out .= '<script>jQuery(document).ready(function(){jQuery("#downloadlink").on("click", function(){ window.location ="' . $link . '"; }); jQuery("#downloadlink").trigger("click"); });</script>';
		return 'Testing';
	}

}