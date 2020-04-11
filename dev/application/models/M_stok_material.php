<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stok_material extends CI_Model
{
    var $table = 'tb_material';

    public function ambil()
    {
        $this->db->select("material_id, material, jenis, stok");
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data;
    }

    public function grandtotal()
    {
        $this->db->select("SUM(CASE WHEN (jenis='MATERIAL') THEN stok ELSE 0 END) AS total_m,
            SUM(CASE WHEN (jenis='HABIS PAKAI') THEN stok ELSE 0 END) AS total_mhp");
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data;
    }
}