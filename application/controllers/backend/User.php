<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        
		$this->load->model('Users', 'model_users');
	}

	public function index()
	{
		$data_filter = array(
			'keyword' => $this->input->get('keyword')
		);

		$data_js = array(
			'url_datatables'  => base_url('/tci-admin/user/datatables'),
			'start_page'      => 0,
			'display_page'    => 10,
			'header_disabled' => [0,1,2,3,4,5,6],
			'data_filter'     => $data_filter
		);

		$data_content = array(
			'url_home'    => base_url('/tci-admin/user'),
			'url_add'     => base_url('/tci-admin/user/add'),
			'data_filter' => $data_filter
		);

		$data = array(
			'content'    => $this->load->view('backend/user/index', $data_content, TRUE),
			'js_content' => $this->load->view('backend/user/index_js', $data_js, TRUE)
		);

		$this->load->view('backend/template/master', $data);
	}

	public function datatables()
	{
		$return = array();

		if ($this->input->get('keyword')) {
			$keyword = strtolower($this->input->get('keyword'));
			$keyword = addslashes($keyword);

			$this->db->group_start()
				->like('users.username', $keyword)
				->or_like('users.email', $keyword)
			->group_end();
		}

		$this->db->where('users.id !=', 1);
		$query = $this->model_users->get_all();
		$count_rows = $query->num_rows();

		$return['draw'] = $this->input->get('draw');
		$return['recordsTotal'] = $count_rows;
		$return['recordsFiltered'] = $count_rows;
		$return['data'] = array();

		if ($this->input->get('keyword')) {
			$keyword = strtolower($this->input->get('keyword'));
			$keyword = addslashes($keyword);

			$this->db->group_start()
				->like('users.username', $keyword)
				->or_like('users.email', $keyword)
			->group_end();
		}

		$this->db->where('users.id !=', 1);
		$query = $this->model_users->get_all($this->input->get('start'), $this->input->get('length'));
		
		$i = $this->input->get('start');
		foreach ($query->result() as $row) {
			$i++;

			$is_active = ($row->is_active == 1)
				? '<span class="label label-success">YES</span>' 
				: '<span class="label label-danger">NO</span>';

			$action = '<div class="text-right">';
			$action .= '<a href="'.base_url('/tci-admin/user/edit/'.$row->id).'" class="btn btn-xs btn-default"><i class="icon-pencil"></i></a>';
			$action .= '</div>';

			array_push($return['data'],array(
				$i,
				$row->username,
				$row->email,
				$is_active,
				$row->created_at,
				$row->updated_at,
				$action
			));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($return));
	}

	public function add()
	{
		$data_content = array(
			'url_home' => base_url('/tci-admin/user'),
			'url_post' => base_url('/tci-admin/user/save') 
		);

		$data = array(
			'content'    => $this->load->view('backend/user/add', $data_content, TRUE),
			'js_content' => null
		);

		$this->load->view('backend/template/master', $data);
	}

	public function save()
	{
		if (!$this->input->post()) $this->index();

		$this->load->helper('security');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|alpha_dash|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		}
		else {
			$now = date('Y-m-d H:i:s');

			$set_array = array(
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'is_active' => $this->input->post('is_active'),
				'verified' => 1,
				'user_type_id' => 1,
				'created_at' => $now,
				'updated_at' => $now
			);
			$this->model_users->save($set_array);

			$this->session->set_flashdata('message','<div class="alert alert-success flash-alert text-center">New user saved successfully!</div>');
			redirect('/tci-admin/user');
		}
	}

	public function edit($id=0)
	{
		if ($id > 0) {
			$this->db->where('users.id', $id);
			$query = $this->model_users->get_all();

			if ($query->num_rows() > 0) {
				$data_content = array(
					'url_home'     => base_url('/tci-admin/user'),
					'url_post'     => base_url('/tci-admin/user/update'),
					'row'          => $query->row(),
					'is_myprofile' => FALSE
				);
		
				$data = array(
					'content' => $this->load->view('backend/user/edit', $data_content, TRUE),
					'js_content' => null
				);
		
				$this->load->view('backend/template/master', $data);
			}
			else {
				$this->session->set_flashdata('message','<div class="alert alert-warning flash-alert text-center">User does not exists!</div>');
				redirect('/tci-admin/user');
			}
		}
		else {
			redirect('/tci-admin/user');
		}
	}

	public function update() 
	{
		if (!$this->input->post()) $this->index();

		if ($this->input->post('id') > 0) {
			$is_unique_email = '';
			$is_unique_username = '';
			
			$this->db->where('users.id', $this->input->post('id'));
			$row = $this->model_users->get_all()->row();
			$original_email = $row->email;
			if ($this->input->post('email') != $original_email) $is_unique_email = '|is_unique[users.email]';
			$original_username = $row->username;
			if ($this->input->post('username') != $original_username) $is_unique_username = '|is_unique[users.username]';

			$this->load->helper('security');
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$is_unique_email);
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|alpha_dash'.$is_unique_username);
			$this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');
			if ($this->input->post('password')) $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
	
			if ($this->form_validation->run() == FALSE) {
				$this->edit($this->input->post('id'));
			}
			else {
				$now = date('Y-m-d H:i:s');
	
				$set_array = array(
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'is_active' => $this->input->post('is_active'),
					'verified' => 1,
					'user_type_id' => 1,
					'updated_at' => $now
				);
				if ($this->input->post('password')) $set_array['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$where_array = array('users.id' => $this->input->post('id'));
				$this->model_users->update($set_array, $where_array);
	
				$this->session->set_flashdata('message','<div class="alert alert-success flash-alert text-center">User updated successfully!</div>');
				redirect('/tci-admin/user');
			}
			
		} 
		else {
			$this->index();
		}	
	}

	public function myprofile()
	{
		$this->db->where('users.id', $this->session->userdata('meta_session')->id);
		$query = $this->model_users->get_all();

		if ($query->num_rows() > 0) {
			$data_content = array(
				'url_post'     => base_url('/tci-admin/user/myprofile_update'),
				'row'          => $query->row(),
				'is_myprofile' => TRUE
			);
	
			$data = array(
				'content' => $this->load->view('backend/user/myprofile', $data_content, TRUE),
				'js_content' => null
			);
	
			$this->load->view('backend/template/master', $data);
		}
		else {
			redirect('/tci-admin/home');
		}
	}

	public function myprofile_update() 
	{
		if (!$this->input->post()) redirect('/tci-admin/home');

		if ($this->session->userdata('meta_session')->id > 0) {
			$is_unique_email = '';
			$is_unique_username = '';
			
			$this->db->where('users.id', $this->session->userdata('meta_session')->id);
			$row = $this->model_users->get_all()->row();
			$original_email = $row->email;
			if ($this->input->post('email') != $original_email) $is_unique_email = '|is_unique[users.email]';
			$original_username = $row->username;
			if ($this->input->post('username') != $original_username) $is_unique_username = '|is_unique[users.username]';

			$this->load->helper('security');
			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$is_unique_email);
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|alpha_dash'.$is_unique_username);
			$this->form_validation->set_rules('is_active', 'Status', 'required|in_list[0,1]');
			if ($this->input->post('password')) $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
	
			if ($this->form_validation->run() == FALSE) {
				$this->myprofile();
			}
			else {
				$now = date('Y-m-d H:i:s');
	
				$set_array = array(
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'is_active' => $this->input->post('is_active'),
					'verified' => 1,
					'user_type_id' => 1,
					'updated_at' => $now
				);
				if ($this->input->post('password')) $set_array['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$where_array = array('users.id' => $this->session->userdata('meta_session')->id);
				$this->model_users->update($set_array, $where_array);
	
				$this->session->set_flashdata('message','<div class="alert alert-success flash-alert text-center">User updated successfully!</div>');
				redirect('/tci-admin/user/myprofile');
			}
			
		} 
		else {
			redirect('/tci-admin/home');
		}	
	}
}
