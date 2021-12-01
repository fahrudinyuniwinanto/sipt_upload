<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {
    function __construct() {
        parent::__construct();
        //query error di mysql terbaru
        // $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $this->load->model('Auth_model');
        if ($this->session->userdata('is_logged') == true) {
            redirect('Backend', 'refresh');
        }
    }
    public function index() {
        $data = array(
            'content' => 'frontend/login.php',
        );
        $this->load->view('layout_frontend.php', $data);
    }

}
