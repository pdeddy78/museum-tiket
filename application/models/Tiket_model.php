<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tiket_model extends CI_Model {

	public function load_form_rules_tambah()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_tiket',
                                'label' => 'Kode Jenis Tiket',
                                'rules' => 'trim|required|min_length[3]|max_length[3]|strtoupper|is_unique[TMTiket.id_tiket]'
                            ),
                            array(
                            	'field' => 'nama_tiket',
                                'label' => 'Nama Jenis Tiket',
                            	'rules' => 'trim|required|max_length[10]'
                            ),
                            array(
                                'field' => 'harga',
                                'label' => 'Harga Tiket',
                                'rules' => 'trim|required|min_length[4]|is_numeric'
                            ),
        );
        return $form_rules;
    }

    public function load_form_rules_edit()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_tiket',
                                'label' => 'Kode Jenis Tiket',
                                'rules' => 'trim|required|min_length[3]|max_length[3]|strtoupper'
                            ),
                            array(
                                'field' => 'nama_tiket',
                                'label' => 'Nama Jenis Tiket',
                                'rules' => 'trim|required|max_length[10]'
                            ),
                            array(
                                'field' => 'harga',
                                'label' => 'Harga Tiket',
                                'rules' => 'trim|required|min_length[4]|is_numeric'
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

    public function getJenisTiket()
    {
        $q = $this->db->query("select MAX(RIGHT(id_tiket,1)) as id_max from TMTiket");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%01s", $tmp);
            }
        }else{
            $id = "1";
        }
        return "JT".$id;
    }

    public function cari_semua()
    {
        return $this->db->get("TMTiket");
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

    public function insert_tiket()
    {
        $id_tiket = $this->input->post('id_tiket');
        $nama_tiket = $this->input->post('nama_tiket');
        $harga = $this->input->post('harga');

        $sql = "INSERT INTO TMTiket (id_tiket, nama_tiket, harga)
        VALUES (".$this->db->escape($id_tiket).",
                ".$this->db->escape($nama_tiket).",
                ".$this->db->escape($harga).")";

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

    public function edit($id_tiket)
    {

        $id_tiket   = $this->input->post('id_tiket');
        $nama_tiket = $this->input->post('nama_tiket');
        $harga      = $this->input->post('harga');
        
        // update db
        $this->db->set('nama_tiket', $nama_tiket);
        $this->db->set('harga', $harga);
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('TMTiket');

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