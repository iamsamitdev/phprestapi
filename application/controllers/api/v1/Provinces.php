<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/libraries/REST_Controller.php");
require_once("application/libraries/Format.php");

class Provinces extends REST_Controller
{
	public function index_get()
	{
		// ปิดการแสดง error กรณี query db ไม่ได้
		$this->db->db_debug = false;

	    	// ดึงรายการทั้งหมด
		// Ex. http://localhost/restfulapi/api/v1/provinces
		//$this->response($this->db->get('tbl_provinces')->result()); 

		// ระบุหมายเลข id ที่ต้องการออกมาแสดง
		// Ex. http://localhost/restfulapi/api/v1/provinces/21
		 if($this->uri->segment(4)){
			$query =  $this->db->get_where("tbl_provinces",array('province_id'=>$this->uri->segment(4)));
		}else{
			$query =  $this->db->get('tbl_provinces');
		}

		// ระบุฟิลด์ที่ต้องการดึงออกมาแสดง
		// Ex. http://localhost/restfulapi/api/v1/provinces/21?fields=province_id,province_name
		if($this->get('fields') && $this->get('fields')!=""){
			$this->db->select($this->get('fields'));
		}

		// กำหนด limit หรือจำนวนที่ต้องการแสดง พร้อมแสดงการแบ่งหน้า
		// Ex. http://localhost/restfulapi/api/v1/provinces/?fields=province_id,province_name&limit=5
		// Ex. http://localhost/restfulapi/api/v1/provinces/?fields=province_id,province_name&limit=5&page=2
		// Ex. http://localhost/restfulapi/api/v1/provinces/?limit=5&sort=province_id desc,province_name desc
		if($this->get('sort') && $this->get('sort')!=""){ 
			$this->db->order_by($this->get('sort'));
		}

		if($this->get('limit') && $this->get('limit')!=""){   
			if($this->get('page') && $this->get('page')!=""){ 
				$offset_page = ((int) $this->get('page')-1)*(int) $this->get('limit');
				$this->db->limit((int) $this->get('limit'),$offset_page);
			}else{
			 	$this->db->limit((int) $this->get('limit'));
			}
		}     

		if($this->uri->segment(4)){
			$query =  $this->db->get_where("tbl_provinces",array('province_id'=>$this->uri->segment(4)));
		}else{
			$query =  $this->db->get('tbl_provinces');
		}

		// Bad request
		if($query){
			$this->response($query->result());                
		}else{
			echo "{error:". REST_Controller::HTTP_BAD_REQUEST.",msg:invalid query}";
			//$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		}
        
	}

	public function index_post()
	{
	    // สร้างรายการใหม่
	}

	public function index_put()
	{
	    // แก้ไขรายการ
	}

	public function index_delete()
	{
	    // ลบรายการ
	}
}