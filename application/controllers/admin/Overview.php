<?php 

class Overview extends CI_CONTROLLER{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//load view admin/overview.php
		$this->load->view('admin/overview');
	}
}
	



 ?>