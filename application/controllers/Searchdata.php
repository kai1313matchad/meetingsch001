<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Searchdata extends CI_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('datatables/search/Dt_searchuser','search_user');
			$this->load->model('datatables/search/Dt_searchschedule','search_schedule');
		}

		public function search_user()
		{
			$list = $this->search_user->get_datatables();
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $dat) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $dat->nama_karyawan;
				$row[] = $dat->nama_akses;
				$row[] = $dat->jabatannya;
				$row[] = '<a href="javascript:void(0)" title="Pilih Data" class="btn btn-sm btn-info btn-responsive" onclick="pick_kry('."'".$dat->id_karyawan."'".')"><span class="glyphicon glyphicon-import"></span> </a>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->search_user->count_all(),
							"recordsFiltered" => $this->search_user->count_filtered(),
							"data" => $data,
					);			
			echo json_encode($output);
		}

		public function search_schedule($id)
		{
			$list = $this->search_schedule->get_datatables($id);
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $dat) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $dat->SCH_TITLE;
				$date = date_format(date_create($dat->SCH_DATE),"d-M-Y");
				$row[] = $date;
				$time = date_format(date_create($dat->SCH_TIME),"H:i");
				$row[] = $time;
				$row[] = $dat->USG_NAME;
				$row[] = '<a href="javascript:void(0)" title="Pilih Data" class="btn btn-sm btn-info btn-responsive" onclick="pick_sch('."'".$dat->SCH_ID."'".')"><span class="glyphicon glyphicon-import"></span> </a>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->search_schedule->count_all(),
							"recordsFiltered" => $this->search_schedule->count_filtered($id),
							"data" => $data,
					);			
			echo json_encode($output);
		}
	}
?>