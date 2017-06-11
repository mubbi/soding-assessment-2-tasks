<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {
	
	private $TABLE_NAME = 'tasks';
	private $TABLE_PRIMARY_KEY = 'TaskID';

	public function total_count()
	{
		$this->db->select($this->TABLE_PRIMARY_KEY);
		$this->db->from($this->TABLE_NAME);
		return $this->db->count_all_results();
	}

	public function get_tasks( $id='', $limit=FALSE, $offset=FALSE )
	{
		if ( $id != '' )
		{
			$query = $this->db->get_where($this->TABLE_NAME, array($this->TABLE_PRIMARY_KEY => $id));
			return $query->row_array();
		}

		$this->db->select('*');
		$this->db->from($this->TABLE_NAME);
		$this->db->limit( $limit, $offset );
		$this->db->order_by($this->TABLE_PRIMARY_KEY, 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add()
	{
		$data = array(
			'TaskName' => $this->input->post('task_name'),
			'TaskDescription' => $this->input->post('task_description'),
			'DateCreated' =>  date('Y-m-d H:i:s'),
			'DateUpdated' =>  date('Y-m-d H:i:s')
			);
		$this->db->insert($this->TABLE_NAME, $data);
	}

	public function edit( $id )
	{
		$data = array(
			'TaskName' => $this->input->post('task_name'),
			'TaskDescription' => $this->input->post('task_description'),
			'DateUpdated' =>  date('Y-m-d H:i:s')
			);
		$this->db->update($this->TABLE_NAME, $data, array( $this->TABLE_PRIMARY_KEY => $id ));
	}

	public function delet( $id )
	{
		$this->db->delete($this->TABLE_NAME, array($this->TABLE_PRIMARY_KEY => $id));
	}
}

/* End of file Tasks_model.php */
/* Location: ./application/models/Tasks_model.php */