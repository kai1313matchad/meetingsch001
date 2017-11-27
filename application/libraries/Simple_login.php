<?php if(! defined ('BASEPATH')) exit ('Akses langsung tidak diperbolehkan');
	
	class Simple_login
	{
		//set super global
		var $CI = NULL;
		public function __construct()
		{
			$this->CI =& get_instance();
		}
		//fungsi login
		public function login($username, $password, $identifier)
		{
			$this->CI->session->set_userdata('login_id', '');
			$this->CI->session->set_userdata('kar_id', '');
			$this->CI->session->set_userdata('identifier', '');
			$this->CI->session->set_userdata('akses_post', '');
			$this->CI->session->set_userdata('akses_admin', '');
			$query = $this->CI->db->get_where('karyawan', array('username'=>$username, 'password'=>$password, 'status'=>'Aktif'));
			if($query->num_rows() > 0)
			{
				$row = $this->CI->db->get_where('karyawan', array('username'=>$username, 'password'=>$password));
				$data = $row->row();
				$id_kry = $data->id_karyawan;
				$this->CI->session->set_userdata('login_id', uniqid(rand()));
				$this->CI->session->set_userdata('kar_id', $id_kry);
				$this->CI->session->set_userdata('identifier', $identifier);				
				$msres = $this->CI->db->get_where('user_ms', array('kar_id'=>$id_kry, 'usr_dtsts'=>'1'));
				if($msres->num_rows() > 0)
				{
					$this->CI->session->set_userdata('akses_post', '1');
				}
				$admres = $this->CI->db->join('user_group b','b.usg_id = a.usg_id')->get_where('user_ms a', array('a.kar_id'=>$id_kry, 'b.usg_name'=>'Administrator'));
				if($admres->num_rows() > 0)
				{
					$this->CI->session->set_userdata('akses_admin', '1');
				}
				$ret = '1';
			}
			else
			{
				$this->sessiondel();
				$ret = '0';
			}
			return $ret;
		}

		//Fungsi Cek Login dari e-match
		public function ematchlog()
		{
			if($this->CI->session->userdata('identifier' != 'ematch') || $this->CI->session->userdata('login_id') == '')
			{
				$data['status'] = FALSE;
				$this->sessiondel();
				redirect('http://e-matchad.com/');
			}
		}

		//fungsi cek hak akses posting
		public function postlog()
		{
			if($this->CI->session->userdata('akses_post') != '1')
			{
				$this->CI->session->set_flashdata('success', '<div class="col-lg-12"><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><strong>Hak Akses Tidak Dimiliki!!!</strong></div></div>');				
				redirect(base_url('Dashboard'));
			}
		}

		//fungsi cek hak akses admin
		public function admlog()
		{
			if($this->CI->session->userdata('akses_admin') != '1')
			{
				$this->CI->session->set_flashdata('success', '<div class="col-lg-12"><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><strong>Hak Akses Tidak Dimiliki!!!</strong></div></div>');				
				redirect(base_url('Dashboard'));
			}
		}

		//unset session
		public function sessiondel()
		{
			$this->CI->session->unset_userdata('login_id');
			$this->CI->session->unset_userdata('kar_id');
			$this->CI->session->unset_userdata('identifier');
			$this->CI->session->unset_userdata('akses_post');
		}

		//fungsi logout
		public function logout()
		{
			$this->sessiondel();
			$this->CI->session->set_flashdata('success', '<div class="col-lg-12"><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><strong>Anda berhasil logout</strong></div></div>');
			redirect(base_url('Dashboard/login'));
		}
	}

?>