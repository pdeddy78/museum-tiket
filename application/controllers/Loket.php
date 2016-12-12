<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->helper("form");
		$this->load->model("Loket_model","",TRUE);
	}

	public function index()
	{
		$data["judul"] 		 =	"Loket";
		$data["app"] 		 =	"Museum Surakarta";
		$data["main_view"] 	 =	"pages/loket";
		$data["active_loket"] =	"active";
		$data["headline"] 	 =	"icon-tasks";
		$data["dt_loket"]	 =	$this->Loket_model->cari_semua();
		
		$this->load->view('themes/template', $data);
	}

	public function tambah()
	{
		$data["judul"] = "Tambah Loket";
		$data["app"] = "Museum Surakarta";
		$data["main_view"] = "pages/loket_add";
		$data["parent"] = "Loket";
		$data["active_loket"] = "active";
		$data["headline"] = "icon-tasks";
		$data["id_loket"]	 =	$this->Loket_model->getKodeLoket();

		if($this->Loket_model->validasi_tambah() == FALSE)
        {
			$this->load->view('themes/template', $data);
        }
        else
        {
        	$result = $this->Loket_model->insert_loket();
        	if($result)
        	{
               	$this->session->set_flashdata('pesan', 'Proses insert data loket berhasil.');
        		redirect("loket/index");
        	}
        	else
        	{
        		//$data['pesan'] = 'Gagal menambahkan loket.';
        		$this->load->view('themes/template', $data);
        	}
        }
	}

	public function edit($id_loket = NULL)
	{
		$data["judul"] = "Edit Loket ".$id_loket;
		$data["app"] = "Museum Surakarta";
		$data["main_view"] = "pages/loket_edit";
		$data["parent"] = "Loket";
		$data["active_loket"] = "active";
		$data["headline"] = "icon-tasks";
		// cek Admin
		if($this->session->userdata('role')=='admin')
		{
			if(!empty($id_loket)) // Jika id tidak kosong
			{
				$id_loket = $this->uri->segment(3);
				if($this->input->post('submit')) // jika ada aksi pos oleh name submit maka
		        {
		        	if($this->Loket_model->validasi_edit() === TRUE) // validasi TRUE
		            {
		            	// update db
		                if($this->Loket_model->edit($id_loket))
		                {
		                	$this->session->set_flashdata('pesan', 'Proses update data berhasil.');
		                	redirect('Loket/index');
		                }
		                else // gagal update ke db
		                {
		                	$data['pesan'] = 'Proses tambah data gagal.';
	                    	$this->load->view('themes/template', $data);
		                }
		            }
		            else // validasi FALSE maka
		            {
		            	$dt_loket  =  $this->Loket_model->cekLoket($id_loket);
						$data['id_loket'] = $dt_loket->id_loket;
						$data['nama_loket'] = $dt_loket->nama_loket;
	                   	$this->load->view('themes/template', $data);
		            }
		        }
		        else
		        {
		        	// Jika enggak ada pos sumbit, maka tampilkan load tiket	
					$cek = $this->Loket_model->cekLoket($id_loket);
					if($cek)
					{
						$dt_tiket  =  $this->Loket_model->cekLoket($id_loket);
						$data['id_loket'] = $dt_tiket->id_loket;
						$data['nama_loket'] = $dt_tiket->nama_loket;
						$this->load->view('themes/template', $data);
			        }
			    }
			} // Jika enggak ada parameter di edit maka
			else
			{
				redirect("Loket/index");
			}
		}
		// Jika dia bukan admin maka
		else
		{
           	$this->session->set_flashdata('pesan', 'Maaf, akses edit hanya untuk admin.');
			redirect("Loket/index");
		}
	}
}
