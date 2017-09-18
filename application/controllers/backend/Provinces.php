<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function dashboard()
	{
		$this->load->view('backend/dashboard');
	}

}