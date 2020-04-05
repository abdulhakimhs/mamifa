<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Naker extends CI_Model
{
    var $table = 'tb_naker';
    var $column_order = array('nik','nama','level');
    var $column_search = array('nik','nama');
    var $order = array('naker_id' => 'desc');
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('tb_naker');

        //Filter
        /*
        if($this->input->post('jenis_pelatihan'))
        {
            $this->db->where('tb_pelatihan.pelatihan_id', $this->input->post('jenis_pelatihan'));
        }
        */

        $i = 0;
        foreach ($this->column_search as $item) {
            if(@$_POST['search']['value']) {
                if($i===0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all() {
        $this->db->from('tb_naker');
        return $this->db->count_all_results();
    }

    public function ambil()
    {
        $this->db->select('*');
        $this->db->from('tb_naker');
        $data = $this->db->get('');
        return $data;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('naker_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_nik($nik)
    {
        $this->db->from($this->table);
        $this->db->where('nik', $nik);
        return $this->db->count_all_results();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('naker_id', $id);
        $this->db->delete($this->table);
    }

}