/**
* Select and Populate File Field
*/
var GFPD_ShortcodeModal = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.formActions = {
		downloads : 'gfpd_all_downloads',
		forms : 'gfpd_all_forms',
		fields : 'gfpd_form_fields'
	}

	plugin.selectors = {
		modalBtn : '[data-add-download-button]',
		modal : '[data-gfpd-download-modal]',
		closeModalBtn : '[data-gfpd-close-modal]',
		insertBtn : '[data-gfpd-insert-download]',
		downloadList : '[data-gfpd-download-list]',
		downloadListItem : '[data-gfpd-download-post]',
		downloadListError : '[data-gfpd-download-list-error]',
		formList : '[data-gfpd-form-list]',
		formListError : '[data-gfpd-form-list-error]',
		formListItem : '[data-gfpd-form-post]',
		fieldList : '[data-gfpd-field-list]',
		fieldListError : '[data-gfpd-field-list-error]',
		fieldListItem : '[data-gfpd-field-post]'
	}

	plugin.fields = {
		downloadId : '[data-gfpd-download-id]',
		buttonText : '[data-gfpd-button-text]',
		css : '[data-gfpd-css]',
		modalTitle : '[data-gfpd-modal-title]',
		formId : '[data-gfpd-form-id]',
		fieldId : '[data-gfpd-field-id]'
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
		$(document).on('click', plugin.selectors.downloadListItem, function(e){
			e.preventDefault();
			plugin.populateDownloadId($(this));
		});
		$(document).on('click', plugin.selectors.formListItem, function(e){
			e.preventDefault();
			plugin.populateFormId($(this));
		});
		$(document).on('click', plugin.selectors.fieldListItem, function(e){
			e.preventDefault();
			plugin.populateFieldId($(this));
		});
	}

	/**
	* Open the Shortcode Modal
	*/
	plugin.openModal = function()
	{
		$(plugin.selectors.modal).addClass('shown');
		plugin.getDownloads();
		plugin.getForms();
	}

	/**
	* Close the Shortcode Modal
	*/
	plugin.closeModal = function()
	{
		$(plugin.selectors.modal).removeClass('shown');
		$(plugin.selectors.downloadListItem).removeClass('selected');
		$(plugin.selectors.fieldList).find('ul').empty();
		$(plugin.fields.downloadId).val(null);
		$(plugin.fields.formId).val(null);
		$(plugin.fields.fieldId).val(null);
	}

	/**
	* Get all the downloads to populate the list to choose from
	*/
	plugin.getDownloads = function()
	{
		$(plugin.selectors.downloadList).addClass('loading').find('ul').empty();
		$(plugin.selectors.downloadListError).hide();
		$.ajax({
			url : gfpd_admin.ajaxurl,
			type: 'post',
			datatype: 'json',
			data: {
				action : plugin.formActions.downloads,
				nonce : gfpd_admin.nonce
			},
			success: function(data){
				if ( data.status === 'error' ){
					$(plugin.selectors.downloadListError).text(data.message).show();
					$(plugin.selectors.downloadList).removeClass('loading');
					return;
				}
				plugin.populateDownloadList(data.response);
			}
		});
	}

	/**
	* Populate the download list with retrieved data
	*/
	plugin.populateDownloadList = function(posts)
	{
		var html = "";
		$.each(posts, function(i, v){
			html += '<li><a href="#" data-gfpd-download-post="' + posts[i].id + '">' + posts[i].title + '</a></li>';
		});
		$(plugin.selectors.downloadList).removeClass('loading').find('ul').html(html);
	}

	/**
	* Populate the Download ID Field Based on List Selection
	*/
	plugin.populateDownloadId = function(item)
	{
		var post_id = $(item).attr('data-gfpd-download-post');
		$(plugin.fields.downloadId).val(post_id);
		$(plugin.selectors.downloadListItem).removeClass('selected');
		$(item).addClass('selected');
	}

	/**
	* Get all the forms
	*/
	plugin.getForms = function()
	{
		$(plugin.selectors.formList).addClass('loading').find('ul').empty();
		$(plugin.selectors.formListError).hide();
		$.ajax({
			url : gfpd_admin.ajaxurl,
			type: 'post',
			datatype: 'json',
			data: {
				action : plugin.formActions.forms,
				nonce : gfpd_admin.nonce
			},
			success: function(data){
				if ( data.status === 'error' ){
					$(plugin.selectors.formListError).text(data.message).show();
					$(plugin.selectors.formList).removeClass('loading');
					return;
				}
				plugin.populateFormList(data.response);
			}
		});
	}

	/**
	* Populate the form list with retrieved data
	*/
	plugin.populateFormList = function(posts)
	{
		var html = "";
		$.each(posts, function(i, v){
			html += '<li><a href="#" data-gfpd-form-post="' + posts[i].id + '">' + posts[i].title + '</a></li>';
		});
		$(plugin.selectors.formList).removeClass('loading').find('ul').html(html);
	}

	/**
	* Populate the Form ID Field Based on List Selection
	*/
	plugin.populateFormId = function(item)
	{
		var post_id = $(item).attr('data-gfpd-form-post');
		$(plugin.fields.formId).val(post_id);
		$(plugin.selectors.formListItem).removeClass('selected');
		$(item).addClass('selected');
		plugin.getFields();
	}

	/**
	* Get all the fields associated with a form
	*/
	plugin.getFields = function()
	{
		$(plugin.selectors.fieldList).addClass('loading').find('ul').empty();
		$(plugin.selectors.fieldListError).hide();
		$.ajax({
			url : gfpd_admin.ajaxurl,
			type: 'post',
			datatype: 'json',
			data: {
				action : plugin.formActions.fields,
				nonce : gfpd_admin.nonce,
				formId : $(plugin.fields.formId).val()
			},
			success: function(data){
				if ( data.status === 'error' ){
					$(plugin.selectors.fieldListError).text(data.message).show();
					$(plugin.selectors.fieldList).removeClass('loading');
					return;
				}
				plugin.populateFieldList(data.response);
			}
		});
	}

	/**
	* Populate the field list with retrieved data
	*/
	plugin.populateFieldList = function(posts)
	{
		var html = "";
		$.each(posts, function(i, v){
			html += '<li><a href="#" data-gfpd-field-post="' + posts[i].id + '">' + posts[i].title + '</a></li>';
		});
		$(plugin.selectors.fieldList).removeClass('loading').find('ul').html(html);
	}

	/**
	* Populate the Field ID Field Based on List Selection
	*/
	plugin.populateFieldId = function(item)
	{
		var post_id = $(item).attr('data-gfpd-field-post');
		$(plugin.fields.fieldId).val(post_id);
		$(plugin.selectors.fieldListItem).removeClass('selected');
		$(item).addClass('selected');
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

		var formId = $(plugin.fields.formId).val();
		var fieldId = $(plugin.fields.fieldId).val();

		var shortcode = '[protected_download_button download="' + downloadId + '" text="' + buttonText + '" class="' + css + '" modal-title="' + modalTitle + '" form-id="' + formId + '" field-id="' + fieldId + '"]';

		wp.media.editor.insert(shortcode);
		plugin.closeModal();
	}

	return plugin.bindEvents();
}