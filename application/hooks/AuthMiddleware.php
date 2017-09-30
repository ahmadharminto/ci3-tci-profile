<?php

class AuthMiddleware {
    protected $CI;
    
    public function __construct()
    {
      $this->CI = & get_instance();
      $this->CI->load->library('session');
      $this->CI->load->library('kint');
    }

    public function handle()
    {
        // $this->CI->kint->dump($this->CI->session->userdata());
    }
}