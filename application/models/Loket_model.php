<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loket_model extends CI_Model {

	public function load_form_rules_tambah()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_loket',
                                'label' => 'Kode Loket',
                                'rules' => 'trim|required|min_length[4]|max_length[4]|strtoupper|is_unique[TMLoket.id_loket]'
                            ),
                            array(
                            	'field' => 'nama_loket',
                                'label' => 'Nama Loket',
                            	'rules' => 'trim|required|min_length[10]|max_length[25]'
                            ),
        );
        return $form_rules;
    }

    public function load_form_rules_edit()
    {
        $form_rules = array(
                            array(
                                'field' => 'id_loket',
                                'label' => 'Kode Loket',
                                'rules' => 'trim|required|min_length[4]|max_length[4]|strtoupper'
                            ),
                            array(
                                'field' => 'nama_loket',
                                'label' => 'Nama Loket',
                                'rules' => 'trim|required|min_length[10]|max_length[25]'
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

    public function getKodeLoket()
    {
        $q = $this->db->query("select MAX(RIGHT(id_loket,1)) as id_max from TMLoket");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%01s", $tmp);
            }
        }else{
            $id = "1";
        }
        return "LOK".$id;
    }

    public function cari_semua()
    {
        return $this->db->get("TMLoket");
    }

    public function getOpenLoket()
    {
        $this->db->select("id_loket, nama_loket");
        $this->db->where("status =","0");
        return $this->db->get("TMLoket")->result();
    }

    public function cekLoket($id_loket) 
    {
        $query = $this->db->where('id_loket', $id_loket)
                          ->limit(1)
                          ->get('TMLoket');

        if ($query->num_rows() == 1) {            
            return $query->row(); //TRUE
        }
        else {
            return FALSE;
        }
    }

    public function inLoket($loket)
    {
        $this->db->set("status", "1");
        $this->db->where("id_loket", $loket);
        $this->db->update("TMLoket");
    }

    public function outLoket($loket)
    {
        $this->db->set("status", "0");
        $this->db->where("id_loket", $loket);
        $this->db->update("TMLoket");
    }

    public function insert_loket()
    {
        $id_loket = $this->input->post('id_loket');
        $nama_loket = $this->input->post('nama_loket');

        $sql = "INSERT INTO TMLoket (id_loket, nama_loket, status)
        VALUES (".$this->db->escape($id_loket).",
                ".$this->db->escape($nama_loket).",
                '0')";

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

    public function edit($id_loket)
    {

        $id_loket   = $this->input->post('id_loket');
        $nama_loket = $this->input->post('nama_loket');
        
        // update db
        $this->db->set('nama_loket', $nama_loket);
        $this->db->where('id_loket', $id_loket);
        $this->db->update('TMLoket');

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