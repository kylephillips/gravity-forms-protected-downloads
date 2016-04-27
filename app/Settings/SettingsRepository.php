<?php
namespace GFormProtected\Settings;

class SettingsRepository
{
	/**
	* Get an array of form IDs for active forms
	*/
	public function getActiveForms()
	{
		$forms = get_option('gfpd_forms');
		$form_ids = array();
		if ( !$forms ) return $form_ids;
		foreach ( $forms as $form ){
			$form_ids[] = $form['form'];
		}
		return $form_ids;
	}

	/**
	* Get an active form's download field
	*/
	public function getActiveField($form_id)
	{
		$forms = get_option('gfpd_forms');
		if ( !$forms ) return false;
		foreach ( $forms as $form ){
			if ( intval($form['form']) !== $form_id ) continue;
			if ( !$form['field'] ) return false;
			return $form['field'];
		}
	}
}