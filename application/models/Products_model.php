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
		$this->description = $post["description"];//isi field description
		$this->db->insert($this->_table, $this); // simpan ke database
	}

	public function update()
	{
		$post = $this->input->post();
		$this->product_id = $post["id"];
		$this->name = $post["name"];
		$this->price = $post["price"];
		$this->description = $post["description"];
		$this->db->update($this->_table, $this, array('product_id' => $post["id"]));
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("product_id" => $id) );
	}

}



 ?>