<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_partner extends CI_Model
{
    var $table = 'tb_partner';
    var $column_order = array('partner_name');
    var $column_search = array('partner_name');
    var $order = array('partner_id' => 'desc');
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from($this->table);

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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function ambil()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('slide_active', 1);
        $data = $this->db->get('');
        return $data;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('partner_id',$id);
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
        $this->db->where('partner_id', $id);
        $this->db->delete($this->table);
    }

}