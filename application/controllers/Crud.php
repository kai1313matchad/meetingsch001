<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Crud extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('crud/M_crud','crud');
		}

		//insert and update data
		public function add_user()
		{
			$this->_validate_user();
	        $table = 'user_ms';
	        $data = array(
	        		'usg_id' => $this->input->post('divisi'),
	                'kar_id' => $this->input->post('id_karyawan'),
	                'usr_access' => $this->input->post('akses')
	            );
	        $insert = $this->crud->save($table,$data);
	        echo json_encode(array("status" => TRUE));
		}

		public function _validate_user()
		{
			$data = array();
	        $data['error_string'] = array();
	        $data['inputerror'] = array();
	        $data['status'] = TRUE;
	 
	        if($this->input->post('nama_kry') == '')
	        {
	            $data['inputerror'][] = 'nama_kry';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('divisi') == '')
	        {
	            $data['inputerror'][] = 'divisi';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('akses') == '')
	        {
	            $data['inputerror'][] = 'akses';
	            $data['status'] = FALSE;
	        }

	        if($data['status'] === FALSE)
	        {
	            echo json_encode($data);
	            exit();
	        }
		}

		public function add_usergroup()
		{
			$this->_validate_usergroup();
	        $table = 'user_group';
	        $data = array(	                
	                'usg_name' => $this->input->post('nama_group')
	            );
	        $insert = $this->crud->save($table,$data);
	        echo json_encode(array("status" => TRUE));
		}

		public function _validate_usergroup()
		{
			$data = array();
	        $data['error_string'] = array();
	        $data['inputerror'] = array();
	        $data['status'] = TRUE;
	 
	        if($this->input->post('nama_group') == '')
	        {
	            $data['inputerror'][] = 'nama_group';
	            $data['status'] = FALSE;
	        }

	        if($data['status'] === FALSE)
	        {
	            echo json_encode($data);
	            exit();
	        }
		}

		public function add_schedule()
		{
			$this->_validate_schedule();
			$table = 'schedule';
			$data = array(
					'usr_id' => $this->input->post('user_id'),
					'sch_title' => $this->input->post('sch_title'),
					'sch_date' => $this->input->post('sch_date'),
					'sch_time' => $this->input->post('sch_time'),
					'sch_info' => $this->input->post('sch_info'),
					'sch_loc' => $this->input->post('sch_loc'),
					'sch_sts' => '1',
					'sch_notulen' => null
				);
			$insert = $this->crud->save($table,$data);
			$id = $this->db->insert_id();
			$dept = $this->input->post('sch_dept[]');
			$dept_terkait = array();
			foreach ($dept as $dpt) 
			{
				$queue = $this->db->get_where('dept',array('id_d'=>$dpt));
				$rese = $queue->row();
				$dept_terkait[] = $rese->nama_dept;
				$table2 = 'dept_schedule';
				$data2 = array(
						'dept_id' => $dpt,
						'sch_id' => $id
					);
				$insert2 = $this->crud->save($table2,$data2);
			}
			$person = $this->input->post('sch_member[]');
			$email = array();
			$member = array();
			foreach ($person as $prs) 
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs));
				$res = $que->row();
				$email[] = $res->email;
				$member[] = $res->nama_karyawan;
				$table3 = 'member_schedule';
				$data3 = array(
						'kry_id' => $prs,
						'sch_id' => $id
					);
				$insert3 = $this->crud->save($table3,$data3);
			}
			$dest = implode(', ', $email);
			$anggota = implode(', ', $member);
			$departemen = implode(', ', $dept_terkait);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Pemberitahuan Meeting';
			$content = 'Dear Team <br> Diberitahukan bahwa akan diadakan Meeting sebagai berikut<br>
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$this->input->post('sch_title').' - '.$this->input->post('sch_info').'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$departemen.'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$anggota.'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($this->input->post('sch_date')),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.$this->input->post('sch_time').'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$this->input->post('sch_loc').'
						</td>
					</tr>
				</table>
				<br>Diharapkan kehadirannya';
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function update_schedule()
		{
			$this->_validate_schedule();
			$id = $this->input->post('sch_id');
			$table = 'schedule';
			$table2 = 'dept_schedule';
			$table3 = 'member_schedule';
			$data = array(
					'usr_id' => $this->input->post('user_id'),
					'sch_title' => $this->input->post('sch_title'),
					'sch_date' => $this->input->post('sch_date'),
					'sch_time' => $this->input->post('sch_time'),
					'sch_info' => $this->input->post('sch_info'),
					'sch_loc' => $this->input->post('sch_loc')					
				);			
			$update = $this->crud->update($table,$data,array('sch_id'=>$id));
			$del_dept = $this->crud->delete_by_id($table2,array('sch_id'=>$id));
			$dept = $this->input->post('sch_dept[]');
			$dept_terkait = array();
			foreach ($dept as $dpt) 
			{
				$queue = $this->db->get_where('dept',array('id_d'=>$dpt));
				$rese = $queue->row();
				$dept_terkait[] = $rese->nama_dept;
				$data2 = array(
						'dept_id' => $dpt,
						'sch_id' => $id
					);
				$insert2 = $this->crud->save($table2,$data2);
			}
			$del_member = $this->crud->delete_by_id($table3,array('sch_id'=>$id));
			$person = $this->input->post('sch_member[]');
			$email = array();
			$member = array();
			foreach ($person as $prs)
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs));
				$res = $que->row();
				$email[] = $res->email;
				$member[] = $res->nama_karyawan;
				$data3 = array(
						'kry_id' => $prs,
						'sch_id' => $id
					);
				$insert3 = $this->crud->save($table3,$data3);
			}
			$dest = implode(', ', $email);
			$anggota = implode(', ', $member);
			$departemen = implode(', ', $dept_terkait);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Pemberitahuan Penjadwalan Ulang Meeting';
			$content = 'Dear Team <br> Diberitahukan bahwa akan diadakan Meeting sebagai berikut<br>
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$this->input->post('sch_title').' - '.$this->input->post('sch_info').'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$departemen.'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$anggota.'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($this->input->post('sch_date')),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.$this->input->post('sch_time').'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$this->input->post('sch_loc').'
						</td>
					</tr>
				</table>
			<br>Diharapkan kehadirannya';
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function delete_schedule()
		{
			$id = $this->input->post('sch_id');
			$table = 'schedule';
			$table2 = 'dept_schedule';
			$table3 = 'member_schedule';
			$data = array(
					'sch_sts' => '0'
				);			
			$update = $this->crud->update($table,$data,array('sch_id'=>$id));
			$dept = $this->input->post('sch_dept[]');
			$dept_terkait = array();
			foreach ($dept as $dpt) 
			{
				$queue = $this->db->get_where('dept',array('id_d'=>$dpt));
				$rese = $queue->row();
				$dept_terkait[] = $rese->nama_dept;				
			}			
			$person = $this->input->post('sch_member[]');
			$email = array();
			$member = array();
			foreach ($person as $prs)
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs));
				$res = $que->row();
				$email[] = $res->email;
				$member[] = $res->nama_karyawan;
			}
			$dest = implode(', ', $email);
			$anggota = implode(', ', $member);
			$departemen = implode(', ', $dept_terkait);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Pemberitahuan Pembatalan Meeting';
			$content = 'Dear Team <br> Diberitahukan bahwa Meeting sebagai berikut<br>
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$this->input->post('sch_title').' - '.$this->input->post('sch_info').'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$departemen.'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$anggota.'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($this->input->post('sch_date')),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.$this->input->post('sch_time').'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$this->input->post('sch_loc').'
						</td>
					</tr>
				</table>
			<br>Tidak jadi dilaksanakan, mohon maaf dan terima kasih atas perhatiannya';
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function add_notulen()
		{
			$data = array();
	        $data['error_string'] = array();
	        $data['inputerror'] = array();
	        $data['status'] = TRUE;
	        if($this->input->post('sch_id') == '')
	        {
	            $data['inputerror'][] = 'sch_title';
	            $data['status'] = FALSE;
	        }
	        if($this->input->post('sch_notulen') == '')
	        {
	            $data['inputerror'][] = 'edit_notulen';
	            $data['status'] = FALSE;
	        }
	        if($data['status'] === FALSE)
	        {
	            echo json_encode($data);
	            exit();
	        }
			$id = $this->input->post('sch_id');
			$table = 'schedule';
			$data2 = array(
					'sch_notulen' => $this->input->post('sch_notulen'),
					'sch_sts' => '2'
				);			
			$update = $this->crud->update($table,$data2,array('sch_id'=>$id));
			$member = $this->crud->get_by_idres('member_schedule',array('sch_id'=>$id));			
			$email = array();
			foreach ($member as $prs)
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs->KRY_ID));
				$res = $que->row();
				$email[] = $res->email;
			}
			$dest = implode(', ', $email);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Hasil Meeting - Notulen';
			$content = 'Dear Team <br> Berikut ini adalah hasil notulen dari meeting 
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$this->input->post('sch_title').' - '.$this->input->post('sch_info').'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$this->input->post('sch_dept').'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$this->input->post('sch_member').'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($this->input->post('sch_date')),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.$this->input->post('sch_time').'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$this->input->post('sch_loc').'
						</td>
					</tr>
				</table>
			<br><strong>Notulen Meeting</strong><br><hr>'.$this->input->post('sch_notulen');
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function schedule_reminder($id)
		{
			$sche = $this->crud->get_by_id('schedule',array('sch_id'=>$id));
			$dept = $this->crud->get_by_idres('dept_schedule',array('sch_id'=>$id));
			$dept_terkait = array();
			foreach ($dept as $dpt)
			{
				$queue = $this->db->get_where('dept',array('id_d'=>$dpt->DEPT_ID));
				$rese = $queue->row();
				$dept_terkait[] = $rese->nama_dept;
			}
			$member = $this->crud->get_by_idres('member_schedule',array('sch_id'=>$id));
			$email = array();
			$memlist = array();
			foreach ($member as $prs)
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs->KRY_ID));
				$res = $que->row();
				$email[] = $res->email;
				$memlist[] = $res->nama_karyawan;
			}
			$dest = implode(', ', $email);
			$anggota = implode(', ', $memlist);
			$departemen = implode(', ', $dept_terkait);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Reminder Meeting';
			$content = 'Dear Team <br> Berikut ini adalah Reminder dari meeting 
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$sche->SCH_TITLE.' - '.$sche->SCH_INFO.'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$departemen.'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$anggota.'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($sche->SCH_DATE),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.date_format(date_create($sche->SCH_TIME),"H:i").'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$sche->SCH_LOC.'
						</td>
					</tr>
				</table>
				<br> Diharapkan Kehadirannya';
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function schedule_result($id)
		{
			$sch = $this->crud->get_by_id('schedule',array('sch_id'=>$id));
			$dept = $this->crud->get_by_idres('dept_schedule',array('sch_id'=>$id));
			$kar = $this->crud->get_by_id('karyawan',array('id_karyawan'=>$this->input->post('kar_id')));
			$dept_terkait = array();
			foreach ($dept as $dpt)
			{
				$queue = $this->db->get_where('dept',array('id_d'=>$dpt->DEPT_ID));
				$rese = $queue->row();
				$dept_terkait[] = $rese->nama_dept;
			}
			$member = $this->crud->get_by_idres('member_schedule',array('sch_id'=>$id));			
			$memlist = array();
			foreach ($member as $prs)
			{
				$que = $this->db->get_where('karyawan',array('id_karyawan'=>$prs->KRY_ID));
				$res = $que->row();				
				$memlist[] = $res->nama_karyawan;
			}
			$dest = $kar->email;
			$anggota = implode(', ', $memlist);
			$departemen = implode(', ', $dept_terkait);
			$this->email_conf();
			$from = 'kaishasatrio@match-advertising.com';
			$to = $dest;
			$subj = 'Hasil Meeting';
			$content = 'Dear Team <br> Berikut ini adalah Hasil dari meeting 
				<table>
					<tr>
						<td>Tema meeting</td>
						<td>
							: '.$sch->SCH_TITLE.' - '.$sch->SCH_INFO.'
						</td>
					</tr>
					<tr>
						<td>Dept. Terkait</td>
						<td>
							: '.$departemen.'
						</td>
					</tr>
					<tr>
						<td>Peserta</td>
						<td>
							: '.$anggota.'
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>
							: '.date_format(date_create($sch->SCH_DATE),"d-M-Y").'
						</td>
					</tr>
					<tr>
						<td>Pukul</td>
						<td>
							: '.date_format(date_create($sch->SCH_TIME),"H:i").'
						</td>
					</tr>
					<tr>
						<td>Tempat</td>
						<td>
							: '.$sch->SCH_LOC.'
						</td>
					</tr>
				</table>
				<br><strong>Notulen Meeting</strong><br><hr>'.$sch->SCH_NOTULEN;
			$this->email_content($from,$to,$subj,$content);
			$this->email->send();
			echo json_encode(array("status"=>TRUE));
		}

		public function tes()
		{
			$tes1 = 'tes';
			echo json_encode(array("tes1"=>$tes1));
		}

		public function _validate_schedule()
		{
			$data = array();
	        $data['error_string'] = array();
	        $data['inputerror'] = array();
	        $data['status'] = TRUE;
	 
	        if($this->input->post('user_id') == '')
	        {
	            $data['inputerror'][] = 'user_id';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_title') == '')
	        {
	            $data['inputerror'][] = 'sch_title';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_dept[]') == '')
	        {
	            $data['inputerror'][] = 'sch_dept[]';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_member[]') == '')
	        {
	            $data['inputerror'][] = 'sch_member[]';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_date') == '')
	        {
	            $data['inputerror'][] = 'sch_date';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_time') == '')
	        {
	            $data['inputerror'][] = 'sch_time';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_loc') == '')
	        {
	            $data['inputerror'][] = 'sch_loc';
	            $data['status'] = FALSE;
	        }

	        if($this->input->post('sch_info') == '')
	        {
	            $data['inputerror'][] = 'sch_info';
	            $data['status'] = FALSE;
	        }

	        if($data['status'] === FALSE)
	        {
	            echo json_encode($data);
	            exit();
	        }
		}

		//Get data for print preview
		function get_printpre($id)
		{
			$data = $this->crud->get_by_id('schedule',array('sch_id'=>$id));			
			echo json_encode($data);
		}

		//dropdown
		public function drop_usergroup()
		{
			$que = $this->db->get('user_group');
			$data = $que->result();
			echo json_encode($data);
		}

		public function drop_dept()
		{
			$que = $this->db->get_where('dept','id_d != "15" AND id_d != "16"');
			$data = $que->result();
			echo json_encode($data);
		}

		public function drop_krybydept()
		{
			$dept = $this->input->post('sch_dept[]');
			$dpt = array();
			for($i=0;$i<count($dept);$i++)
			{
				$que = $this->db->get_where('dept',array('id_d'=>$dept[$i]));
				$res = $que->row();
				$dpt[] = $res->id_dept;
			}
			$check = implode('', $dpt);
			$data = $this->crud->get_krybydept($check);
			echo json_encode($data);
		}

		public function drop_team($id)
		{
			$this->db->from('user_ms');
			$this->db->join('user_group','user_group.usg_id = user_ms.usg_id');
			$this->db->where('user_ms.kar_id',$id);
			$que = $this->db->get();
			$data = $que->result();
			echo json_encode($data);
		}

		//get data by id
		public function get_kry($id)
		{
			$data = $this->crud->get_by_id('karyawan',array('id_karyawan'=>$id));
			echo json_encode($data);
		}

		public function get_user($id)
		{
			$data = $this->crud->get_by_id('user_ms',array('usr_id'=>$id));
			echo json_encode($data);
		}

		public function get_schtoedit($id)
		{
			$data = $this->crud->get_by_id('schedule',array('sch_id'=>$id));
			echo json_encode($data);
		}

		public function get_usgname($id)
		{
			$data = $this->crud->get_by_id2('user_ms','user_group',array('usr_id'=>$id),'user_ms.usg_id = user_group.usg_id');
			echo json_encode($data);
		}

		public function get_deptforsch($id)
		{
			$data = $this->crud->get_by_idres('dept_schedule',array('sch_id'=>$id));
			echo json_encode($data);
		}

		public function get_memberforsch($id)
		{
			$data = $this->crud->get_by_idres('member_schedule',array('sch_id'=>$id));
			echo json_encode($data);
		}

		public function get_deptforinl($id)
		{
			$this->db->select('GROUP_CONCAT(b.nama_dept SEPARATOR ", ") as departemen, a.SCH_ID');
			$this->db->from('dept_schedule a');
			$this->db->join('dept b','b.id_d = a.DEPT_ID');
			$this->db->where('a.sch_id', $id);
			$this->db->group_by('a.sch_id');
			$que = $this->db->get();
			$data = $que->result();
			echo json_encode($data);
		}

		public function get_memforinl($id)
		{
			$this->db->select('GROUP_CONCAT(b.nama_karyawan SEPARATOR ", ") as anggota, a.SCH_ID');
			$this->db->from('member_schedule a');
			$this->db->join('karyawan b','b.id_karyawan = a.KRY_ID');
			$this->db->where('a.sch_id', $id);
			$this->db->group_by('a.sch_id');
			$que = $this->db->get();
			$data = $que->result();
			echo json_encode($data);
		}

		//email
		public function email_conf()
		{
			$config = array (
					'protocol'  => 'smtp',			    
				    'smtp_host' => 'ssl://smtp.gmail.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'kaishasatrio@match-advertising.com',
				    'smtp_pass' => '3m41lk3rj4?',
				    'mailtype'  => 'html',
				    'charset'   => 'utf-8'
				);
			$this->email->initialize($config);	
		}

		public function email_content($from,$to,$subj,$content)
		{		
			$this->email->set_newline("\r\n");
			$this->email->to($to);
			$this->email->from($from);
			$this->email->subject($subj);
			$this->email->message($content);
		}		
	}
?>