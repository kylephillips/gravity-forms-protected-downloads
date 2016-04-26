/**
* Select and Populate File Field
*/
var GFPD_ShortcodeModal = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.selectors = {
		modalBtn : '[data-add-download-button]',
		modal : '[data-gfpd-download-modal]',
		closeModalBtn : '[data-gfpd-close-modal]',
		insertBtn : '[data-gfpd-insert-download]',
		list : '[data-gfpd-download-list]',
		listItem : '[data-gfpd-download-post]',
		error : '[data-gfpd-download-list-error]'
	}

	plugin.fields = {
		downloadId : '[data-gfpd-download-id]',
		buttonText : '[data-gfpd-button-text]',
		css : '[data-gfpd-css]',
		modalTitle : '[data-gfpd-modal-title]'
	}

	plugin.bindEvents = function()
	{
		$(document).on('click', function(e){
			if ( $(e.target).hasClass('gfpd-modal-overlay') ) plugin.closeModal();
		});
		$(document).on('click', plugin.selectors.modalBtn, function(e){
			e.preventDefault();
			plugin.openModal();
		});
		$(document).on('click', plugin.selectors.closeModalBtn, function(e){
			e.preventDefault();
			plugin.closeModal();
		});
		$(document).on('click', plugin.selectors.insertBtn, function(e){
			e.preventDefault();
			plugin.insertShortcode();
		});
		$(document).on('click', plugin.selectors.listItem, function(e){
			e.preventDefault();
			plugin.populateDownloadId($(this));
		});
	}

	/**
	* Open the Shortcode Modal
	*/
	plugin.openModal = function()
	{
		$(plugin.selectors.modal).addClass('shown');
		plugin.getDownloads();
	}

	/**
	* Close the Shortcode Modal
	*/
	plugin.closeModal = function()
	{
		$(plugin.selectors.modal).removeClass('shown');
		$(plugin.fields.downloadId).val(null);
		$(plugin.selectors.listItem).removeClass('selected');
	}

	/**
	* Populate the Download ID Field Based on List Selection
	*/
	plugin.populateDownloadId = function(item)
	{
		var post_id = $(item).attr('data-gfpd-download-post');
		$(plugin.fields.downloadId).val(post_id);
		$(plugin.selectors.listItem).removeClass('selected');
		$(item).addClass('selected');
	}

	/**
	* Get all the downloads to populate the list to choose from
	*/
	plugin.getDownloads = function()
	{
		$(plugin.selectors.list).addClass('loading').find('ul').empty();
		$(plugin.selectors.error).hide();
		$.ajax({
			url : gfpd_admin.ajaxurl,
			type: 'post',
			datatype: 'json',
			data: {
				action : 'gfpd_all_downloads',
				nonce : gfpd_admin.nonce
			},
			success: function(data){
				if ( data.status === 'error' ){
					$(plugin.selectors.error).text(data.message).show();
					$(plugin.selectors.list).removeClass('loading');
					return;
				}
				plugin.populateList(data.response);
			}
		});
	}

	/**
	* Populate the download list with retrieved data
	*/
	plugin.populateList = function(posts)
	{
		var html = "";
		$.each(posts, function(i, v){
			html += '<li><a href="#" data-gfpd-download-post="' + posts[i].id + '">' + posts[i].title + '</a></li>';
		});
		$(plugin.selectors.list).removeClass('loading').find('ul').html(html);
	}

	/**
	* Insert the Shortcode into the editor
	*/
	plugin.insertShortcode = function()
	{
		var buttonText = $(plugin.fields.buttonText).val();
		if ( buttonText === "" ) buttonText = 'Download';

		var downloadId = $(plugin.fields.downloadId).val();
		var css = $(plugin.fields.css).val();

		var modalTitle = $(plugin.fields.modalTitle).val();
		if ( modalTitle === "" ) modalTitle = 'Download';

		var shortcode = '[download_button download="' + downloadId + '" text="' + buttonText + '" class="' + css + '" modal-title="' + modalTitle + '"]';

		wp.media.editor.insert(shortcode);
		plugin.closeModal();
	}

	return plugin.bindEvents();
}