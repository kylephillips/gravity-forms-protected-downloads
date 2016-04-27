jQuery(document).ready(function(){
	new GFPD_Bootstrap;
});

var GFPD_Bootstrap = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.bootstrap = function()
	{
		new GFPD_DownloadFileSelector;
		new GFPD_ShortcodeModal;
		new GFPD_Settings;
	}

	return plugin.bootstrap();
}