<?php 
defined('BASEPATH') or exit('No direct script access allowed');


class Products_model extends CI_MODEL
{

	private $_table = "products";

	public $product_id;
	public $name;
	public $price;
	public $image="default.jpg";
	public $description;

	//rules digunakan untuk validasi input
	public function rules()
	{

		return [
			['field' => 'name',
			 'label' => 'Name',
			 'rules' => 'required'],

			['field' => 'price',
			'label' => 'Price',
			'rules' => 'numeric'],

			['field' => 'description',
			'label' => 'Description',
			'rules' => 'required']

			];

	}

	public function getAll()
	{
		//sama seperti query SQL = SELECT * FROM products;
		//result digunakan untuk mengambil semua data dari hasil query
		//method ini mengembalikan sebuah array yang berisi objek dari row
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		//sama seperti query SQL = SELECT * FROM products WHERE product_id = $id;
		//row digunakan untuk mengambil satu data dari hasil query
		//method ini akan mengembalikan sebuah objek 
		return $this->db->get_where($this->_table, ["product_id" => $id])->row();
	}

	public function save()
	{
		$post = $this->input->post(); //ambil data dari form
		$this->product_id = uniqid(); //membuat id unik 
		$this->name = $post["name"]; //isi field name
		$this->price = $post["price"]; // isi field price
		$this->image = $this->_uploadImage();
		$this->description = $post["description"];//isi field description
		$this->db->insert($this->_table, $this); // simpan ke database
	}

	public function update()
	{
		$post = $this->input->post();
		$this->product_id = $post["id"];
		$this->name = $post["name"];
		$this->price = $post["price"];

		if(!empty($_FILES["image"]["name"]))
		{
			$this->image = $this->_uploadImage();
		} else {
			$this->image = $post["old_image"];
		}

		$this->description = $post["description"];
		$this->db->update($this->_table, $this, array('product_id' => $post["id"]));

	}

	public function delete($id)
	{	
		return $this->_deleteImage($id);
		return $this->db->delete($this->_table, array("product_id" => $id) );
	}

	private function _uploadImage()
	{
		$config['upload_path'] = './upload/products/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $this->product_id;
		$config['overwrite'] = true;
		$config['max_size'] = 1024;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('image')){
			return $this->upload->data("file_name");
		}
		return "default.jpg";
	}

	private function _deleteImage($id)
	{
		$products = $this->getById($id);
		if($products->image != "default.jpg")
		{
			$filename = explode(".", $products->image)[0];
			return array_map('unlink', glob(FCPATH."upload/products/filename.*"));
		}
	}
}



 ?>