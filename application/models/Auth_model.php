<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
//    untuk mengcek jumlah username dan password yang sesuai
    function login($username,$password) {
        $this->db->where('user', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get('user');
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_login($username,$password) {
        $this->db->where('user', $username);
        $this->db->where('password', $password);
        return $this->db->get('user')->row();
    }   

    //MULTI TABEL
//    untuk mengcek jumlah username dan password yang sesuai
    function login_multitable($username,$password,$tbl) {
        $this->db->where('user', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get($tbl);
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_login_multitable($username,$password,$tbl) {
        // $this->db->select("aa.*,aa.program as id_program,bb.id as id_puskesmas,bb.puskesmas as puskesmas,bb.alamat as alamat");
        $this->db->where('user', $username);
        $this->db->where('password', $password);
        // $this->db->join('puskesmas as bb','aa.puskesmas=bb.id');
        return $this->db->get($tbl)->row();
    }
}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */