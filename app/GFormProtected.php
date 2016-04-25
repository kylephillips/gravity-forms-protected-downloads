<?php 
/**
* Static Wrapper for Bootstrap Class
* Prevents T_STRING error when checking for 5.3.2
*/
class GFormProtected 
{
	public static function init()
	{
		// dev/live
		global $gfpd_env;
		$gfp_env = 'live';

		global $gfpd_version;
		$gfp_version = '0.1';

		global $gfpd_shortname;
		$gfpd_shortname = 'gravity-forms-protected-downloads';

		$app = new GFormProtected\Bootstrap;
	}
}