<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_content extends CI_Model
{
    var $table = 'tb_content';
    var $column_order = array('content_title');
    var $column_search = array('content_title');
    var $order = array('content_id' => 'desc');
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_users u', 'u.users_id = tb_content.content_by', 'left');

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
        $this->db->join('tb_users u', 'u.users_id = tb_content.content_by', 'left');
        $this->db->where('content_active', 1);
        $this->db->order_by('content_date', 'DESC');
        $this->db->limit(5);
        $data = $this->db->get('');
        return $data;
    }

    public function ambil_popular()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_users u', 'u.users_id = tb_content.content_by', 'left');
        $this->db->where('content_active', 1);
        $this->db->order_by('content_count', 'DESC');
        $this->db->limit(4);
        $data = $this->db->get('');
        return $data;
    }

    public function ambil_latest()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_users u', 'u.users_id = tb_content.content_by', 'left');
        $this->db->where('content_active', 1);
        $this->db->order_by('content_date', 'DESC');
        $this->db->limit(3);
        $data = $this->db->get('');
        return $data;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('content_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_slug($slug)
    {
        $this->db->from($this->table);
        $this->db->join('tb_users u', 'u.users_id = tb_content.content_by', 'left');
        $this->db->where('content_slug',$slug);
        $query = $this->db->get();
        return $query;
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('content_id', $id);
        $this->db->delete($this->table);
    }

}