/**
* Select and Populate File Field
*/
var GFormProtectedFileSelector = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.selectors = {
		'openBtn' : '[data-gfpd-open-media-library]',
		'field' : '#gfpd_download',
		'removeBtn' : '[data-gfpd-remove-attachment]'
	}

	plugin.bindEvents = function()
	{
		$(document).on('click', plugin.selectors.openBtn, function(e){
			e.preventDefault();
			plugin.openWindow($(this));
		});
		$(document).on('click', plugin.selectors.removeBtn, function(e){
			e.preventDefault();
			plugin.clearField();
		});
	}

	/**
	* Open the ML Window
	*/
	plugin.openWindow = function(clicked_button)
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
 
		// closing event for media manger
		wp.media.frames.gfpd_frame.on('close', set_file);
		
		// showing media manager
		wp.media.frames.gfpd_frame.open();
	}

	/**
	* Populate the Field on Close
	*/
	plugin.populateField = function(selection)
	{
		selection.each(function(attachment){
			
			var id = attachment.id;
			var title = attachment.attributes.title;
			var filename = attachment.attributes.filename;
			var filesize = attachment.attributes.filesizeHumanReadable;
			var url = attachment.attributes.url;

			$(plugin.selectors.field).val(id);
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
		$(plugin.selectors.field).val(null);
		$('.download-meta').addClass('no-attachment');
	}

	return plugin.bindEvents();
}