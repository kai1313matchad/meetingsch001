<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dt_showuser extends CI_Model 
	{

		var $table = 'user_ms';
		var $column_order = array(null,'usg_name','nama_karyawan','jabatannya','usr_access');
		var $column_search = array('usg_name','nama_karyawan','jabatannya','usr_access');
		var $order = array('nama_karyawan' => 'desc');
		public function __construct()
		{
			parent::__construct();		
		}
		private function _get_datatables_query()
		{		
			$this->db->from($this->table);
			$this->db->join('karyawan','karyawan.id_karyawan = user_ms.kar_id');			
			$this->db->join('user_group','user_group.usg_id = user_ms.usg_id');
			$this->db->where(array('status'=>'Aktif', 'usr_dtsts'=>'1'));			
			$i = 0;
			foreach ($this->column_search as $item)
			{
				if($_POST['search']['value'])
				{			
					if($i===0)
					{
						$this->db->group_start();
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}
					if(count($this->column_search) - 1 == $i)
						$this->db->group_end();
				}
				$i++;
			}		
			if(isset($_POST['order']))
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}
		public function get_datatables()
		{
			$this->_get_datatables_query();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
		public function count_filtered()
		{
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}
		public function count_all()
		{
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
	}
?>