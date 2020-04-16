<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    public function cetak_nilai($tahun = 'all', $bulan = 'all', $jenis_pelatihan = 'all', $download = 'mitra')
    {
        if($download == 'TA'){
            $this->db->select('*');
            $this->db->from('tb_nilai_ta n');
            $this->db->join('tb_target_ta t', 't.target_id = n.target_id');
            $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
            if($tahun != 'all'){
                $this->db->where('t.tahun', $tahun);
            }
            if($bulan != 'all'){
                $this->db->where('t.bulan', $bulan);
            }
            if($jenis_pelatihan != 'all'){
                $this->db->where('t.pelatihan_id', $jenis_pelatihan);
            }
        } else {
            $this->db->select('t.nik, t.nama, t.jenis_kelamin, t.nama_mitra, t.jenis_mitra, p.jenis_pelatihan, t.jenis_teknisi, n.lokasi, t.bulan, t.tahun, n.tgl_mulai, n.tgl_selesai, n.nilai, n.keterangan');
            $this->db->from('tb_nilai_mitra n');
            $this->db->join('tb_target_mitra t', 't.target_m_id = n.target_m_id');
            $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
            if($tahun != 'all'){
                $this->db->where('t.tahun', $tahun);
            }
            if($bulan != 'all'){
                $this->db->where('t.bulan', $bulan);
            }
            if($jenis_pelatihan != 'all'){
                $this->db->where('t.pelatihan_id', $jenis_pelatihan);
            }
        }
        $result = $this->db->get();
        return $result;
    }
}