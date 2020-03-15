<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jenislaporan extends CI_Model
{
    public function ambil()
    {
        $this->db->select('*');
        $this->db->from('tb_jenis_laporan');
        $data = $this->db->get('');
        return $data;
    }

    public function edit($where, $tabel, $data)
    {
    	$this->db->where($where);
        $this->db->update($tabel, $data);
    }

    public function hapus($where, $tabel)
    {
    	$this->db->where($where);
        $this->db->delete($tabel);
    }
}