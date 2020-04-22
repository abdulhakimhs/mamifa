<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    public function nilai_ta($periode_tgl, $jenis_pelatihan)
    {
        $this->db->select('*');
        $this->db->from('tb_nilai_ta n');
        $this->db->join('tb_target_ta t', 't.target_id = n.target_id');
        $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
        $this->db->where('n.periode_tgl', $periode_tgl);
        $this->db->where('t.pelatihan_id', $jenis_pelatihan);
        $result = $this->db->get();
        return $result;
    }

    public function nilai_mitra($tahun = 'all', $bulan = 'all', $jenis_pelatihan = 'all')
    {
        $this->db->select('t.nik, t.nama, t.jenis_kelamin, t.nama_mitra, t.jenis_mitra, p.jenis_pelatihan, t.jenis_teknisi, n.lokasi, t.bulan, t.tahun, n.tgl_mulai, n.tgl_selesai, n.nilai, n.keterangan');
        $this->db->from('tb_nilai_mitra n');
        $this->db->join('tb_target_mitra t', 't.target_m_id = n.target_m_id');
        $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
        if($tahun != 'all'){
            $this->db->where('YEAR(n.tgl_mulai)', $tahun);
        }
        if($bulan != 'all'){
            $this->db->where('MONTH(n.tgl_mulai)', $bulan);
        }
        if($jenis_pelatihan != 'all'){
            $this->db->where('t.pelatihan_id', $jenis_pelatihan);
        }
        $result = $this->db->get();
        return $result;
    }

    public function sub_ta($periode_tgl, $jenis_pelatihan)
    {
        $this->db->select('p.jenis_pelatihan, YEAR(n.periode_tgl) as tahun, n.periode_tgl, n.lokasi');
        $this->db->from('tb_nilai_ta n');
        $this->db->join('tb_target_ta t', 't.target_id = n.target_id');
        $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
        $this->db->where('n.periode_tgl', $periode_tgl);
        $this->db->where('t.pelatihan_id', $jenis_pelatihan);
        $result = $this->db->get();
        return $result;
    }

    public function stok_material($tahun, $bulan, $material)
    {
        $this->db->select('t.*,m.material_id,m.material,m.merk,m.type,m.jenis');
        $this->db->from('tb_material_trans t');
        $this->db->join('tb_material m', 'm.material_id = t.material_id');
        $this->db->where('YEAR(t.tanggal)',$tahun);
        $this->db->where('MONTH(t.tanggal)',$bulan);
        $this->db->where('t.material_id', $material);
        $result = $this->db->get();
        return $result;
    }

    public function get_material($material)
    {
        $this->db->select('*');
        $this->db->from('tb_material');
        $this->db->where('material_id', $material);
        $result = $this->db->get();
        return $result;
    }

    public function permint_material($periode_tgl)
    {
        $this->db->select('*');
        $this->db->from('tb_material_trans mt');
        $this->db->join('tb_material m', 'm.material_id = mt.material_id', 'left');
        $this->db->where('tanggal', $periode_tgl);
        $this->db->where('status', 1);
        $data = $this->db->get('');
        return $data;
    }
}