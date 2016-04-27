/**
* Settings/Options
*/
var GFPD_Settings = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.selectors = {
		formCheckbox : '[data-gfpd-form-checkbox]'
	}

	plugin.bindEvents = function()
	{
		$(document).on('change', plugin.selectors.formCheckbox, function(){
			plugin.toggleFieldRadios($(this));
		});
	}

	plugin.toggleFieldRadios = function(formCheckbox)
	{
		var fields = $(formCheckbox).parents('li').find('.fields');
		if ( $(formCheckbox).is(':checked') ){
			$(fields).addClass('visible');
			return;
		}
		$(fields).removeClass('visible');
	}

	return plugin.bindEvents();
}