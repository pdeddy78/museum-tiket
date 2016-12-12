<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Transaksi_model','');
		$this->load->model('Diskon_model','');
	}

	public function index()
	{
		$data["judul"] 			  = "Dashboard";
		$data["app"] 			  = "Museum Surakarta";
		$data["main_view"] 		  = "pages/dashboard";
		$data["active_dashboard"] = "active";
		$data["headline"] 		  = "icon-dashboard";

		$data["id_transaksi"] 	=   $this->Transaksi_model->getIdTransaksi();
		$data["wilayah"]		=	$this->Transaksi_model->getWilayah();
		$data["tiket"]	 		=	$this->Transaksi_model->getTiket();
		$data["guide"]	 		=	$this->Transaksi_model->getGuide();
		$data["diskon"]	 		=	$this->Transaksi_model->getDiskon();
		$data["transaksi"]		=	$this->Transaksi_model->getTransaksi();
		$data["dt_diskon"]	 	=	$this->Diskon_model->cari_semua();
		
		$this->load->view('themes/template', $data);
	}

	public function search()
	{
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		// cari di database
		$data = $this->db->from('TMPengunjung')->like('nama_pengunjung',$keyword)->get();	

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama_pengunjung
			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
	}

}
