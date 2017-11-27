<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Showdata extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('datatables/show/Dt_showuser','show_user');
			$this->load->model('datatables/show/Dt_showschforrmd','show_schrmd');
			$this->load->model('datatables/show/Dt_showschforres','show_schres');
		}

		public function show_user()
		{
			$list = $this->show_user->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $dat) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $dat->USG_NAME;
				$row[] = $dat->nama_karyawan;
				$row[] = $dat->jabatannya;
				if($dat->USR_ACCESS == '0')
				{
					$akses = 'Administrator';
				}
				if($dat->USR_ACCESS == '1')
				{
					$akses = 'Head of Division';
				}
				if($dat->USR_ACCESS == '2')
				{
					$akses = 'Secretary';
				}
				$row[] = $akses;
				$row[] = '<a href="javascript:void(0)" title="Lihat Data" class="btn btn-sm btn-info btn-responsive" onclick="pick_user('."'".$dat->USR_ID."'".')"><span class="glyphicon glyphicon-export"></span> </a> <a href="javascript:void(0)" title="Lihat Data" class="btn btn-sm btn-danger btn-responsive" onclick="del_user('."'".$dat->USR_ID."'".')"><span class="glyphicon glyphicon-trash"></span> </a>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->show_user->count_all(),
							"recordsFiltered" => $this->show_user->count_filtered(),
							"data" => $data,
					);			
			echo json_encode($output);
		}

		public function show_schreminder($id)
		{
			$list = $this->show_schrmd->get_datatables($id);
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $dat) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $dat->SCH_TITLE;
				$date = date_format(date_create($dat->SCH_DATE),"d-M-Y");
				$time = date_format(date_create($dat->SCH_TIME),"H:i");
				$row[] = $date.' - '.$time;
				$row[] = $dat->USG_NAME;
				$row[] = $dat->SCH_INFO;
				$row[] = '<a href="javascript:void(0)" title="Lihat Data" class="btn btn-sm btn-info btn-responsive" onclick="pick_schreminder('."'".$dat->SCH_ID."'".')"><span class="glyphicon glyphicon-envelope"></span> </a>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->show_schrmd->count_all(),
							"recordsFiltered" => $this->show_schrmd->count_filtered($id),
							"data" => $data,
					);			
			echo json_encode($output);
		}

		public function show_schresult($id)
		{
			$list = $this->show_schres->get_datatables($id);
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $dat) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $dat->SCH_TITLE;
				$date = date_format(date_create($dat->SCH_DATE),"d-M-Y");
				$time = date_format(date_create($dat->SCH_TIME),"H:i");
				$row[] = $date.' - '.$time;
				$row[] = $dat->USG_NAME;
				$row[] = $dat->SCH_INFO;
				$row[] = '<a href="javascript:void(0)" title="Lihat Data" class="btn btn-sm btn-info btn-responsive" onclick="pick_schres('."'".$dat->SCH_ID."'".')"><span class="glyphicon glyphicon-envelope"></span> </a> <a href="javascript:void(0)" title="Lihat Data" class="btn btn-sm btn-success btn-responsive" onclick="print_schres('."'".$dat->SCH_ID."'".')"><span class="glyphicon glyphicon-print"></span> </a>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->show_schres->count_all(),
							"recordsFiltered" => $this->show_schres->count_filtered($id),
							"data" => $data,
					);			
			echo json_encode($output);
		}
	}
?>