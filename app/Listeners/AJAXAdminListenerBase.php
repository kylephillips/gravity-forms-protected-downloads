<?php 
namespace GFormProtected\Listeners;

abstract class AJAXAdminListenerBase 
{
	public function __construct()
	{
		$this->validateNonce();
	}

	/**
	* Validate the Nonce
	*/
	protected function validateNonce()
	{
		if ( !wp_verify_nonce( $_POST['nonce'], 'gfpd-nonce' ) ){
			return $this->error(__('Nonce could not be validated.', 'gfpd'));
		}		
	}

	/**
	* Send an Error
	*/
	protected function error($message)
	{
		return wp_send_json(array(
			'status' => 'error',
			'message' => $message
		));
		die();
	}

	/**
	* Send a response
	*/
	protected function response($data)
	{
		return wp_send_json(array(
			'status' => 'success',
			'response' => $data
		));
	}
}