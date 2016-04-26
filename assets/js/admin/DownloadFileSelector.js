/**
* Select a Download from the WP Media Library
* Provides JS for File field under Download Post Type
*/
var GFPD_DownloadFileSelector = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.selectors = {
		openBtn : '[data-gfpd-open-media-library]',
		removeBtn : '[data-gfpd-remove-attachment]',
	}

	plugin.fields = {
		downloadId : '[data-gfpd-download-id]'
	}

	plugin.bindEvents = function()
	{
		$(document).on('click', plugin.selectors.openBtn, function(e){
			e.preventDefault();
			plugin.openMediaLibrary();
		});
		$(document).on('click', plugin.selectors.removeBtn, function(e){
			e.preventDefault();
			plugin.clearField();
		});
	}

	/**
	* Open the Media Library Window
	*/
	plugin.openMediaLibrary = function()
	{
		// If the object already exists, open it
		if (wp.media.frames.gfpd_frame){
    		wp.media.frames.gfpd_frame.open();
    		return;
		}

		// Create the frame object
		wp.media.frames.gfpd_frame = wp.media({
		   title: 'Select File',
		   multiple: false,
		   button: {
		      text: 'Insert File'
		   }
		});

		var set_file = function(){
			var selection = wp.media.frames.gfpd_frame.state().get('selection');
			if (!selection) return;
 			plugin.populateField(selection);
		};
 
		// Close Event for Media Library
		wp.media.frames.gfpd_frame.on('close', set_file);
		
		// Show the Media Library
		wp.media.frames.gfpd_frame.open();
	}

	/**
	* Populate the File Field when the Media Library Closes
	*/
	plugin.populateField = function(selection)
	{
		selection.each(function(attachment){
			var id = attachment.id;
			var title = attachment.attributes.title;
			var filename = attachment.attributes.filename;
			var filesize = attachment.attributes.filesizeHumanReadable;
			var url = attachment.attributes.url;

			$(plugin.fields.downloadId).val(id);
			$('[data-download-link]').attr('href', url);
			$('[data-download-filename]').text(filename);
			$('[data-download-title]').text(title);
			$('.download-meta').removeClass('no-attachment');
			$(plugin.selectors.openBtn).addClass('has-attachment');
			$('.gfpd-file-meta').addClass('has-attachment');
        });
	}

	/**
	* Clear the Field
	*/
	plugin.clearField = function()
	{
		$(plugin.selectors.openBtn).removeClass('has-attachment');
		$('.gfpd-file-meta').removeClass('has-attachment');
		$(plugin.fields.downloadId).val(null);
		$('.download-meta').addClass('no-attachment');
	}

	return plugin.bindEvents();
}