<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error404 extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data["judul"] = "Error 404";
		$data["app"] = "Museum Surakarta";

		$this->load->view('view404', $data);
	}
}