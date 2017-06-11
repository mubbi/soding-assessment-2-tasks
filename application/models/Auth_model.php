<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	private $TABLE_NAME = 'users';
	private $TABLE_PRIMARY_KEY = 'UserID';

	public function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function get_user_by_id( $UserID )
	{
		$query = $this->db->get_where($this->TABLE_NAME, array($this->TABLE_PRIMARY_KEY => $UserID));
		if ( $query->num_rows() == 1 )
		{
			return $query->row_array();
		}
		return FALSE;
	}

	public function get_user_by_email( $email )
	{
		$query = $this->db->get_where($this->TABLE_NAME, array('EmailID' => $email));
		if ( $query->num_rows() == 1 )
		{
			return $query->row_array();
		}
		return FALSE;
	}

	public function verify_user_login($email_id, $password)
	{
		$this->db->select('Salt');
		$this->db->from($this->TABLE_NAME);
		$this->db->where('EmailID', $email_id);
		$run_query = $this->db->get();

		$get_salt = $run_query->row_array();

		if ( empty( $get_salt ) )
		{
			return FALSE;
		}

		$this->db->select('*');
		$this->db->from($this->TABLE_NAME);
		$this->db->where('EmailID', $email_id);
		$this->db->where('Password', md5( md5( $password.$get_salt['Salt'] ) ));
		$query = $this->db->get();
		
		if ( $query->num_rows() == 1 )
		{
			return $query->row_array();
		}
		return FALSE;
	}

}
/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */