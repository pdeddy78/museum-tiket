<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Transaksi_model','',TRUE);
	}

	public function index()
	{
		redirect("Welcome");
	}

	public function cek($id_transaksi = NULL)
	{
		$data["judul"] 			  = "Transaksi ".$id_transaksi;
		$data["app"] 			  = "Museum Surakarta";
		$data["main_view"] 		  = "pages/transaksi";
		$data["active_dashboard"] = "active";
		$data["headline"] 		  = "icon-keyboard";

		if(!empty($id_transaksi)) // Jika id tidak kosong
		{
			$data["id_transaksi"] 	=   $this->input->post("id_transaksi");
			$data["nama_pengunjung"]=	$this->input->post("nama_pengunjung");
			$data["id_wilayah"]		=	$this->input->post("id_wilayah");
			$data["tot_tiket"]	 	=	$this->input->post("tot_tiket");
			$data["id_guide"]	 	=	$this->input->post("id_guide");
			$data["id_diskon"]	 	=	$this->input->post("id_diskon");

			$id_tiket	 		 =	$this->input->post('id_tiket');

			if(isset($id_tiket))
			{
			    $dt_tiket  			 =  $this->Transaksi_model->cekTiket($id_tiket);
				$data['id_tiket']	 =	$dt_tiket->id_tiket;
				$data['harga_tiket'] =	$dt_tiket->harga;

				if($this->input->post('id_guide') != '') {
					$guide = '50000';
				}
				else
				{
					$guide = '0';
				}

				if($this->input->post('id_diskon') != '') {
					$id_diskon	=	$this->input->post('id_diskon');
					$dt_diskon	=  	$this->Transaksi_model->cekDiskon($id_diskon);
					$diskon 	= 	$dt_diskon->jumlah_diskon;
				}
				else
				{
					$diskon = '0';
				}

				$qty				 =	$this->input->post("tot_tiket");
				$harga_tiket		 =	($dt_tiket->harga * $qty);
				$data['tot_bayar']	 =	$harga_tiket - ($harga_tiket * $diskon) + $guide;
				
				$this->load->view('themes/template', $data);
			}
			else
			{
				redirect('Welcome');
			}
		}
		else
		{
			redirect('Welcome');
		}
	}

	public function bayar($id_transaksi = NULL)
	{
		$data["judul"] 			  	= 	"Bayar ".$id_transaksi;
		$data["app"] 			  	= 	"Museum Surakarta";
		$data["main_view"] 		  	= 	"pages/transaksi";
		$data["active_dashboard"] 	= 	"active";
		$data["headline"] 		  	= 	"icon-keyboard";
		

		if(!empty($id_transaksi)) // Jika id tidak kosong
		{
			$id_tiket	 =	$this->input->post('id_tiket');

			if(isset($id_tiket))
			{
				if($this->Transaksi_model->validasi_tambah() == FALSE)
		        {
					echo "Invalid";
		        }
		        else
		        {
		        	$result = $this->Transaksi_model->insert_transaksi();
		        	if($result)
		        	{
		        		$this->session->set_flashdata('pesan', 'Proses insert data diskon berhasil.');
		        		redirect("Welcome/index");
		        	}
		        	else
		        	{
		        		//$data['pesan'] = 'Gagal menambahkan.';
		        		$this->load->view('themes/template', $data);
		        	}
		        }
	    	}
	    	else
	    	{
	    		redirect("Welcome");
	    	}

		}
		else
		{
			redirect("Welcome");
		}
	}

	public function CetakTiket($id_transaksi = NULL)
	{	

		if(!empty($id_transaksi)) // Jika id tidak kosong
		{
			ob_start();			
			$id_transaksi = $this->uri->segment(3);
			$data = array(
					'dt_transaksi'	=>	$this->Transaksi_model->cetakTiket($id_transaksi)
				);
			$this->load->view('CetakTiket', $data);
			$html = ob_get_contents();
	        ob_end_clean();
	        
	        require_once('./assets/html2pdf/html2pdf.class.php');
			$pdf = new HTML2PDF('P','A4','en', array(20, 10, 20, 10));
			$pdf->WriteHTML($html);
			$pdf->Output('Print_Tiket_'.$id_transaksi.'.pdf', 'D');
		}
		else
		{
			redirect("Welcome");
		}
	}

}
