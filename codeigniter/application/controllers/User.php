<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
	 	parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_m');
		$this->load->library('pagination');
	}
	
	public function index() {
		$data['results'] = $this->user_m->paging_site(5, 0);

		$result_search = $this->user_m->count_filtered();
		if ($result_search <= 5) {
			$data['num_links'] = 1;
		}
		else {
			$data['num_links'] = ceil($result_search / 5);
		}
		$this->load->view('user_view', $data);
	}

	public function ajax_list()
	{
		$start = $this->input->post('page');
		$list = $this->user_m->get_datatables($start);
		$data = array();
		
		foreach ($list as $user) {
			$row = array();
			$row[] = $user->ID;
			$row[] = $user->firstName;
			$row[] = $user->lastName;
			$row[] = $user->email;
			$data[] = $row;
		}

		$output = array(
			"recordsTotal" => $this->user_m->countAllRecord(),
			"result_search_filter" => $this->user_m->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->user_m->get_by_id($id);
		echo json_encode($data);
	}

	public function user_update($id)
	{
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$email = $this->input->post('email');
		$this->user_m->user_update($id, $firstName, $lastName, $email);
		echo json_encode(array("status" => TRUE));
	}

	public function user_delete($id)
	{
		$this->user_m->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function search() {
		$search = $this->input->post('search');
		$query = $this->user_m->search($search);

		if ($query == false) {
			echo json_encode(array("status" => FALSE));
		}
		echo json_encode($query);
	}

	public function sort() {
		$sort = $this->input->post('sort');
		$query = $this->user_m->sort($sort);

		echo json_encode($query);
	}

}
