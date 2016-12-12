<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Diskon_model extends CI_Model {

	public function load_form_rules_tambah()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_diskon',
                                'label' => 'Kode Diskon',
                                'rules' => 'trim|required|min_length[3]|max_length[4]|strtoupper|is_unique[TMDiskon.id_diskon]'
                            ),
                            array(
                            	'field' => 'nama_diskon',
                                'label' => 'Nama Diskon',
                            	'rules' => 'trim|required|max_length[50]'
                            ),
                            array(
                                'field' => 'keterangan',
                                'label' => 'Keterangan',
                                'rules' => 'trim|required|max_length[50]'
                            ),
                            array(
                                'field' => 'diskon',
                                'label' => 'Diskon',
                                'rules' => 'trim|required|max_length[2]|is_numeric'
                            ),
        );
        return $form_rules;
    }

    public function load_form_rules_edit()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_diskon',
                                'label' => 'Kode Diskon Tiket',
                                'rules' => 'trim|required|min_length[3]|max_length[4]|strtoupper'
                            ),
                            array(
                                'field' => 'nama_diskon',
                                'label' => 'Nama Diskon',
                                'rules' => 'trim|required|max_length[50]'
                            ),
                            array(
                                'field' => 'keterangan',
                                'label' => 'Keterangan',
                                'rules' => 'trim|required|max_length[50]'
                            ),
                            array(
                                'field' => 'diskon',
                                'label' => 'Diskon',
                                'rules' => 'trim|required|max_length[2]|is_numeric'
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

    public function validasi_edit()
    {
        $form = $this->load_form_rules_edit();
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

    public function getKodeDiskon()
    {
        $q = $this->db->query("select MAX(RIGHT(id_diskon,2)) as id_max from TMDiskon");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%02s", $tmp);
            }
        }else{
            $id = "01";
        }
        return "DK".$id;
    }

    public function cari_semua()
    {
        return $this->db->get("TMDiskon");
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

    public function insert_diskon()
    {
        $id_diskon = $this->input->post('id_diskon');
        $nama_diskon = $this->input->post('nama_diskon');
        $keterangan = $this->input->post('keterangan');
        $diskon = $this->input->post('diskon');
        $jumlah_diskon = $diskon/100; // convert ke nominal dari nilai diskon

        $sql = "INSERT INTO TMDiskon (id_diskon, nama_diskon, keterangan, jumlah_diskon)
        VALUES (".$this->db->escape($id_diskon).",
                ".$this->db->escape($nama_diskon).",
                ".$this->db->escape($keterangan).",
                ".$this->db->escape($jumlah_diskon).")";

        $result = $this->db->query($sql);
        if($this->db->affected_rows() === 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function edit($id_diskon)
    {
        $id_diskon = $this->input->post('id_diskon');
        $nama_diskon = $this->input->post('nama_diskon');
        $keterangan = $this->input->post('keterangan');
        $diskon = $this->input->post('diskon');
        $jumlah_diskon = $diskon/100; // convert ke nominal dari nilai diskon
        
        // update db
        $this->db->set('nama_diskon', $nama_diskon);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('jumlah_diskon', $jumlah_diskon);
        $this->db->where('id_diskon', $id_diskon);
        $this->db->update('TMDiskon');

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}