<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods', 'GET,POST,OPTIONS,DELETE,PUT');
header("Content-Type: application/json; charset=UTF-8");
header("Authorization: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_Ctrl extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Database_model');
    }
    public function contactUsMessage()
    {
        $data=array(
            'full_name'=>$this->input->post('fullname'),
            'email'=>$this->input->post('email'),
            'mobile'=>$this->input->post('mobile'),
            'city'=>$this->input->post('city'),
            'subject'=>$this->input->post('subject'),
            'message'=>$this->input->post('message')
        );
        $result=$this->Database_model->insertContactUsData($data);
        if($result)
		{
			echo json_encode(array('status'=>'Success'));
		}
		else
		{
			echo json_encode(array('status'=>'fail'));
		}
    }
    public function getStudentData($id=1)
    {
        $this->data['studentData'] 		=	$this->Database_model->fetchStudentData($id);
        echo json_encode(array('data'=>$this->data['studentData']));
    }
   
}