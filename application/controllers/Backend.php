<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Sy_menu_model');
        // is_logged();
    }

    public function index()
    {
        $jmlSudahVaksin1 = $this->db->query("select nik FROM sync_capil WHERE nik IN (SELECT nik FROM data_kpcpen where vaksinasi='Dosis 1')")->num_rows();
        $jmlSudahVaksin2 = $this->db->query("select nik FROM sync_capil WHERE nik IN (SELECT nik FROM data_kpcpen where vaksinasi='Dosis 2')")->num_rows();
        $jmlBelumVaksin = $this->db->query("select nik FROM sync_capil WHERE nik NOT IN (SELECT nik FROM data_kpcpen)")->num_rows();

        $data = array(
            'content' => 'backend/dashboard',
            'jmlSudahVaksin1' => $jmlSudahVaksin1,
            'jmlSudahVaksin2' => $jmlSudahVaksin2,
            'jmlBelumVaksin' => $jmlBelumVaksin

        );
        $this->load->view('layout_backend.php', $data);
    }
}
