<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class M_crud extends CI_Model
	{
		//insert
		public function save($tb,$data)
	    {
	        $this->db->insert($tb, $data);
	        return $this->db->insert_id();
	    }
	    
		//update
		public function update($tb,$data,$id)
		{
			$this->db->update($tb, $data, $id);
        	return $this->db->affected_rows();
		}

		//delete
		public function delete_by_id($tb,$id)
	    {
	        $this->db->where($id);
	        $this->db->delete($tb);
	    }

		//get data by id
		public function get_by_id($tb,$id)
	    {
	        $this->db->from($tb);
	        $this->db->where($id);
	        $query = $this->db->get();
	        return $query->row();
	    }

	    public function get_by_idres($tb,$id)
	    {
	        $this->db->from($tb);
	        $this->db->where($id);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    public function get_by_id2($tb1,$tb2,$id1,$id2)
	    {
	        $this->db->from($tb1);
	        $this->db->join($tb2,$id2);
	        $this->db->where($id1);
	        $query = $this->db->get();
	        return $query->row();
	    }

	    public function get_by_id2res($tb1,$tb2,$id1,$id2)
	    {
	        $this->db->from($tb1);
	        $this->db->join($tb2,$id2);
	        $this->db->where($id1);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    public function get_by_id3($tb1,$tb2,$tb3,$id1,$id2,$id3)
	    {
	        $this->db->from($tb1);
	        $this->db->join($tb2,$id2);
	        $this->db->join($tb3,$id3);
	        $this->db->where($id1);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    //custom get
	    public function get_krybydept($deli)
	    {
	    	$this->db->select('*');
			$this->db->from('karyawan a');
			$this->db->join('dept b','FIND_IN_SET(b.id_dept, a.dept)');
			$this->db->where('CONCAT(",", a.dept, ",") REGEXP "('.$deli.')"');
			$this->db->where('a.status !=','Blokir');
// 			$this->db->or_where('a.status','Cuti');
			$this->db->not_like('a.nama_karyawan','admin');
// 			$this->db->or_not_like('a.nama_karyawan','ADMIN');
			$this->db->group_by('a.id_karyawan');
			$query = $this->db->get();
			return $query->result();
	    }
	}
?>