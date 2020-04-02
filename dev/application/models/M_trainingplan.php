<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_trainingplan extends CI_Model
{
    var $table = 'tb_training_plan';
    
    public function ambil($tglawal)
    {
        $this->db->select('*');
        $this->db->from('tb_training_plan');
        $this->db->join('tb_mitra', 'tb_mitra.mitra_id = tb_training_plan.mitra_id', 'left');
        $this->db->join('tb_pelatihan', 'tb_pelatihan.pelatihan_id = tb_training_plan.pelatihan_id', 'left');
        $this->db->join('tb_name_of_training', 'tb_name_of_training.not_id = tb_training_plan.not_id', 'left');
        $this->db->where('tgl_awal', $tglawal);
        $data = $this->db->get('');
        return $data;
    }

    public function get_by_id($id)
    {
        $this->db->from('tb_training_plan');
        $this->db->join('tb_mitra', 'tb_mitra.mitra_id = tb_training_plan.mitra_id','left');
        $this->db->join('tb_pelatihan', 'tb_pelatihan.pelatihan_id = tb_training_plan.pelatihan_id');
        $this->db->join('tb_name_of_training', 'tb_name_of_training.not_id = tb_training_plan.not_id');
        $this->db->where('training_plan_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('training_plan_id', $id);
        $this->db->delete($this->table);
    }
}