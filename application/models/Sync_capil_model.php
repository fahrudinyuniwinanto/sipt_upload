<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sync_capil_model extends CI_Model
{

    public $table = 'sync_capil';
    public $id = 'nik';
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
    function total_rows($q = NULL)
    {
        // $this->db->group_start();
        // $this->db->like('id', $q);
        // $this->db->or_like('nik', $q);
        // $this->db->or_like('nama_lengkap', $q);
        // $this->db->or_like('jenis_kelamin', $q);
        // $this->db->or_like('tgl_lahir', $q);
        // $this->db->or_like('alamat', $q);
        // $this->db->or_like('desa', $q);
        // $this->db->or_like('kecamatan', $q);
        // $this->db->or_like('rt', $q);
        // $this->db->or_like('rw', $q);
        // $this->db->or_like('tempat_lahir', $q);
        // $this->db->group_end();
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function total_rows_laporan($q=[]){
        $where="";
         $like="";
        
        if($q['qkec']!=""){
            $where .= "AND kecamatan='".$q['qkec']."'";
        }
        if($q['qdesa']!=""){
            $where .= "AND desa='".$q['qdesa']."'";
        }
        // $limitoffset="LIMIT $limit OFFSET $start";
        $limitoffset="";//tanpa limit
        
        if($q['qisvaksin']=="B1B2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik not in (select nik from data_kpcpen) $where $limitoffset")->num_rows();
        }else if($q['qisvaksin']=="S1B2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik not in (select nik from data_kpcpen where vaksinasi='Dosis 2') and nik in (select nik from data_kpcpen where vaksinasi='Dosis 1') $where $limitoffset")->num_rows();
        }else if($q['qisvaksin']=="S1B2ED"){// kurang tanggal ed
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik in (select nik from data_kpcpen where vaksinasi='Dosis 1') $where $limitoffset")->num_rows();
        }else if($q['qisvaksin']=="S1S2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik in (select nik from data_kpcpen where vaksinasi='Dosis 2') $where $limitoffset")->num_rows();
        }else if($q['qisvaksin']=="BLANK"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik in (select nik from data_kpcpen where vaksinasi IS NULL) $where $limitoffset")->num_rows();
        }
        //default
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where 1=1  $where $limitoffset")->num_rows();
        
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        // $this->db->where('isactive', 1);
        $this->db->group_start();
        // $this->db->like('id', $q);
        $this->db->or_like('nik', $q);
        $this->db->or_like('nama_lengkap', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('tgl_lahir', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('desa', $q);
        $this->db->or_like('kecamatan', $q);
        $this->db->or_like('rt', $q);
        $this->db->or_like('rw', $q);
        $this->db->or_like('tempat_lahir', $q);
        $this->db->group_end();
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

     // get data with limit and search data laporan
     function get_limit_data_laporan($limit, $start = 0, $q = [])
     { 
         $where="";
         $like="";
        if($q['qkec']!=""){
            $where .= " AND kecamatan='".$q['qkec']."'";
        }
        if($q['qnama']!=""){
            $like .= " AND nama_lengkap LIKE '%".$q['qnama']."%'";
        }
        if($q['qdesa']!=""){
            $where .= " AND desa='".$q['qdesa']."'";
        }
        $limitoffset=" LIMIT $limit OFFSET $start";
        
        if($q['qisvaksin']=="B1B2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where (nik not in (select nik from data_kpcpen) $where) $like $limitoffset")->result();
        }else if($q['qisvaksin']=="S1B2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik not in (select nik from data_kpcpen where vaksinasi='Dosis 2') and nik in (select nik from data_kpcpen where vaksinasi='Dosis 1') $where $limitoffset")->result();
        }else if($q['qisvaksin']=="S1B2ED"){// kurang tanggal ed
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where (nik not in (select nik from data_kpcpen where vaksinasi='Dosis 2') and nik in (select nik from data_kpcpen where vaksinasi='Dosis 1') $where) $like $limitoffset")->result();
        }else if($q['qisvaksin']=="S1S2"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where (nik in (select nik from data_kpcpen where vaksinasi='Dosis 2') $where) $like $limitoffset")->result();
        }else if($q['qisvaksin']=="S1S2S3"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where (nik in (select nik from data_kpcpen where vaksinasi='Dosis 3') $where) $like $limitoffset")->result();
        }else if($q['qisvaksin']=="BLANK"){//ok
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where nik in (select nik from data_kpcpen where vaksinasi IS NULL) $where $limitoffset")->result();
        }
        //default
            return $this->db->query("select nik,nama_lengkap,jenis_kelamin,desa,kecamatan from sync_capil where (1=1 $where) $like $limitoffset")->result();
        
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

/* End of file Sync_capil_model.php */
/* Location: ./application/models/Sync_capil_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-27 05:06:12 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */