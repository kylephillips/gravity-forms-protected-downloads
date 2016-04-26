jQuery(document).ready(function(){
	new GFPD_Bootstrap;
});

var GFPD_Bootstrap = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.bootstrap = function()
	{
		new GFPD_FormModal;
	}

	return plugin.bootstrap();
}