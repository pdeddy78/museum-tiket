<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function load_form_rules_tambah()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_transaksi',
                                'label' => 'Transaksi',
                                'rules' => 'trim|required|strtoupper|is_unique[TTTiket.id_transaksi]'
                            ),
                            array(
                            	'field' => 'tot_tiket',
                                'label' => 'Beli Tiket',
                            	'rules' => 'trim|required|is_numeric'
                            ),
        );
        return $form_rules;
    }

    public function validasi_tambah()
    {
        $form = $this->load_form_rules_tambah();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function getIdTransaksi()
    {
        $q = $this->db->query("select MAX(RIGHT(id_transaksi,7)) as id_max from TTTiket");
        $id = "";
        $date = date("Ymd");
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%07s", $tmp);
            }
        }else{
            $id = "0000001";
        }
        return "TKT-".$date."-".$id;
    }

    public function getWilayah()
    {
        return $this->db->get("TMWilayah")->result();
    }

    public function getTiket()
    {
        return $this->db->get("TMTiket")->result();
    }

    public function getTransaksi()
    {
        return $this->db->order_by('tgl_transaksi', 'DESC')
                        ->where('id_loket', $this->session->userdata('loket'))
                        ->get('TTTiket')->result();
    }

    public function cetakTiket($id_transaksi)
    {
        return $this->db->where('id_transaksi', $id_transaksi)
                        ->join('TMLoket', 'TTTiket.id_loket = TMLoket.id_loket')
                        ->join('TMTiket', 'TTTiket.id_tiket = TMTiket.id_tiket')
                        ->join('TMStaf', 'TTTiket.id_staf = TMStaf.id_staf', 'left')
                        ->get('TTTiket');
    }

    public function cekTiket($id_tiket)
    {
        $query = $this->db->where('id_tiket', $id_tiket)
                          ->limit(1)
                          ->get('TMTiket');

        if ($query->num_rows() == 1) {            
            return $query->row(); //TRUE
        }
        else {
            return FALSE;
        }
    }

    public function cekPengunjung($nama_pengunjung)
    {
        $query = $this->db->where('nama_pengunjung', $nama_pengunjung)
                          ->limit(1)
                          ->get('TMPengunjung');

        if ($query->num_rows() == 1) {            
            return TRUE; //TRUE
        }
        else {
            return FALSE;
        }
    }

    public function cekDiskon($id_diskon)
    {
        $query = $this->db->where('id_diskon', $id_diskon)
                          ->limit(1)
                          ->get('TMDiskon');

        if ($query->num_rows() == 1) {            
            return $query->row(); //TRUE
        }
        else {
            return FALSE;
        }
    }

    public function getGuide()
    {
        $this->db->where("role =", "guide");
        $this->db->where("status !=", "2");
        return $this->db->get("TMStaf")->result();
    }

    public function getDiskon()
    {
        return $this->db->get("TMDiskon")->result();
    }

    public function insert_transaksi()
    {
        $id_transaksi       =   $this->input->post('id_transaksi');
        $tgl_transaksi      =   date('Y-m-d H:i:s');
        $id_loket           =   $this->session->userdata('loket');
        $id_staf            =   $this->session->userdata('id');
        $nama_pengunjung    =   $this->input->post('nama_pengunjung');
        $id_wilayah         =   $this->input->post('id_wilayah');
        $id_tiket           =   $this->input->post('id_tiket');
        $tot_tiket          =   $this->input->post('tot_tiket');
        $id_diskon          =   $this->input->post('id_diskon');
        $id_guide           =   $this->input->post('id_guide');
        $tot_bayar          =   $this->input->post('tot_bayar');

        $sql = "INSERT INTO TTTiket (id_transaksi, tgl_transaksi, nama_pengunjung, id_wilayah, id_loket, id_staf, id_tiket, tot_tiket, id_diskon, id_guide, tot_bayar)
        VALUES (".$this->db->escape($id_transaksi).",
                ".$this->db->escape($tgl_transaksi).",
                ".$this->db->escape($nama_pengunjung).",
                ".$this->db->escape($id_wilayah).",
                ".$this->db->escape($id_loket).",
                ".$this->db->escape($id_staf).",
                ".$this->db->escape($id_tiket).",
                ".$this->db->escape($tot_tiket).",
                ".$this->db->escape($id_diskon).",
                ".$this->db->escape($id_guide).",
                ".$this->db->escape($tot_bayar).")";

        $result = $this->db->query($sql);

        // cek nama pengunjung
        $cekPengunjung = $this->cekPengunjung($nama_pengunjung);
        if ($cekPengunjung === FALSE) {
            $data = array(
                    'nama_pengunjung' => $nama_pengunjung
            );
            $this->db->insert('TMPengunjung', $data);
        }


        /* update guide
        if($id_guide != '')
        {
            $this->db->set("status", "2");
            $this->db->where("id_staf", $id_guide);
            $this->db->update("TMStaf");
        }*/

        if($this->db->affected_rows() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}