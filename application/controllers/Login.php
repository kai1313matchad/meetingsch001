<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$data['title']='Meeting Scheduler - Halaman Utama';
			$data['menu']='login';
			$data['content']='menu/content/login_page';
			$this->load->view('menu/layout/wrapper',$data);
		}
	}
?>