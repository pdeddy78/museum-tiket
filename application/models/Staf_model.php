<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staf_model extends CI_Model {

	public function load_form_rules_tambah()
    {
        $form_rules = array(
                            array(
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'trim|required|strtolower|min_length[3]|max_length[20]|is_unique[TMStaf.username]'
                            ),
                            array(
                            	'field' => 'nama_staf',
                                'label' => 'Nama Staf',
                            	'rules' => 'trim|required|min_length[3]|max_length[50]'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'trim|required|min_length[6]'
                            ),
                            array(
                                'field' => 'password_conf',
                                'label' => 'Konfirmasi Password',
                                'rules' => 'trim|required|min_length[6]|matches[password]'
                            ),
                            array(
                                'field' => 'no_handphone',
                                'label' => 'No Handphone',
                                'rules' => 'trim|max_length[15]|is_numeric|is_unique[TMStaf.no_handphone]'
                            ),
                            array(
                                'field' => 'alamat_staf',
                                'label' => 'Alamat',
                                'rules' => 'trim|min_length[15]'
                            ),
                            array(
                                'field' => 'kota',
                                'label' => 'Kota/Kab',
                                'rules' => 'trim|max_length[10]'
                            ),
                            array(
                                'field' => 'role',
                                'label' => 'Role',
                                'rules' => 'required'
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

    public function load_form_rules_edit()
    {
        $form_rules = array(
                            array(
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'trim|required|strtolower|min_length[3]|max_length[20]'
                            ),
                            array(
                                'field' => 'nama_staf',
                                'label' => 'Nama Staf',
                                'rules' => 'trim|required|min_length[3]|max_length[50]'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'trim|required|min_length[6]|callback_is_password'
                            ),
                            array(
                                'field' => 'no_handphone',
                                'label' => 'No Handphone',
                                'rules' => 'trim|max_length[15]|is_numeric'
                            ),
                            array(
                                'field' => 'alamat_staf',
                                'label' => 'Alamat',
                                'rules' => 'trim|min_length[15]'
                            ),
                            array(
                                'field' => 'kota',
                                'label' => 'Kota/Kab',
                                'rules' => 'trim|max_length[10]'
                            ),
                            array(
                                'field' => 'role',
                                'label' => 'Role',
                                'rules' => 'required'
                            ),
        );
        return $form_rules;
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

    public function getKodeStaf()
    {
        $q = $this->db->query("select MAX(RIGHT(id_staf,2)) as id_max from TMStaf");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%02s", $tmp);
            }
        }else{
            $id = "01";
        }
        return "STF".$id;
    }

    public function cari_semua()
    {
        return $this->db->get("TMStaf");
    }

    public function cekAdmin()
    {
        $username = $this->session->userdata('username');
        $this->db->from('TMStaf');
        $this->db->where('username =', $username);
        $this->db->where('status !=', '0');
        $this->db->where('role =', 'admin');
        $this->db->limit(1);

        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function cekStaf($id_staf) 
    {
        $query = $this->db->where('id_staf', $id_staf)
                          ->limit(1)
                          ->get('TMStaf');

        if ($query->num_rows() == 1) {            
            return $query->row();
        }
        else {
            return FALSE;
        }
    }

    public function getStaf($username)
    {
        $this->db->where('username', $username);
        return $this->db->get("TMStaf");
    }

    public function login($username, $password)
    {
        $this->db->from('TMStaf');
        $this->db->where('username = ' . "'" . $username . "'"); 
        $this->db->where('password = ' . "'" . $password . "'"); 
        $this->db->where('status !=', '0');
        $this->db->limit(1);

        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    public function insert_staf()
    {
        $id_staf = $this->input->post('id_staf');
    	$username = $this->input->post('username');
    	$nama_staf = $this->input->post('nama_staf');
    	$alamat_staf = $this->input->post('alamat_staf');
        $kota = $this->input->post('kota');
    	$role = $this->input->post('role');
    	$password = sha1($this->config->item('salt') . $this->input->post('password'));

    	$sql = "INSERT INTO TMStaf (id_staf, nama_staf, alamat_staf, kota, username, password, role, status, last_active)
    	VALUES (".$this->db->escape($id_staf).",
    			".$this->db->escape($nama_staf).",
    			".$this->db->escape($alamat_staf).",
    			".$this->db->escape($kota).",
    			".$this->db->escape($username).",
    			'".$password."',
    			".$this->db->escape($role).",
    			'1','')";

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

    public function getIdStaf()
    {
        $q = $this->db->query("select MAX(RIGHT(id_staf,1)) as id_max from TMStaf");
        $id = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->id_max)+1;
                $id = sprintf("%02s", $tmp);
            }
        }else{
            $id = "1";
        }
        return "STF".$id;
    }

    public function edit($id_staf)
    {

        $id_staf   = $this->input->post('id_staf');
        $nama_staf = $this->input->post('nama_staf');
        $alamat_staf = $this->input->post('alamat_staf');
        $kota = $this->input->post('kota');
        $no_handphone = $this->input->post('no_handphone');
        $role = $this->input->post('role');
        $status = $this->input->post('status');
        
        // update db
        $this->db->set('nama_staf', $nama_staf);
        $this->db->set('alamat_staf', $alamat_staf);
        $this->db->set('kota', $kota);
        $this->db->set('no_handphone', $no_handphone);
        $this->db->set('role', $role);
        $this->db->set('status', $status);
        $this->db->where('id_staf', $id_staf);
        $this->db->update('TMStaf');

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function password()
    {

        $id_staf   = $this->session->userdata('id');
        $password  = sha1($this->config->item('salt') . $this->input->post('new_password'));
        
        // update db
        $this->db->set('password', $password);
        $this->db->where('id_staf', $id_staf);
        $this->db->update('TMStaf');

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