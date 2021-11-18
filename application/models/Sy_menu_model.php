<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sy_menu_model extends CI_Model
{

    public $table = 'sy_menu';
    public $id = 'id_menu';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('order_no', 'asc');
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
        $this->db->like('id_menu', $q);
        $this->db->or_like('label', $q);
        $this->db->or_like('redirect', $q);
        $this->db->or_like('url', $q);
        $this->db->or_like('parent', $q);
        $this->db->or_like('icon', $q);
        $this->db->or_like('note', $q);
        $this->db->or_like('order_no', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('updated_by', $q);
        $this->db->or_like('updated_at', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_menu', $q);
        $this->db->or_like('label', $q);
        $this->db->or_like('redirect', $q);
        $this->db->or_like('url', $q);
        $this->db->or_like('parent', $q);
        $this->db->or_like('icon', $q);
        $this->db->or_like('note', $q);
        $this->db->or_like('order_no', $q);
        $this->db->or_like('created_by', $q);
        $this->db->or_like('created_at', $q);
        $this->db->or_like('updated_by', $q);
        $this->db->or_like('updated_at', $q);
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
}

/* End of file Sy_menu_model.php */
/* Location: ./application/models/Sy_menu_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-02-06 08:45:17 */
/* http://harviacode.com */