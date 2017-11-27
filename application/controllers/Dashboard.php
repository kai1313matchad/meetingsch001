<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('crud/M_crud','crud');
		}

		public function index()
		{
			// $this->simple_login->ematchlog();
			$data['title']='Meeting Scheduler - Halaman Utama';			
			$data['menu']='dashboard';			
			$data['content']='menu/content/dashboard';
			$this->load->view('menu/layout/wrapper',$data);
		}

		public function resources()
		{
			$event = $this->db->get('schedule')->result();
			$data_events = array();
			foreach($event as $dt)
			{
				$date = date_format(date_create($dt->SCH_DATE),"d-M-Y");
				$time = date_format(date_create($dt->SCH_TIME),"H:i");
				$sch = $this->crud->get_by_idres('dept_schedule',array('sch_id'=>$dt->SCH_ID));
				$dept = array();
				foreach($sch as $sc)
				{
					$que = $this->db->get_where('dept',array('id_d'=>$sc->DEPT_ID));
					$res = $que->row();
					$dept[] = $res->nama_dept;
				}
				$mem = $this->crud->get_by_idres('member_schedule',array('sch_id'=>$dt->SCH_ID));
				$memb = array();
				foreach($mem as $me)
				{
					$que2 = $this->db->get_where('karyawan',array('id_karyawan'=>$me->KRY_ID));
					$res2 = $que2->row();
					$memb[] = $res2->nama_karyawan;
				}
				$dept_terkait = implode(', ', $dept);
				$anggota = implode(', ', $memb);
				$data_events[] = array(
								"id" => $dt->SCH_ID,
								"title" => $dt->SCH_TITLE.' - '.$dt->SCH_INFO,
								"start" => $dt->SCH_DATE.'T'.$dt->SCH_TIME,
								"lokasi" => $dt->SCH_LOC,
								"tanggal" => $date,
								"jam" => $time,
								"dept" => $dept_terkait,
								"anggota" => $anggota
				);
			}
	        echo json_encode(array("events"=>$data_events));
		}
	}
?>