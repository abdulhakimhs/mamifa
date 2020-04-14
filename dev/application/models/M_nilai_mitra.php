<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai_mitra extends CI_Model {

	var $table = 'tb_nilai_mitra';

	public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

}

/* End of file M_nilai_ta.php */
/* Location: ./application/models/M_nilai_ta.php */