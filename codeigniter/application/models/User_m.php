<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{

	public $table = 'user';
	public $column_order = array('ID','firstName','lastName','email');
	public $column_search = array('ID','firstName','lastName','email'); 
	public $order = array('ID' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		if(isset($_POST['search'])) {
			$i = 0;
	
			foreach ($this->column_search as $item)
			{
				if($_POST['search'])
				{
					
					if($i == 0) // first loop
					{
						$this->db->group_start(); 
						$this->db->like($item, $_POST['search']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']);
					}

					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
		}
		
		if(isset($_POST['sort']))
		{
			$sort = $this->input->post('sort');
			$this->db->order_by('ID',$sort);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by('ID', 'asc');
		}
	}

	function get_datatables($start)
	{
		$this->_get_datatables_query();
		$this->db->limit(5, $start);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAllRecord() {
		return $this->db->count_all("user");
		
	}

	public function paging_site($limit, $start) {

		$this->db->limit($limit, $start);
		$this->db->order_by('ID', 'asc');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		return false;
	}

	public function get_all_user()
	{
		$this->db->from('user');
		$this->db->select('ID, firstName, lastName, email');
		$query = $this->db->get();

		return $query->result();
	}


	public function get_by_id($id)
	{
		$this->db->from('user');
		$this->db->where('ID',$id);
		$this->db->select('ID, firstName, lastName, email');
		$query = $this->db->get();

		return $query->row();
	}

	public function user_update($id, $firstName, $lastName, $email)
	{
		$this->db->where('ID', $id);
		$data = array(
        	'firstName' => $firstName,
        	'lastName' => $lastName,
        	'email' => $email
		);
		$this->db->update("user", $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete("user");
	}

	public function search($search) {
		$query = $this->db->select("ID, firstName, lastName, email")
				->from("user")
				->like('ID', $search)
				->or_like('firstName', $search)
				->or_like('lastName', $search)
				->or_like('email', $search)
				->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	public function sort($sort) {
		$this->db->select("ID, firstName, lastName, email");
		$this->db->from("user");
		$this->db->order_by('ID', $sort);
		$query = $this->db->get();
		return $query->result();
	}

	public function pagination_sort($limit, $start, $sort) {
		$this->db->select("ID, firstName, lastName, email");
		$this->db->from("user");
		$this->db->limit($limit, $start);
		$this->db->order_by('ID', $sort);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

		return false;
	}

}
