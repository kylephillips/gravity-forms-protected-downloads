<?php
namespace GFormProtected\Listeners;

class GetFormFields extends AJAXAdminListenerBase
{
	/**
	* Array of fields
	*/
	private $fields = array();

	/**
	* The Form ID
	*/
	private $form_id;

	public function __construct()
	{
		parent::__construct();
		$this->setFormId();
		$this->getFields();
		return $this->response($this->fields);
	}

	private function setFormId()
	{
		if ( !isset($_POST['formId']) ) return $this->error(__('A Form ID was not provided.', 'gfpd'));
		$this->form_id = intval(sanitize_text_field($_POST['formId']));
	}

	/**
	* Get all Fields for a Form
	*/
	private function getFields()
	{
		$form = \GFAPI::get_form($this->form_id);
		if ( !$form ) return $this->error(__('The form was not found.', 'gfpd'));
		$fields = $form['fields'];
		foreach ( $fields as $key => $field ){
			$this->fields[$key]['id'] = $field['id'];
			$this->fields[$key]['title'] = $field['label'];
		}
	}
}