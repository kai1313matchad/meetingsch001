<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Signin extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();			
		}

		public function index()
		{
			$user = $this->input->post('user');
			$pass = md5($this->input->post('pass'));
			$idt = $this->input->post('idt');
			$res = $this->simple_login->login($user,$pass,$idt);
			if ($res == '1')
			{
				$data['tes'] = 'Sukses Login'.$res.$pass;
				$data['status'] = TRUE;
			}
			else
			{
				$data['tes'] = 'Gagal Login'.$res.$pass;
				$data['status'] = FALSE;
			}			
			echo json_encode($data);
		}

		public function logout()
		{
			$this->simple_login->logout();
			$data['status'] = TRUE;
			echo json_encode($data);
		}
	}
?>