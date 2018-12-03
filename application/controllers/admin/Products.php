<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Products extends CI_CONTROLLER
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data["products"] = $this->product_model->getAll();
		$this->load->view("admin/products/list", $data);
	}

	public function add()
	{
		$products = $this->product_model;
		$validation = $this->form_validation;
		$validation->set_rules($products->rules());

		if($validation->run())
		{
			$products->save();
			$this->session->set_flashdata("success", 'Data berhasil disimpan');
		}

		$this->load->view("admin/products/new_form");
	}

	public function edit($id = null)
	{
		if(!isset($id)) redirect ('admin/products');

		$products = $this->product_model;
		$validation = $this->form_validation;
		$validation->set_rules($products->rules());

		if($validation->run())
		{
			$products->save();
			$this->session->set_flashdata("success", "Data berhasil disimpan");

		}
			$data["products"] = $products->getById($id);
			if(!$data["products"]) show_404();
			$this->load->view("admin/products/edit_form", $data);
	}

	public function delete($id = null)
	{
		if(!isset($id)) show_404();
			if($this->product_model->delete($id)){
			redirect(site_url('admin/products'));
		}
	}
}

 ?>