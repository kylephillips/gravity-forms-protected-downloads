<?php
namespace GFormProtected\Listeners;

class GetAllForms extends AJAXAdminListenerBase
{
	/**
	* Array of all forms
	*/
	private $forms = array();

	public function __construct()
	{
		parent::__construct();
		$this->getForms();
		return $this->response($this->forms);
	}

	/**
	* Get all Published Forms
	*/
	private function getForms()
	{
		$forms = \GFAPI::get_forms();
		if ( !$forms ) return $this->error(__('There are no forms yet.', 'gfpd'));
		foreach ($forms as $key => $form){
			$this->forms[$key] = $form;
		}
	}
}