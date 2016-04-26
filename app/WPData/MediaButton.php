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
		echo '<a href="#" class="button gfpd-add-download-button" data-add-download-button>' . __('Add Download', 'gfpd') . '</a>';
		include(\GFormProtected\Helpers::view('download-button/insert-modal'));
	}
}