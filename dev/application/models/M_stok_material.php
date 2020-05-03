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
    
    public function stok_keluar($bulan = 'all', $tahun = 'all')
    {
        $this->db->select("material, jenis,
            SUM(CASE WHEN (m.jenis='MATERIAL') THEN mt.jumlah ELSE 0 END) AS jumlah_m,
            SUM(CASE WHEN (m.jenis='HABIS PAKAI') THEN mt.jumlah ELSE 0 END) AS jumlah_mhp,
            SUM(CASE WHEN (m.jenis='ALKER') THEN mt.jumlah ELSE 0 END) AS jumlah_alker
        ");
        $this->db->from('tb_material_trans mt');
        $this->db->join('tb_material m', 'm.material_id = mt.material_id', 'left');
        $this->db->where('mt.status', 0);
        if($bulan != 'all') {
            $this->db->where('MONTH(mt.tanggal)', $bulan);
        }
        if($tahun != 'all') {
            $this->db->where('YEAR(mt.tanggal)', $tahun);
        }
        $this->db->group_by('m.material');
        $data = $this->db->get();
        return $data;
    }

    public function grandtotal_keluar($bulan = 'all', $tahun = 'all')
    {
        $this->db->select("SUM(CASE WHEN (m.jenis='MATERIAL') THEN mt.jumlah ELSE 0 END) AS total_m,
            SUM(CASE WHEN (m.jenis='HABIS PAKAI') THEN mt.jumlah ELSE 0 END) AS total_mhp");
        $this->db->from('tb_material_trans mt');
        $this->db->join('tb_material m', 'm.material_id = mt.material_id', 'left');
        $this->db->where('mt.status', 0);
        if($bulan != 'all') {
            $this->db->where('MONTH(mt.tanggal)', $bulan);
        }
        if($tahun != 'all') {
            $this->db->where('YEAR(mt.tanggal)', $tahun);
        }
        $data = $this->db->get();
        return $data;
    }
}