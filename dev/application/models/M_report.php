<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    public function cetak_nilai($tahun = 'all', $bulan = 'all', $jenis_pelatihan = 'all', $download = 'TA')
    {
        if($download == 'TA'){
            $this->db->select('*');
            $this->db->from('tb_nilai_ta n');
            $this->db->join('tb_target_ta t', 't.target_id = n.target_id');
            $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
            if($tahun != 'all'){
                $this->db->where('YEAR(n.periode_tgl)', $tahun);
            }
            if($bulan != 'all'){
                $this->db->where('MONTH(n.periode_tgl)', $bulan);
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
                $this->db->where('YEAR(n.tgl_mulai)', $tahun);
            }
            if($bulan != 'all'){
                $this->db->where('MONTH(n.tgl_mulai)', $bulan);
            }
            if($jenis_pelatihan != 'all'){
                $this->db->where('t.pelatihan_id', $jenis_pelatihan);
            }
        }
        $result = $this->db->get();
        return $result;
    }

    public function sub($jenis_pelatihan, $periode_tgl)
    {
        $this->db->select('p.jenis_pelatihan, t.tahun, n.periode_tgl, n.lokasi');
        $this->db->from('tb_nilai_ta n');
        $this->db->join('tb_target_ta t', 't.target_id = n.target_id');
        $this->db->join('tb_pelatihan p', 'p.pelatihan_id = t.pelatihan_id');
        $this->db->where('t.pelatihan_id', $jenis_pelatihan);
        $this->db->where('n.periode_tgl', $periode_tgl);
        $result = $this->db->get();
        return $result;
    }
}