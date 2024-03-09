<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller 
{
	public $config;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		
		$this->config = Array(        
			'protocol' => 'smtp',
			'charset' => 'utf-8',
			'wordwrap' => TRUE,
			'smtp_crypto' => 'ssl',
			'smtp_host' => 'smtp.hostinger.com',
			'smtp_port' => 465,
			'smtp_user' => 'contactus@vizbytetechnology.com',
			'smtp_from_name' => 'VizByte Technology',
			'smtp_pass' => 'vbTech@2022',
			'newline' => "\r\n",
			'mailtype' => 'html',                      
			'useragent' => 'CodeIgniter'
		   );
		$this->load->library('email');
		$this->email->initialize($this->config);  
		$this->email->set_newline("\r\n");
	}
	public function adminEmail()
	{
		$this->customerData=array(
            'full_name'=>$this->input->post('fullname'),
            'email'=>$this->input->post('email'),
            'mobile'=>$this->input->post('mobile'),
            'city'=>$this->input->post('city'),
            'subject'=>$this->input->post('subject'),
            'message'=>$this->input->post('message')
        );
	
		$attributes['to']='contactus@vizbytetechnology.com';

		$attributes['subject']='New Enquiery - '.date("d-M-Y");
		$attributes['message']=$this->load->view('email-templates/admin-email.html',$this->customerData,TRUE);;
		$this->email->from($this->config['smtp_user'], $this->config['smtp_from_name']);
		$this->email->to($attributes['to']);
		$this->email->subject($attributes['subject']);
		$this->email->message($attributes['message']);
		$result=$this->email->send();
		if($result) 
		{
			$this->customerEmail($this->customerData);
			echo json_encode(array('status'=>'admin-email-success'));
		}
		else 
		{
			echo json_encode(array('status'=>'admin-email-error'));
			show_error($this->email->print_debugger());
		}       
	}
	public function customerEmail($data)
	{

		$attributes['to']=$data['email'];
		$attributes['bcc']='vitthal.bhurule@vizbytetechnology.com';
		$attributes['subject']='Thank You for contacting us ';
		$attributes['message']=$this->load->view('email-templates/customer-email.html',$data,TRUE);

		$this->email->from($this->config['smtp_user'], $this->config['smtp_from_name']);
		$this->email->to($attributes['to']);
		$this->email->bcc($attributes['bcc']);
		$this->email->subject($attributes['subject']);
		$this->email->message($attributes['message']);
		$this->email->attach( 'http://localhost:8080/vizbytet-technology/assets/pdf/vendor_profile_registration.pdf');
		// $this->email->attach( 'http://localhost:8080/vizbytet-technology/assets/pdf/vendor_profile_registration.pdf');
		$result=$this->email->send();
		if($result) 
		{
			echo json_encode(array('status'=>'customer-email-success'));
		}
		else 
		{
			echo json_encode(array('status'=>'customer-email-error'));
			show_error($this->email->print_debugger());
		}       
		
	}
	

}
