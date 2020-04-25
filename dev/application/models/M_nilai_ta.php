<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai_ta extends CI_Model {

	var $table = 'tb_target_ta';
    var $column_order = array(null, 'target_id', 'nik', 'nama', 'jenis_pelatihan', 'position_name', 'subunit', 'level');
    var $column_search = array('target_id', 'nik', 'nama', 'jenis_pelatihan', 'position_name', 'subunit', 'level');
    var $order = array('target_id' => 'ASC');
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_pelatihan as p', 'p.pelatihan_id = t.pelatihan_id');
        $this->db->where('t.status', 1);

        //Filter
        if($this->input->post('bulan'))
        {
            $this->db->where('t.bulan', $this->input->post('bulan'));
        }

        if($this->input->post('tahun'))
        {
            $this->db->where('t.tahun', $this->input->post('tahun'));
        }
        
        if($this->input->post('jenis_pelatihan'))
        {
            $this->db->where('t.pelatihan_id', $this->input->post('jenis_pelatihan'));
        }

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

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

	public function save($data)
    {
        $this->db->insert('tb_nilai_ta', $data);
        return $this->db->insert_id();
    }

    public function delete_nilai($id)
    {
        $this->db->where('target_id', $id);
        $this->db->delete('tb_nilai_ta');
    }

}

/* End of file M_nilai_ta.php */
/* Location: ./application/models/M_nilai_ta.php */