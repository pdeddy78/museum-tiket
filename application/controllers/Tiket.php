<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->helper("form");
		$this->load->model("Tiket_model","",TRUE);
	}

	public function index()
	{
		$data["judul"] 		 =	"Jenis Tiket";
		$data["app"] 		 =	"Museum Surakarta";
		$data["main_view"] 	 =	"pages/tiket";
		$data["active_tiket"] =	"active";
		$data["headline"] 	 =	"icon-ticket";
		$data["dt_tiket"]	 =	$this->Tiket_model->cari_semua();
		
		$this->load->view('themes/template', $data);
	}

	public function tambah()
	{
		$data["judul"] = "Tambah Jenis Tiket";
		$data["app"] = "Museum Surakarta";
		$data["main_view"] = "pages/tiket_add";
		$data["parent"] = "Tiket";
		$data["active_tiket"] = "active";
		$data["headline"] = "icon-ticket";
		$data["id_tiket"]	 =	$this->Tiket_model->getJenisTiket();

		if($this->Tiket_model->validasi_tambah() == FALSE)
        {
			$this->load->view('themes/template', $data);
        }
        else
        {
        	$result = $this->Tiket_model->insert_tiket();
        	if($result)
        	{
        		$this->session->set_flashdata('pesan', 'Proses insert data tiket berhasil.');
        		redirect("Tiket/index");
        	}
        	else
        	{
        		//$data['pesan'] = 'Gagal menambahkan staf.';
        		$this->load->view('themes/template', $data);
        	}
        }
	}

	public function edit($id_tiket = NULL)
	{
		$data["judul"] = "Edit Tiket ".$id_tiket;
		$data["app"] = "Museum Surakarta";
		$data["main_view"] = "pages/tiket_edit";
		$data["parent"] = "Tiket";
		$data["active_tiket"] = "active";
		$data["headline"] = "icon-ticket";
		// cek Admin
		if($this->session->userdata('role')=='admin')
		{
			if(!empty($id_tiket)) // Jika id tidak kosong
			{
				$id_tiket = $this->uri->segment(3);
				if($this->input->post('submit')) // jika ada aksi pos oleh name submit maka
		        {
		        	if($this->Tiket_model->validasi_edit() === TRUE) // validasi TRUE
		            {
		            	// update db
		                if($this->Tiket_model->edit($id_tiket))
		                {
		                	$this->session->set_flashdata('pesan', 'Proses update data berhasil.');
		                	redirect('Tiket/index');
		                }
		                else // gagal update ke db
		                {
		                	$data['pesan'] = 'Proses tambah data gagal.';
	                    	$this->load->view('themes/template', $data);
		                }
		            }
		            else // validasi FALSE maka
		            {
		            	$dt_tiket  =  $this->Tiket_model->cekTiket($id_tiket);
						$data['id_tiket'] = $dt_tiket->id_tiket;
						$data['nama_tiket'] = $dt_tiket->nama_tiket;
						$data['harga'] = $dt_tiket->harga;
	                   	$this->load->view('themes/template', $data);
		            }
		        }
		        else
		        {
		        	// Jika enggak ada pos sumbit, maka tampilkan load tiket	
					$cek = $this->Tiket_model->cekTiket($id_tiket);
					if($cek)
					{
						$dt_tiket  =  $this->Tiket_model->cekTiket($id_tiket);
						$data['id_tiket'] = $dt_tiket->id_tiket;
						$data['nama_tiket'] = $dt_tiket->nama_tiket;
						$data['harga'] = $dt_tiket->harga;
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
