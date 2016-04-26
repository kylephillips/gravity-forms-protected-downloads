/**
* Modal Window for Form Display
*/
var GFPD_FormModal = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.activeModal = "";

	plugin.selectors = {
		modalBtn : '[data-gfpd-modal-toggle]',
		modal : '[download-gfpd-modal]',
		closeBtn : '[data-modal-close]'
	}

	plugin.bindEvents = function()
	{
		$(document).on('click', plugin.selectors.modalBtn, function(e){
			e.preventDefault();
			var modal = $(this).attr('data-gfpd-modal-toggle');
			plugin.activeModal = $('*[data-gfpd-modal="' + modal + '"]');
			plugin.openModal();
		});
		$(document).on('click', plugin.selectors.closeBtn, function(e){
			e.preventDefault();
			plugin.closeModal();
		});
		$(document).on('click', function(e){
			if ( plugin.activeModal === "" ) return;
			if ( $(e.target).hasClass('gfpd-modal-backdrop') ) plugin.closeModal();
		});
	}

	plugin.openModal = function()
	{
		$(plugin.activeModal).addClass('shown');
	}

	plugin.closeModal = function()
	{
		$(plugin.activeModal).removeClass('shown');
	}

	return plugin.bindEvents();
}