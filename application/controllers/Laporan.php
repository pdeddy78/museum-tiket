<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Laporan_model','',TRUE);
	}

	public function index()
	{
		$data["judul"] 			  =  "Laporan";
		$data["app"] 			  =  "Museum Surakarta";
		$data["main_view"] 		  =  "pages/laporan";
		$data["active_laporan"]   =  "active";
		$data["headline"] 		  =  "icon-bar-chart";
		$data["list_loket"]	  	  =	  $this->Laporan_model->getLoket();


		if($this->input->post('submit')) // jika ada aksi pos oleh name submit maka
		{
			$this->form_validation->set_rules('tgl_transaksi1','Periode 1','trim|required');
			$this->form_validation->set_rules('tgl_transaksi2','Periode 2','trim|required|callback_is_lower');
			if ($this->form_validation->run() == FALSE) 
			{
				redirect('Laporan/Index');
			}
			else
			{
				$data["submit"] = '';
				$tgl_transaksi1 = $this->input->post("tgl_transaksi1");
				$tgl_transaksi2 = $this->input->post("tgl_transaksi2");
				$data["tgl_transaksi1"] = $tgl_transaksi1;
				$data["tgl_transaksi2"] = $tgl_transaksi2;
				$id_loket 			= $this->input->post("id_loket");
				$data["loket"] 		= $id_loket;
			    $data["dt_laporan"] =  $this->Laporan_model->cari($tgl_transaksi1,$tgl_transaksi2,$id_loket);
			    $data["dt_wilayah"] =  $this->Laporan_model->cariWilayah($tgl_transaksi1,$tgl_transaksi2,$id_loket);

				$data["pesan"]	= "Museum Keraton Surakarta";			
				$this->load->view('themes/template', $data);
			}
		}
		else
		{
			$data["pesan"]	= "No Data";
			$this->load->view('themes/template', $data);
		}
	}

	public function is_lower()
	{
		$tgl_transaksi2 = $this->input->post('tgl_transaksi2');
		$tgl_transaksi1 = $this->input->post('tgl_transaksi1');

		if ($tgl_transaksi2 > $tgl_transaksi1) {
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('is_lower', "Maaf, periode 2 harus lebih besar");
			return FALSE;
		}
	}

}
