<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExampleRequest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('PHPRequests');
	}

	public function index()
	{
		$endpoint_url = "https://api.github.com/users/iamsamitdev/repos";
		$headers = array('Accept' => 'application/json');
		$options = array('auth' => array('iamsamitdev', 'smk377040'));
		$response = Requests::get($endpoint_url, $headers, $options);

		//echo $response->status_code;
		//print_r($response->headers['content-type']);
		print_r($response->body);
	}

	public function shownews(){
		$response = Requests::get('http://localhost/restfulapi/api/news/index/');
        		$responseData = $response->body; // ได้ข้อมูล json กลับมา
       		 // แปลงข้อมูลกลับ และให้เป็น array
		$arrData = json_decode($responseData,true);
		echo "<pre>";
		print_r($arrData); // ทดสอบแสดงข้อมูลจากตัวแปร array
		echo "</pre>";
    	}
}
