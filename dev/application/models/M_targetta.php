<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_targetta extends CI_Model
{
    var $table = 'tb_target_ta';
    var $column_order = array(null, 'nik','nama','sektor','t.level','position_name', 'subunit', 'status');
    var $column_search = array('nik','nama','sektor','t.level','position_name', 'subunit', 'status');
    var $order = array('target_id' => 'desc');
 
    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->join('tb_jenis_laporan as jp', 'jp.jenis_lap_id = m.jenis_lap_id');

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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->join('tb_pelatihan', 'tb_pelatihan.pelatihan_id = tb_target_ta.pelatihan_id');
        $this->db->where('target_id',$id);
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
        $this->db->where('target_id', $id);
        $this->db->delete($this->table);
    }

    public function getgrafik($bulan, $tahun)
    {
        $this->db->select("p.jenis_pelatihan,
              SUM(CASE WHEN (t.level!='Team Leader' AND t.level!='Site Manager' AND t.level!='Manager') THEN 1 ELSE 0 END) AS staff,
              SUM(CASE WHEN (t.level='Team Leader') THEN 1 ELSE 0 END) AS tl,
              SUM(CASE WHEN (t.level='Site Manager') THEN 1 ELSE 0 END) AS sm,
              SUM(CASE WHEN (t.level='Manager') THEN 1 ELSE 0 END) AS m"
            );
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_pelatihan as p', 't.pelatihan_id = p.pelatihan_id');
        if($bulan != 'all'){
            $this->db->where('bulan', $bulan);
        }
        if($tahun != 'all'){
            $this->db->where('tahun', $tahun);
        }
        $this->db->where('t.status', 0);
        $this->db->group_by('t.pelatihan_id');
        $result = $this->db->get();
        return $result;
    }

    public function gettabelpenilaian($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
    {
        $this->db->select("o.operation_name,o.operation_code,
            SUM(CASE WHEN (t.level!='Team Leader' AND t.level!='Site Manager' AND t.level!='Manager') THEN 1 ELSE 0 END) AS staff,
            SUM(CASE WHEN (t.level='Team Leader') THEN 1 ELSE 0 END) AS tl,
            SUM(CASE WHEN (t.level='Site Manager') THEN 1 ELSE 0 END) AS sm,
            SUM(CASE WHEN (t.level='Manager') THEN 1 ELSE 0 END) AS m,
            COUNT(t.level) AS total_naker"
        );
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_operation as o', 't.operation_id = o.operation_id');
        if($bulan != 'all'){
            $this->db->where('bulan', $bulan);
        }
        if($tahun != 'all'){
            $this->db->where('tahun', $tahun);
        }
        if($pelatihan != 'all'){
            $this->db->where('pelatihan_id', $pelatihan);
        }
        $this->db->where('t.status', 0);
        $this->db->group_by('t.operation_id');
        $result = $this->db->get();
        return $result;
    }

    public function gettabelpenilaiantotal($bulan = 'all', $tahun = 'all', $pelatihan = 'all')
    {
        $this->db->select("SUM(CASE WHEN (t.level!='Team Leader' AND t.level!='Site Manager' AND t.level!='Manager') THEN 1 ELSE 0 END) AS staff,
            SUM(CASE WHEN (t.level='Team Leader') THEN 1 ELSE 0 END) AS tl,
            SUM(CASE WHEN (t.level='Site Manager') THEN 1 ELSE 0 END) AS sm,
            SUM(CASE WHEN (t.level='Manager') THEN 1 ELSE 0 END) AS m,
            COUNT(t.level) AS total_naker"
        );
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_operation as o', 't.operation_id = o.operation_id');
        if($bulan != 'all'){
            $this->db->where('bulan', $bulan);
        }
        if($tahun != 'all'){
            $this->db->where('tahun', $tahun);
        }
        if($pelatihan != 'all'){
            $this->db->where('pelatihan_id', $pelatihan);
        }
        $this->db->where('t.status', 0);
        $result = $this->db->get();
        return $result;
    }

    public function show($unit = 'all', $level='all', $pelatihan = 'all')
    {
        $this->db->select("*");
        $this->db->from('tb_target_ta as t');
        $this->db->join('tb_operation as o', 't.operation_id = o.operation_id');
        $this->db->join('tb_pelatihan as p', 'p.pelatihan_id = t.pelatihan_id');
        if($unit != 'all'){
            $this->db->where('o.operation_code', $unit);
        }
        if($level != 'all'){
            if ($level == 'staff') {
                $where = "t.level!='Team Leader' AND t.level!='Site Manager' AND t.level!='Manager'";
                $this->db->where($where);
            }
            elseif ($level == 'tl') {
                $where = "t.level='Team Leader'";
                $this->db->where($where);
            }
            elseif ($level == 'sm') {
                $where = "t.level='Site Manager'";
                $this->db->where($where);
            }
            else{
                $where = "t.level='Manager'";
                $this->db->where($where);
            }
        }
        if($pelatihan != 'all'){
            $this->db->where('t.pelatihan_id', $pelatihan);
        }
        $this->db->where('t.status', 0);
        $result = $this->db->get();
        return $result;
    }
}