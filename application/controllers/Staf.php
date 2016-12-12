<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->helper("form");
		$this->load->model("Staf_model","",TRUE);
	}

	public function index()
	{
		$data["judul"] 		 =	"Staf";
		$data["app"] 		 =	"Museum Surakarta";
		$data["main_view"] 	 =	"pages/staf";
		$data["active_staf"] =	"active";
		$data["headline"] 	 =	"icon-group";
		$data["dt_staf"]	 =	$this->Staf_model->cari_semua();
		
		$this->load->view('themes/template', $data);
	}

	public function tambah()
	{
		$data["judul"] 			= "Tambah Staf";
		$data["app"] 			= "Museum Surakarta";
		$data["main_view"] 		= "pages/staf_add";
		$data["parent"] 		= "Staf";
		$data["active_staf"] 	= "active";
		$data["headline"] 		= "icon-user";
		$data["id_staf"]	 	= $this->Staf_model->getIdStaf();


		if($this->Staf_model->validasi_tambah() == FALSE)
        {
			$this->load->view('themes/template', $data);
        }
        else
        {
        	$result = $this->Staf_model->insert_staf();
        	if($result)
        	{
        		$this->session->set_flashdata('pesan', 'Proses insert data staf berhasil.');
        		redirect("staf/index");
        	}
        	else
        	{
        		//$data['pesan'] = 'Gagal menambahkan staf.';
        		$this->load->view('themes/template', $data);
        	}
        }
	}

	public function edit($id_staf = NULL)
	{
		$data["judul"] = "Edit Staf ".$id_staf;
		$data["app"] = "Museum Surakarta";
		$data["main_view"] = "pages/staf_edit";
		$data["parent"] = "Staf";
		$data["active_staf"] = "active";
		$data["headline"] = "icon-user";

		// cek Admin
		if($this->session->userdata('role')=='admin')
		{
			if(!empty($id_staf)) // Jika id tidak kosong
			{
				$id_staf = $this->uri->segment(3);
				if($this->input->post('submit')) // jika ada aksi pos oleh name submit maka
		        {
		        	if($this->Staf_model->validasi_edit() === TRUE) // validasi TRUE
		            {
		            	// update db
		                if($this->Staf_model->edit($id_staf))
		                {
		                	$this->session->set_flashdata('pesan', 'Proses update data berhasil.');
		                	redirect('Staf/index');
		                }
		                else // gagal update ke db
		                {
		                	$data['pesan'] = 'Proses tambah data gagal.';
	                    	$this->load->view('themes/template', $data);
		                }
		            }
		            else // validasi FALSE maka
		            {
		            	$dt_staf  =  $this->Staf_model->cekStaf($id_staf);
						$data['id_staf'] = $dt_staf->id_staf;
						$data['nama_staf'] = $dt_staf->nama_staf;
						$data['alamat_staf'] = $dt_staf->alamat_staf;
						$data['kota'] = $dt_staf->kota;
						$data['username'] = $dt_staf->username;
						$data['no_handphone'] = $dt_staf->no_handphone;
						$data['role'] = $dt_staf->role;
						$data['status'] = $dt_staf->status;
	                   	$this->load->view('themes/template', $data);
		            }
		        }
		        else
		        {
		        	// Jika enggak ada pos sumbit, maka tampilkan load tiket	
					$cek = $this->Staf_model->cekStaf($id_staf);
					if($cek)
					{
						$dt_staf  =  $this->Staf_model->cekStaf($id_staf);
						$data['id_staf'] = $dt_staf->id_staf;
						$data['nama_staf'] = $dt_staf->nama_staf;
						$data['alamat_staf'] = $dt_staf->alamat_staf;
						$data['kota'] = $dt_staf->kota;
						$data['username'] = $dt_staf->username;
						$data['no_handphone'] = $dt_staf->no_handphone;
						$data['role'] = $dt_staf->role;
						$data['status'] = $dt_staf->status;
						$this->load->view('themes/template', $data);
			        }
			    }
			} // Jika enggak ada parameter di edit maka
			else
			{
				redirect("Staf/index");
			}
		}
		// Jika dia bukan admin maka
		else
		{
           	$this->session->set_flashdata('pesan', 'Maaf, akses edit hanya untuk admin.');
			redirect("Staf/index");
		}
	}

	public function is_password($password)
    {
        // cek di database

        $username = $this->session->userdata('username');
		$password = $this->input->post('password');
		$password = sha1($this->config->item('salt') . $password);

        $result = $this->Staf_model->login($username, $password);

        if ($result)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('is_password', "Password yang dimasukkan tidak benar");
            return FALSE;
        }
    }

    public function password()
    {
    	$data["judul"] 		 =	"Ubah Password";
		$data["app"] 		 =	"Museum Surakarta";
		$data["main_view"] 	 =	"pages/ubah_password";
		$data["parent"] 	 =  "Staf";
		$data["active_staf"] =	"active";
		$data["headline"] 	 =	"icon-shield";

		$this->form_validation->set_rules('password','Password Lama','trim|required|callback_is_password');
		$this->form_validation->set_rules('new_password','Password Baru','trim|required|min_length[8]');
		$this->form_validation->set_rules('new_password_conf','Konfirmasi Password Baru','trim|required|matches[new_password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('themes/template', $data);
		}
		else
		{
			if($this->Staf_model->password())
		    {
		       	$this->session->set_flashdata('pesan', 'Proses update data berhasil.');
		       	redirect('Staf/Password');
		    }
		    else // gagal update ke db
		    {
		       	$data['pesan'] = 'Proses tambah data gagal.';
	           	$this->load->view('themes/template', $data);
		    }
		}
    }
}
