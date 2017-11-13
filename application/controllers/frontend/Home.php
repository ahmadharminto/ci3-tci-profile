<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if ($this->config->item('under_maintenance')) {
			$this->load->view('welcome_message');
		} 
		else {
			$data = [
				'nav' => '',
				'content' => $this->load->view('frontend/home_section', null, TRUE),
				'footer' => ''
			];
			$this->load->view('frontend/template/master', $data);
		}
	}

	public function sendContactForm()
	{
		if (!$this->input->post()) redirect('/');

		$this->load->helper('security');
		$this->config->load('sendgrid');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
		
		if ($this->form_validation->run() == FALSE) {
			$this->index();
        }
        else {
			$name = $this->input->post('name', TRUE);
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject', TRUE);
			$message = $this->input->post('message', TRUE);
			
            $to_email = 'care@trustcertified.co.id';

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('sendgrid_smtp_host');
            $config['smtp_port'] = $this->config->item('sendgrid_smtp_port');
            $config['smtp_user'] = $this->config->item('sendgrid_smtp_username');
            $config['smtp_pass'] = $this->config->item('sendgrid_smtp_password');
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
			$config['newline'] = "\r\n"; 
			$config['crlf'] = "\r\n";
            $this->email->initialize($config);                        

            //send mail
			$this->email->from($from_email, $name);
			$this->email->to($to_email);
			$this->email->bcc('ahmad.harminto@sociolabs.io');
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
				$this->session->set_flashdata('contact_msg','<div class="alert alert-success text-center">Your message has been sent successfully!</div>');
                redirect('/page/home.pg#footer');
            }
            else {
				$this->session->set_flashdata('contact_msg','<div class="alert alert-danger text-center">There is error in sending message! Please try again later</div>');
				redirect('/page/home.pg#footer');
			}
		}
	}

	public function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/",$str)) {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        }
        else {
            return TRUE;
        }
	}
	
	public function recaptcha($str='')
	{
		$google_url = "https://www.google.com/recaptcha/api/siteverify";
		$secret     = '6LddnDMUAAAAAJIsLzt5NaqYX8WruOA9IJX5R7uk';
		$ip         = $_SERVER['REMOTE_ADDR'];
		$url        = $google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
		$curl       = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		
		$res = curl_exec($curl);
		curl_close($curl);
		$res = json_decode($res, true);
		if($res['success']) return TRUE;
		else {
			$this->form_validation->set_message('recaptcha', 'Are you human?');
			return FALSE;
		}
	}
}
