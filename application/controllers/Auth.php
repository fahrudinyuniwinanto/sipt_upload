<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        if ($this->session->userdata('is_logged') == true) {
            redirect('Backend', 'refresh');
        }
    }
    public function index($error = NULL) {
        redirect(base_url(), 'refresh');
    }

    public function login() {
        //CAPTCHA================================//
        $cpt    = $this->input->post("cpt", TRUE);
        $rescpt = $this->input->post("rescpt", TRUE);
        if ($cpt != $rescpt) {
            $this->session->set_flashdata('msgcaptcha', '<i class="fa fa-warning"></i> Captcha belum tepat, silakan ulangi lagi');
            redirect(site_url(''));
        }

        //ENDOFCAPTCHA=========================//
        //sebut nama tabel yg akan dicek login
        $data_tbl = array('user');
        $pengacak = "AJWKXLAJSCLWLW";
        $pass = $pengacak.$this->input->post('password').$pengacak;
        foreach ($data_tbl as $key => $vtbl) {
            $login = $this->Auth_model->login_multitable($this->input->post('username'),md5($pass), $vtbl);
            // die("asdf".$login);
            if ($login == 1) {
                // die($value."=".$login);
                //          ambil detail data
                $row = $this->Auth_model->data_login_multitable($this->input->post('username'),md5($pass), $vtbl);
                // print_r($row);die();
                switch ($vtbl) {
                //sesuai id di tabel user_group
                case 'user':
                    $grup = 1;
                    break;
                }
                // die($grup."dfdf");
                //          daftarkan session
                $data = array(
                    'logged'   => TRUE,
                    'id_user'  => $row->id,
                    'username' => $row->puskesmas,
                    'fullname' => $row->nama,
                    'id_puskesmas' => $row->id_puskesmas,
                    'id_program' => $row->id_program,
                    'telp'     => $row->alamat,
                    'email'    => "",
                    'foto'     => "",
                    'level'    => $grup,
                );
                $this->session->set_userdata($data);

//            redirect ke halaman sukses
                redirect(site_url('Tbnilaidata_gizi'));
            }
        }
//            tampilkan pesan error
        $error = 'username / password salah';
        $this->index($error);

    }

    function logout() {
//        destroy session
        $this->session->sess_destroy();

//        redirect ke halaman login
        redirect(site_url('auth'));
    }

}
