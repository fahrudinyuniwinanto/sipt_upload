<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    public $table = 'user';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
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
    function total_rows($q = NULL) {
        $this->db->where('isactive', 1);
        $this->db->group_start();
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('puskesmas', $q);
	$this->db->or_like('program', $q);
	$this->db->or_like('user', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('last_online', $q);
	$this->db->or_like('online', $q);
	$this->db->or_like('job_status', $q);
	$this->db->or_like('temporari', $q);
	$this->db->or_like('nama_petugas', $q);
	$this->db->or_like('nip_petugas', $q);
	$this->db->group_end();
            $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('isactive', 1);
        $this->db->group_start();
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('puskesmas', $q);
	$this->db->or_like('program', $q);
	$this->db->or_like('user', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('last_online', $q);
	$this->db->or_like('online', $q);
	$this->db->or_like('job_status', $q);
	$this->db->or_like('temporari', $q);
	$this->db->or_like('nama_petugas', $q);
	$this->db->or_like('nip_petugas', $q);
	$this->db->group_end();
            $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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
    function bin($id){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, array('isactive'=>0));
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-22 03:15:19 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */