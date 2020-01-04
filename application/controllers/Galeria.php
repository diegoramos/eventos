<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$data = '';
		$this->load->view('frontend/header', $data, FALSE);
		$this->load->view('frontend/galeria', $data, FALSE);
		$this->load->view('frontend/footer', $data, FALSE);
	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Galeria.php */
/* Location: ./application/controllers/Galeria.php */
