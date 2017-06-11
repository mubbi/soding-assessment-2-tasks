<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		if ( $this->session->userdata('Loggedin') )
		{
			redirect('tasks', 'refresh');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		
		$this->form_validation->set_rules('emailid', 'Email ID', 'valid_email|required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim|callback__user_verify');
		
		if( $this->form_validation->run() == FALSE )
		{
			$this->load->helper('form');
			$this->load->view('auth/login');
		}
		else
		{
			if ( $this->session->userdata('Loggedin') )
			{
				redirect('tasks', 'refresh');
			}
		}
	}

	public function _user_verify( $password )
	{
		$emailid = $this->input->post('emailid');
		$get_user = $this->auth_model->verify_user_login($emailid, $password);

		if( $get_user == FALSE )
		{
			$this->form_validation->set_message('_user_verify', 'Invalid Login Details');
			return FALSE;
		}

		$sess_array = array(
			'UserID' => $get_user['UserID'],
			'FullName' => $get_user['FullName'],
		);
		$this->session->set_userdata('Loggedin', TRUE);
		$this->session->set_userdata( $sess_array );
		return TRUE;
	}
}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */