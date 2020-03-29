<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_monila extends CI_Model
{
    var $table = 'tb_monila';
    var $column_order = array(null, 'nik','nama_lengkap','jenis_laporan','lokasi_temuan','koordinat', 'odp', 'status');
    var $column_search = array('nik','nama_lengkap','jenis_laporan','lokasi_temuan','koordinat', 'odp', 'status');
    var $order = array('monila_id' => 'desc');
 
    private function _get_datatables_query() {
        $this->db->select('jp.jenis_laporan, m.monila_id, m.nik, m.nama_lengkap, m.lokasi_temuan, m.koordinat, m.odp, m.status');
        $this->db->from('tb_monila as m');
        $this->db->join('tb_jenis_laporan as jp', 'jp.jenis_lap_id = m.jenis_lap_id');

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
        $this->db->from('tb_monila');
        return $this->db->count_all_results();
    }
    
    public function ambil()
    {
        $this->db->select('*');
        $this->db->from('tb_monila');
        $this->db->join('tb_jenis_laporan', 'tb_jenis_laporan.pelatihan_id = tb_monila.pelatihan_id');
        $data = $this->db->get('');
        return $data;
    }

    public function get_by_id($id)
    {
        $this->db->from('tb_monila');
        $this->db->join('tb_jenis_laporan', 'tb_jenis_laporan.jenis_lap_id = tb_monila.jenis_lap_id');
        $this->db->where('monila_id',$id);
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
        $this->db->where('monila_id', $id);
        $this->db->delete($this->table);
    }
}