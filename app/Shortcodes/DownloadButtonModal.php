<?php
namespace GFormProtected\Shortcodes;

/**
* Outputs the modal window for the download form
*/
class DownloadButtonModal
{
	private $options;

	public function __construct($shortcode_options)
	{
		$this->options = $shortcode_options;
		add_action('wp_footer', array($this, 'renderModal'));
	}

	public function renderModal()
	{
		$download_title = get_the_title($this->options['download']);
		$out = '<div class="gfpd-modal-backdrop" data-gfpd-modal="download-modal-' . $this->options['modal_id'] . '"></div>';

		$out .= '<div class="gfpd-modal-content" data-gfpd-modal="download-modal-' . $this->options['modal_id'] . '">';
		$out .= '<div class="gfpd-modal-content-interior">';
		if ( $this->options['modal-title'] ) $out .= '<div class="gfpd-modal-header"><h3>' . $this->options['modal-title'] . '</h3></div>';
		$out .= '<div class="gfpd-modal-content-body">';
		$out .= gravity_form( $this->options['form-id'], false, false, false, array('download_id' => $this->options['download'], 'download_document' => $download_title), true, null, false );
		$out .= '<a href="#" data-modal-close class="gfpd-modal-close">&times;</a>';
		$out .= '</div><!-- .gfpd-modal-content-body -->';
		$out .= '</div><!-- .gfpd-modal-content-interior -->';
		$out .= '</div><!-- .gfpd-modal-content -->';
		echo $out;
	}
}