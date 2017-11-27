<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Manage extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$this->simple_login->admlog();
			$data['title']='Meeting Scheduler - Halaman Utama';
			$data['menu']='dash_manage';
			$data['content']='menu/content/manage_dashboard';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function user()
		{
			$this->simple_login->admlog();
			$data['title']='Meeting Scheduler - Halaman Utama';
			$data['menu']='dash_manage';
			$data['content']='menu/content/manage_user';
			$this->load->view('menu/layout/wrapper',$data);	
		}
	}
?>