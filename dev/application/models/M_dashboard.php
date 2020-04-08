<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    public function getgrafikta($bulan, $tahun)
    {
        $this->db->select("p.jenis_pelatihan,
              SUM(CASE WHEN (t.level!='Team Leader' AND t.level!='Site Manager' AND t.level!='Manager') THEN 1 ELSE 0 END) AS staff,
              SUM(CASE WHEN (t.level='Team Leader') THEN 1 ELSE 0 END) AS tl,
              SUM(CASE WHEN (t.level='Site Manager') THEN 1 ELSE 0 END) AS sm,
              SUM(CASE WHEN (t.level='Manager') THEN 1 ELSE 0 END) AS m"
            );
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_pelatihan as p', 't.pelatihan_id = p.pelatihan_id');
        if($bulan != 'now'){
            $this->db->where('bulan', $bulan);
        } else {
            $this->db->where('bulan', date('m'));
        }
        if($tahun != 'now'){
            $this->db->where('tahun', $tahun);
        } else {
            $this->db->where('tahun', date('Y'));
        }
        $this->db->where('t.status', 1);
        $this->db->group_by('t.pelatihan_id');
        $result = $this->db->get();
        return $result;
    }

    public function getgrafikmitra($bulan, $tahun)
    {
        $this->db->select("p.jenis_pelatihan,
              SUM(CASE WHEN (t.level!='Team Leader') THEN 1 ELSE 0 END) AS staff,
              SUM(CASE WHEN (t.level='Team Leader') THEN 1 ELSE 0 END) AS tl"
            );
        $this->db->from('tb_target_mitra as t');
        $this->db->join('tb_pelatihan as p', 't.pelatihan_id = p.pelatihan_id');
        if($bulan != 'now'){
            $this->db->where('bulan', $bulan);
        } else {
            $this->db->where('bulan', date('m'));
        }
        if($tahun != 'now'){
            $this->db->where('tahun', $tahun);
        } else {
            $this->db->where('tahun', date('Y'));
        }
        $this->db->where('t.status', 1);
        $this->db->group_by('t.pelatihan_id');
        $result = $this->db->get();
        return $result;
    }
}