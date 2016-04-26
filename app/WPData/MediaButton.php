<?php
namespace GFormProtected\WPData;

/**
* Add the Media Button for inserting a download button in the editor
*/
class MediaButton
{
	public function __construct()
	{
		add_action('media_buttons', array($this, 'addMediaButton'), 25);
	}

	public function addMediaButton()
	{
		$text = apply_filters('gfpd_media_button_text', __('Add Download', 'gfpd'));
		echo '<a href="#" class="button gfpd-add-download-button" data-add-download-button>' . $text . '</a>';
		include(\GFormProtected\Helpers::view('download-button/insert-modal'));
	}
}