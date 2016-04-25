jQuery(document).ready(function(){
	new GFormProtected;
});

var GFormProtected = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.bootstrap = function()
	{
		new GFormProtectedFileSelector;
		plugin.bindEvents();
	}

	plugin.bindEvents = function()
	{
		
	}

	return plugin.bootstrap();
}