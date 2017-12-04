<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        
		$this->load->model('HomeSection', 'model_home_section');
	}

	public function index()
	{
		$this->db->where('home_section.id', 1);
		$this->db->where('home_section.is_default', 1);
		$query = $this->model_home_section->get_all();
		$data_view = [
			'home_section_data' => $query->row(),
			'url_save_data'     => base_url().'tci-admin/home/save'
		];

		$data = array(
			'content'    => $this->load->view('backend/home_section', $data_view, TRUE),
			'js_content' => $this->load->view('backend/home_section_js', $data_view, TRUE)
		);
		$this->load->view('backend/template/master', $data);
	}

	public function save()
	{
		if (!$this->input->post() && !$this->input->is_ajax_request()) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(405)
				->set_output(json_encode(['error' => 'Method Not Allowed']));
		}

		$id = $this->input->post('id_home_section');
		$data_for = $this->input->post('data_for');

		if (empty($id) || $id < 1) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode([
					'code' => 422,
					'error' => '"ID Home Section" is Missing'
				]));
		}

		if ($data_for == 'company_info') {
			$set_array = array();
			if ($this->input->post('web_title')) $set_array['title'] = $this->input->post('web_title');
			if ($this->input->post('company_name')) $set_array['company_name'] = $this->input->post('company_name');
			if ($this->input->post('company_logo')) $set_array['company_logo'] = $this->input->post('company_logo');
			$address_array = array();
			if ($this->input->post('company_contact_email')) $address_array['company_contact_email'] = $this->input->post('company_contact_email');
			if ($this->input->post('company_contact_phone')) $address_array['company_contact_phone'] = $this->input->post('company_contact_phone');
			if ($this->input->post('company_address1')) $address_array['company_address1'] = $this->input->post('company_address1');
			if ($this->input->post('company_address2')) $address_array['company_address2'] = $this->input->post('company_address2');
			$set_array['company_address_json'] = json_encode($address_array);
			$set_array['updated_at'] = date('Y-m-d H:i:s');

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		elseif ($data_for == 'about_us') {
			$set_array = array();
			if ($this->input->post('about_us_text')) $set_array['about_us_text'] = $this->input->post('about_us_text');
			if ($this->input->post('about_us_image')) $set_array['about_us_image'] = $this->input->post('about_us_image');
			$set_array['updated_at'] = date('Y-m-d H:i:s');

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		elseif ($data_for == 'home_slider') {
			$images = $this->input->post('image');
			$texts = $this->input->post('txt');
			$data = [];
			$check_val = TRUE;
			foreach ($images as $i => $image) {
				if (empty(trim($image))) {
					$check_val = FALSE;
					break;
				}
				else {
					$text = $texts[$i];
					if (empty(trim($text))) {
						$check_val = FALSE;
						break;
					}
					else {
						array_push($data, [
							'image' => $image,
							'txt' => $text
						]);
					}
				}
			}

			if (!$check_val || empty($data)) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode([
						'code' => 422,
						'error' => '"Some Slider Image / Title" are Empty'
					]));
			}

			$set_array = array();
			$set_array['home_slider_json'] = json_encode($data);

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		elseif ($data_for == 'our_services' || $data_for == 'working_areas') {
			$titles = $this->input->post('title');
			$contents = $this->input->post('content');
			$styles = $this->input->post('style');
			$data = [];
			$check_val = TRUE;
			foreach ($titles as $i => $title) {
				if (empty(trim($title))) {
					$check_val = FALSE;
					break;
				}
				else {
					$content = $contents[$i];
					if (empty(trim($content))) {
						$check_val = FALSE;
						break;
					}
					else {
						$style = $styles[$i];
						array_push($data, [
							'title' => $title,
							'content' => $content,
							'style' => $style
						]);
					}
				}
			}

			if (!$check_val || empty($data)) {
				return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode([
						'code' => 422,
						'error' => '"Some Title / Content" are Empty'
					]));
			}

			$set_array = array();
			if ($data_for == 'our_services') $set_array['services_json'] = json_encode($data);
			elseif ($data_for == 'working_areas') $set_array['working_areas_json'] = json_encode($data);

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		elseif ($data_for == 'divider_visibility') {
			$set_array = array();
			$set_array['visitor_count_visibility'] = $this->input->post('visitor_counter');
			$set_array['twitter_visibility'] = $this->input->post('twitter_ticker');
			if ($this->input->post('parallax_image')) $set_array['parallax_bground_img'] = $this->input->post('parallax_image');
			$set_array['updated_at'] = date('Y-m-d H:i:s');

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		elseif ($data_for == 'social_media') {
			$data = array(
				'facebook_link' => $this->input->post('facebook_link'),
				'twitter_link' => $this->input->post('twitter_link'),
				'linkedin_link' => $this->input->post('linkedin_link')
			);
			$set_array = array();
			$set_array['socmed_link_json'] = json_encode($data);
			$set_array['updated_at'] = date('Y-m-d H:i:s');

			$this->model_home_section->update($set_array, ['id' => $id]);
		}
		else {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode([
					'code' => 422,
					'error' => '"Data For" is Missing'
				]));
		}
		
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode([
				'code' => 200,
				'error' => ''
			]));
	}
	
	public function uploader()
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
        	'max_size' => '5120',
        	'max_width' => '1920',
        	'max_height' => '1440',
			'encrypt_name' => false,
			'overwrite' => true
		);

		if ($this->input->post('rename_to')) {
			$config['file_name'] = $this->input->post('rename_to');
		}

        $this->load->library('upload', $config);
		
        if (!$this->upload->do_upload('image')) {
            return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode(['error' => $this->upload->display_errors()]));
        } else {
			$data = $this->upload->data();
			if (is_array($data)) {
				$data['uploadedPreview'] = ['<img src="'.base_url().'public/images/upload/'.$data['file_name'].'" class="file-preview-image" alt="'.$data['file_name'].'" title="'.$data['file_name'].'">'];
			}
            return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($data));
        }
	}

	public function delete_uploaded()
	{
		if (!$this->input->post() && !$this->input->is_ajax_request()) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(405)
				->set_output(json_encode(['error' => 'Method Not Allowed']));
		}

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(['file_name' => $this->input->post('file_name')]));
	}
}
