<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = array(
			'content'    => $this->load->view('backend/home_section', NULL, TRUE),
			'js_content' => $this->load->view('backend/home_section_js', NULL, TRUE)
		);
		$this->load->view('backend/template/master', $data);
	}
	
	public function upload()
	{
		if (!$this->input->post() && !$this->input->is_ajax_request()) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(405)
				->set_output(json_encode(['error' => 'Method Not Allowed']));
		}

		$config = array(
			'upload_path' => './public/images/upload/',
        	'allowed_types' => 'gif|jpg|png|jpeg',
        	'max_size' => '5000',
        	'max_width' => '5000',
        	'max_height' => '5000',
			'encrypt_name' => false,
			'overwrite' => true,
			'file_name' => 'logo'
		);

        $this->load->library('upload', $config);
		
        if (!$this->upload->do_upload('image')) {
            return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode(['error' => $this->upload->display_errors()]));
        } else {
            $data = $this->upload->data();
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($data));
        }

	}
}
