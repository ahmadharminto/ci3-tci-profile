<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->model('users', 'model_users');
	}

	public function index()
	{
		redirect('/cpanel/auth/login');
	}

	public function login()
	{
		if ($this->session->userdata('in_session') === TRUE) redirect('/cpanel/home');

		$this->load->view('backend/auth/login');
	}

    public function check()
    {
		if (!$this->input->post()) redirect('/cpanel/auth/login');

		$this->load->helper('security');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$this->session->set_flashdata('email', $email);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('backend/auth/login');
        }
        else {
			$this->db->where('users.email', $email);
			$this->db->where('users.is_active', 1);
			$query = $this->model_users->get_all();
			if ($query->num_rows() > 0) {
				$row = $query->row();
				if (password_verify($password, $row->password)) {
					$this->session->set_userdata('in_session', TRUE);
					$this->session->set_userdata('meta_session', $row);
					redirect('cpanel/home');
				}
				else {
					$this->session->set_flashdata('login_msg','<div class="alert alert-danger text-center">Email or Password Not Found!</div>');
					$this->index();
				}
			}
			else {
				$this->session->set_flashdata('login_msg','<div class="alert alert-danger text-center">Email or Password Not Found!</div>');
				$this->index();
			}
		}
    }

	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}
