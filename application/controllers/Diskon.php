<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskon extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->helper("form");
		$this->load->model("Diskon_model","",TRUE);
	}

	public function index()
	{
		$data["judul"] 		 	=	"Diskon Tiket";
		$data["app"] 		 	=	"Museum Surakarta";
		$data["main_view"] 	 	=	"pages/diskon";
		$data["active_diskon"] 	=	"active";
		$data["headline"] 	 	=	"icon-money";
		$data["dt_diskon"]	 	=	$this->Diskon_model->cari_semua();
		
		$this->load->view('themes/template', $data);
	}

	public function tambah()
	{
		$data["judul"] 			= "Tambah Diskon Tiket";
		$data["app"] 			= "Museum Surakarta";
		$data["main_view"] 		= "pages/diskon_add";
		$data["parent"] 		= "Diskon";
		$data["active_diskon"] 	= "active";
		$data["headline"] 		= "icon-money";
		$data["id_diskon"]	 	= $this->Diskon_model->getKodeDiskon();

		if($this->Diskon_model->validasi_tambah() == FALSE)
        {
			$this->load->view('themes/template', $data);
        }
        else
        {
        	$result = $this->Diskon_model->insert_diskon();
        	if($result)
        	{
        		$this->session->set_flashdata('pesan', 'Proses insert data diskon berhasil.');
        		redirect("Diskon/index");
        	}
        	else
        	{
        		//$data['pesan'] = 'Gagal menambahkan.';
        		$this->load->view('themes/template', $data);
        	}
        }
	}

	public function edit($id_diskon = NULL)
	{
		$data["judul"] 			= "Edit Diskon ".$id_diskon;
		$data["app"] 			= "Museum Surakarta";
		$data["main_view"] 		= "pages/diskon_edit";
		$data["parent"] 		= "Diskon";
		$data["active_diskon"] 	= "active";
		$data["headline"] 		= "icon-money";
		// cek Admin
		if($this->session->userdata('role')=='admin')
		{
			if(!empty($id_diskon)) // Jika id tidak kosong
			{
				$id_diskon = $this->uri->segment(3);
				if($this->input->post('submit')) // jika ada aksi pos oleh name submit maka
		        {
		        	if($this->Diskon_model->validasi_edit() === TRUE) // validasi TRUE
		            {
		            	// update db
		                if($this->Diskon_model->edit($id_diskon))
		                {
		                	$this->session->set_flashdata('pesan', 'Proses update data berhasil.');
		                	redirect('Diskon/index');
		                }
		                else // gagal update ke db
		                {
		                	$data['pesan'] = 'Proses tambah data gagal.';
	                    	$this->load->view('themes/template', $data);
		                }
		            }
		            else // validasi FALSE maka
		            {
		            	$dt_diskon  =  $this->Diskon_model->cekDiskon($id_diskon);
						$data['id_diskon'] = $dt_diskon->id_diskon;
						$data['nama_diskon'] = $dt_diskon->nama_diskon;
						$data['keterangan'] = $dt_diskon->keterangan;
						$data['diskon'] = $dt_diskon->jumlah_diskon*100;
	                   	$this->load->view('themes/template', $data);
		            }
		        }
		        else
		        {
		        	// Jika enggak ada pos sumbit, maka tampilkan load tiket	
					$cek = $this->Diskon_model->cekDiskon($id_diskon);
					if($cek)
					{
						$dt_diskon  =  $this->Diskon_model->cekDiskon($id_diskon);
						$data['id_diskon'] = $dt_diskon->id_diskon;
						$data['nama_diskon'] = $dt_diskon->nama_diskon;
						$data['keterangan'] = $dt_diskon->keterangan;
						$data['diskon'] = $dt_diskon->jumlah_diskon*100;
						$this->load->view('themes/template', $data);
			        }
			    }
			} // Jika enggak ada parameter di edit maka
			else
			{
				redirect("Tiket/index");
			}
		}
		// Jika dia bukan admin maka
		else
		{
           	$this->session->set_flashdata('pesan', 'Maaf, akses edit hanya untuk admin.');
			redirect("Tiket/index");
		}
	}
}
