<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public function index()
	{
		$sessionData = $this->session->all_userdata();
		foreach( $sessionData as $key => $val )
		{
			$this->session->unset_userdata( $key );
		}
		session_destroy();

		$this->session->set_flashdata('flash_status', '<div class="alert alert-success"><i class="fa fa-check"></i> Logged out successfully!</div>');
		redirect('auth/login', 'refresh');
	}
}