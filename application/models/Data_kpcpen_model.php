<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_kpcpen_model extends CI_Model
{

    public $table = 'data_kpcpen';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        // $this->db->select("nama, jenis_kelamin, GROUP_CONCAT(vaksinasi SEPARATOR ', ') as vaksin, GROUP_CONCAT(CONCAT_WS(utf8_encode(chr(10).chr(13)), tanggal, tiket_vaksin, faskes, vaksinasi) order by id SEPARATOR utf8_encode(chr(10).chr(13))) as vaksin2 from data_kpcpen group by nik ORDER BY `nik` asc");
        // // $this->db->limit($li);
        // return $this->db->get()->result();
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        // $this->db->where('isactive', 1);
        // $this->db->select('*');
        // $this->db->distinct();
        $this->db->group_start();
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('nik', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('tiket_vaksin', $q);
        $this->db->or_like('faskes', $q);
        $this->db->or_like('kelompok_usia', $q);
        $this->db->or_like('kategori', $q);
        $this->db->or_like('sub_kategori', $q);
        $this->db->or_like('vaksinasi', $q);
        $this->db->or_like('jenis_vaksin', $q);
        $this->db->or_like('kab', $q);
        $this->db->or_like('prov', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('update_by', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('update_at', $q);
        $this->db->or_like('isactive', $q);
        $this->db->group_end();
        // $this->db->group_by('nik');
        $this->db->from($this->table);
        // $this->db->group_by('nik');
        // $this->db->order_by('nom_dept', 'asc'); 
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        // $this->db->select("*,  GROUP_CONCAT(vaksinasi SEPARATOR ', ' ) as vaksin"); 
        // $this->db->distinct();           // $this->db->where('isactive', 1);
        // $this->db->group_start();
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('nik', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('tiket_vaksin', $q);
        $this->db->or_like('faskes', $q);
        $this->db->or_like('kelompok_usia', $q);
        $this->db->or_like('kategori', $q);
        $this->db->or_like('sub_kategori', $q);
        $this->db->or_like('vaksinasi', $q);
        $this->db->or_like('jenis_vaksin', $q);
        $this->db->or_like('kab', $q);
        $this->db->or_like('prov', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('update_by', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('update_at', $q);
        $this->db->or_like('isactive', $q);
        // $this->db->group_end();
        $this->db->order_by('nik', 'asc');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
        // $this->db->select("nama, jenis_kelamin, GROUP_CONCAT(vaksinasi SEPARATOR ', ') as vaksin, GROUP_CONCAT(CONCAT_WS('<br>', tanggal, tiket_vaksin, faskes, vaksinasi) order by id SEPARATOR '<br><br>') as vaksin2 from data_kpcpen WHERE ( `id` LIKE '%$q%' ESCAPE '!' OR `nama` LIKE '%$q%' ESCAPE '!' OR `nik` LIKE '%$q%' ESCAPE '!' OR `jenis_kelamin` LIKE '%$q%' ESCAPE '!' OR `tiket_vaksin` LIKE '%$q%' ESCAPE '!' OR `faskes` LIKE '%$q%' ESCAPE '!' OR `kelompok_usia` LIKE '%$q%' ESCAPE '!' OR `kategori` LIKE '%$q%' ESCAPE '!' OR `sub_kategori` LIKE '%$q%' ESCAPE '!' OR `vaksinasi` LIKE '%$q%' ESCAPE '!' OR `jenis_vaksin` LIKE '%$q%' ESCAPE '!' OR `kab` LIKE '%$q%' ESCAPE '!' OR `prov` LIKE '%$q%' ESCAPE '!' OR `tanggal` LIKE '%$q%' ESCAPE '!' OR `created_by` LIKE '%$q%' ESCAPE '!' OR `update_by` LIKE '%$q%' ESCAPE '!' OR `created_at` LIKE '%$q%' ESCAPE '!' OR `update_at` LIKE '%$q%' ESCAPE '!' OR `isactive` LIKE '%$q%' ESCAPE '!' ) group by nik ORDER BY `nik` asc");
        // $this->db->limit($limit, $start);
        // return $this->db->get()->result();
        // die($this->db->last_query);

    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // move to bin
    function bin($id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, array('isactive' => 0));
    }
}

/* End of file Data_kpcpen_model.php */
/* Location: ./application/models/Data_kpcpen_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-28 02:45:26 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */