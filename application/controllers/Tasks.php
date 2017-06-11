<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tasks_model');

		if ( !$this->session->userdata('Loggedin') )
		{
			redirect('auth/login', 'refresh');
		}
	}

	public function index()
	{
		$this->load->library('pagination');

		$total_rows = $this->tasks_model->total_count();

		$config['base_url'] = base_url().'/tasks/index/';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 10;
		$config['num_links'] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['first_url'] = '1';
		
		//setting bootstrap pagination
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		
		if ( $this->uri->segment(3) == '' )
		{
			$offset = '0';
		}
		else
		{
			$offset = ( $this->uri->segment(3) - 1 ) * $config['per_page'];
		}

		$data['tasks'] = $this->tasks_model->get_tasks( '', $config["per_page"], $offset );
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('tasks/view-all', $data);
	}

	public function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><i class="fa fa-warning"></i> ', '</div>');

		$this->form_validation->set_rules('task_name', 'Task Name', 'required|trim');
		$this->form_validation->set_rules('task_description', 'Task Description', 'required|trim');

		if ( $this->form_validation->run() == FALSE )
		{
			$this->load->helper('form');
			$this->load->view('tasks/add');
		}
		else
		{
			$this->tasks_model->add();
			$this->session->set_flashdata('flash_status', '<div class="alert alert-success"><i class="fa fa-check"></i> Task Added</div>');
			redirect('tasks', 'refresh');
		}
	}

	public function operation( $id )
	{
		// 1 = view, 2 = edit, 3 = delete
		$method = $this->input->get('type') == '' ? '1' : $this->input->get('type');
		// Get Task
		$data['task'] = $this->tasks_model->get_tasks( $id );

		if ( empty( $data['task'] ) )
		{
			show_404();
		}

		if ( $method == 1 )
		{
			$this->load->view('tasks/view', $data);
		}
		elseif( $method == 2 )
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><i class="fa fa-warning"></i> ', '</div>');

			$this->form_validation->set_rules('task_name', 'Task Name', 'required|trim');
			$this->form_validation->set_rules('task_description', 'Task Description', 'required|trim');

			if ( $this->form_validation->run() == FALSE )
			{
				$this->load->helper('form');
				$this->load->view('tasks/edit', $data);
			}
			else
			{
				$this->tasks_model->edit( $id );
				$this->session->set_flashdata('flash_status', '<div class="alert alert-success"><i class="fa fa-check"></i> Task Edited</div>');
				redirect('tasks/operation/'.$id.'?type=2', 'refresh');
			}
		}
		elseif( $method == 3 )
		{
			$this->tasks_model->delet( $id );
			$this->session->set_flashdata('flash_status', '<div class="alert alert-success"><i class="fa fa-check"></i> Task Deleted</div>');
			redirect('tasks', 'refresh');
		}
		else
		{
			redirect('tasks', 'refresh');
		}
	}
}
/* End of file Tasks.php */
/* Location: ./application/controllers/Tasks.php */