<?php
namespace GFormProtected\Shortcodes;

// use ObjectNine\Shortcodes\DownloadModal;

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
		add_shortcode('download_button', array($this, 'renderView'));
	}

	/**
	* Shortcode Options
	*/
	private function setOptions($options)
	{
		$this->options = shortcode_atts(array(
			'text' => 'Download',
			'download' => null,
			'class' => 'btn',
			'modal-title' => null,
			'modal_id' => substr(md5(microtime()),rand(0,26),5)
		), $options);
	}

	public function renderView($options)
	{
		$this->setOptions($options);
		if ( !$this->options['download'] ) return;
		return $this->renderButton();
	}

	/**
	* Render the download button
	*/
	public function renderButton()
	{
		// $modal = new DownloadModal($this->options);
		return '<a href="#" data-download="' . $this->options['download'] . '" class="' . $this->options['class'] . '" data-modal-toggle="download-modal-' . $this->options['modal_id'] . '">' . $this->options['text'] . '</a>';
	}

}