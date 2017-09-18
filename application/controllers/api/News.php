<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/libraries/REST_Controller.php");
require_once("application/libraries/Format.php");
class News extends REST_Controller
{
	public function index_get()
	{
		// ดึงรายการข่าวทั้งหมด
		// echo "fetch news here...";
		$data = array(
			array(
				"id"=>1,
				"topic"=>"หัวข้อข่าวที่ 1"
			),
			array(
				"id"=>2,
				"topic"=>"หัวข้อข่าวที่ 2"
			),
			array(
				"id"=>3,
				"topic"=>"หัวข้อข่าวที่ 3"
			),
		);

		// รับค่า parameter กรณี้มีส่งค่าเข้ามา หรือเป็น NULL ถ้าไม่มีการส่งค่า
        		$id = $this->get('id');

        		if ($id === NULL) // ถ้าไม่มีการระบุ id ที่ต้องการแสดงเข้ามา
        		{
        			if($data){ // ถ้ามีข้อมูล $data
		                $this->response($data, 200);
		                // แสดงรายการข่าวทั้งหมด
		            }else{ // ถ้าไม่มีข้อมูล
		                // กำหนดรูปแบบการแจ้ง เช่น สถานะและข้อความ
		                $this->response([
		                    'status' => FALSE,
		                    'message' => 'ไม่พบรายการข่าว'
		                ], REST_Controller::HTTP_NOT_FOUND);
		                // NOT_FOUND (404) being the HTTP response code
		            }
        		}else{
        			$id = (int) $id;  // ให้ id เป็นตัวเลขเท่านั้น
		            // ถ้าแปลงเป็นตัวเลขแล้วน้อยกว่าหรือเท่ากับ 0
		            if ($id <= 0)
		            {
		                // รูปแบบ id ไม่ถูกต้อง กำหนดค่าข้อมูลกลับเป็น NULL และสถานะเเป็น 400
		                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
		                // BAD_REQUEST (400) being the HTTP response code
		            }
		 
		            $item = NULL; // สร้างตัวแปรว่างไว้รับค่าข้อมูล
		 
		            if (!empty($data)) // มีข้อมูล
		            {
		                foreach ($data as $key => $value) // วนลูปข้อมูล
		                {
		                    // หารายการที่ id ตรง
		                    if (isset($value['id']) && $value['id'] === $id)
		                    {
		                        $item = $value; // เก็บค่าที่รายการตรง
		                    }
		                }
		            }
		            $this->response($item, 200);
		            // แสดงเฉพาะรายการ id ที่ตรงตามร้องขอเข้ามา
        		}

	}

	public function index_post()
	{
		// สร้างรายการข่าวใหม่
		//echo "create news here...";
		$data = array(
		            array(
		                "id"=>1,
		                "topic"=>"หัวข้อข่าวที่ 1"
		            ),
		            array(
		                "id"=>2,
		                "topic"=>"หัวข้อข่าวที่ 2"
		            ),
		            array(
		                "id"=>3,
		                "topic"=>"หัวข้อข่าวที่ 3"
		            ),
		);

		// รับค่า parameter กรณี้มีส่งค่าเข้ามา หรือเป็น NULL ถ้าไม่มีการส่งค่า
		$id = $this->post('id');
		$topic = $this->post('topic');
		//$this->response($this->post(), 200);
		if ($id === NULL) // ถ้าไม่มีการระบุ id ที่ต้องการแก้ไขส่งเข้ามา
		{
		    if($data){ // ถ้ามีข้อมูล $data
		        $this->response($data, 200);
		        // แสดงรายการข่าวทั้งหมด
		    }else{ // ถ้าไม่มีข้อมูล
		        // กำหนดรูปแบบการแจ้ง เช่น สถานะและข้อความ
		        $this->response([
		            'status' => FALSE,
		            'message' => 'ไม่พบรายการข่าว'
		        ], REST_Controller::HTTP_NOT_FOUND);
		        // NOT_FOUND (404) being the HTTP response code
		    }
		}else{
			$id = (int) $id;  // ให้ id เป็นตัวเลขเท่านั้น
			$topic = (string) $topic;

			// ถ้าแปลงเป็นตัวเลขแล้วน้อยกว่าหรือเท่ากับ 0
			if ($id <= 0)
			{
			    // รูปแบบ id ไม่ถูกต้อง กำหนดค่าข้อมูลกลับเป็น NULL และสถานะเเป็น 400
			    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			    // BAD_REQUEST (400) being the HTTP response code
			}

			if (!empty($data)) // มีข้อมูล
			{
			    foreach ($data as $key => $value) // วนลูปข้อมูล
			    {
			        // หารายการที่ id ตรง
			        if (isset($value['id']) && $value['id'] === $id)
			        {
			            $data[$key]['topic']=$topic; // กำหนดค่าเป็นค่าใหม่
			        }
			    }
			}
			$this->response($data, 200);
			// แสดงรายการทั้งหมดกลับอักครั้งหลังอัพเดท
		}
	}

	public function index_put()
	{
		// แก้ไขรายการข่าว
		echo "update news here...";
	}

	public function index_delete()
	{
		// ลบรายการข่าว
		echo "delete news here...";
	}
}