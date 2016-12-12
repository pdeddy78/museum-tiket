<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("Staf_model","",TRUE);
		$this->load->model("Loket_model","",TRUE);
	}

	public function index()
	{
		$data["judul"] = "Login";
		$data["app"] = "Museum Surakarta";		
		$data["open_loket"]	 =	$this->Loket_model->getOpenLoket();
		
		if ($this->session->userdata('login') == TRUE) {
			redirect('Welcome');
		}
		else
		{
			$this->load->view('viewlogin', $data);
		}
	}

	public function login()
	{
		$data["judul"] = "Login";
		$data["app"] = "Museum Surakarta";
		$data["open_loket"]	 =	$this->Loket_model->getOpenLoket();

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
    	$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		
		if($this->form_validation->run() == FALSE)
	    {
			$this->load->view('viewlogin', $data);
	    }
	    else
	    {
	    	$loket = $this->session->userdata('loket');
	    	/*if($loket != "")
			{
			 	$cekLoket = $this->Loket_model->inLoket($loket);
			}*/
	      	redirect('Welcome', 'refresh');
	    }
	}

	function check_database($password)
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$loket = $this->input->post('id_loket');
		$password = sha1($this->config->item('salt') . $password);

	    $result = $this->Staf_model->login($username, $password);
	    
	    if($result)
	    {
	      $sess_array = array();
	      foreach($result as $row)
	      {
	        $sess_array = array(
	          'id' 	=> $row->id_staf,
	          'nama' => $row->nama_staf,
	          'alamat_staf' => $row->alamat_staf,
	          'kota' => $row->kota,
	          'username' => $row->username,
	          'role' => $row->role,
	          'loket' => $loket,
	          'login' => TRUE
	        );
	        $this->session->set_userdata($sess_array);
	      }
	      return TRUE;
	    }
	    else
	    {
	      $this->form_validation->set_message('check_database', 'Invalid username or password');
	      return false;
	    }
	}

	public function logout()
  	{
  		$loket = $this->session->userdata('loket');
  		$username = $this->session->userdata('username');
	    /*if($loket != "")
		{
		 	$cekLoket = $this->Loket_model->outLoket($loket);
		}*/

        $this->db->set("last_active", date("YmdHms"));
        $this->db->where("username", $username);
        $this->db->update("TMStaf");
	    $this->session->unset_userdata(array('id'=>'','nama' => '','alamat_staf'=>'','kota'=>'','username'=>'','role'=>'','loket'=>'','login' => FALSE));
	    session_destroy();
	    redirect('Welcome', 'refresh');
  	}
}
