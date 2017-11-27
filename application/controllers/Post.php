<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Post extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{			
			$data['title']='Meeting Scheduler - Halaman Utama';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_dashboard';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function create()
		{
			$this->simple_login->postlog();
			$data['title']='Meeting Scheduler - Buat Jadwal';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_create';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function edit()
		{
			$this->simple_login->postlog();
			$data['title']='Meeting Scheduler - Edit Jadwal';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_edit';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function notulen()
		{
			$this->simple_login->postlog();
			$data['title']='Meeting Scheduler - Notulen Meeting';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_notulen';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function reminder()
		{
			$this->simple_login->postlog();
			$data['title']='Meeting Scheduler - Reminder Jadwal';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_reminder';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function result()
		{
			$data['title']='Meeting Scheduler - Hasil Meeting';
			$data['menu']='dash_post';
			$data['content']='menu/content/post_result';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function print_prev($id)
		{
			$data['title']='Meeting Scheduler - Print Preview';
			$data['menu']='dash_post';
			$data['id']=$id;			
			$this->load->view('menu/content/post_printpage',$data);
		}
	}
?>