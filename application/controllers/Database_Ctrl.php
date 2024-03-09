<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods', 'GET,POST,OPTIONS,DELETE,PUT');
header("Content-Type: application/json; charset=UTF-8");
header("Authorization: *");

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS,DELETE,PUT");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

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
    public function getStudentData()
    {
        $this->data['studentData'] 		=	$this->Database_model->fetchStudentData($this->input->get('student_id'));
        echo  json_encode($this->data['studentData']);
    }
    public function getAuthorization()
    {
        $username =$this->input->post('username');
        $password =$this->input->post('password');

       
        $this->data['getLoginData'] 		=	$this->Database_model->getLoginData($username,$password);
        if (empty($this->data['getLoginData'] )) {
            echo json_encode(array( 
                'status' => false, 
                'message' => 'Invalid user details.'
            ));
        } else {
            echo json_encode(array( 
                'status' => true, 
                'message' => 'Login Successfully'
            ));
        }
    }
    public function insertUserData(){
        $userData = array( 
            'username' => $this->input->post('aa'), 
            'password' => $this->input->post('xx'), 
        ); 
        $insert = $this->Database_model->insert($userData); 
        if ($insert) {
            echo json_encode(array( 
                'status' => true, 
                'message' => 'Data updated',
                'data'=>$insert
            ));
        } else {
            echo json_encode(array( 
                'status' => false, 
                'message' => 'Data not inserted'
            ));
        }
    }
   
}