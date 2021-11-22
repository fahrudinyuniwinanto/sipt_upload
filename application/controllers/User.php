<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        sf_construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/index.html';
            $config['first_url'] = base_url() . 'user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user/user_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/index.html';
            $config['first_url'] = base_url() . 'user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'user_data' => $user,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user/user_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        sf_validate('R');
        $row = $this->User_model->get_by_id($id);
        if ($row) {
        $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'puskesmas' => $row->puskesmas,
		'program' => $row->program,
		'user' => $row->user,
		'password' => $row->password,
		'status' => $row->status,
		'last_online' => $row->last_online,
		'online' => $row->online,
		'job_status' => $row->job_status,
		'temporari' => $row->temporari,
		'nama_petugas' => $row->nama_petugas,
		'nip_petugas' => $row->nip_petugas,
	    'content' => 'backend/user/user_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('user/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'puskesmas' => set_value('puskesmas'),
	    'program' => set_value('program'),
	    'user' => set_value('user'),
	    'password' => set_value('password'),
	    'status' => set_value('status'),
	    'last_online' => set_value('last_online'),
	    'online' => set_value('online'),
	    'job_status' => set_value('job_status'),
	    'temporari' => set_value('temporari'),
	    'nama_petugas' => set_value('nama_petugas'),
	    'nip_petugas' => set_value('nip_petugas'),
	    'content' => 'backend/user/user_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        sf_validate('c');        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'puskesmas' => $this->input->post('puskesmas',TRUE),
		'program' => $this->input->post('program',TRUE),
		'user' => $this->input->post('user',TRUE),
		'password' => $this->input->post('password',TRUE),
		'status' => $this->input->post('status',TRUE),
		'last_online' => $this->input->post('last_online',TRUE),
		'online' => $this->input->post('online',TRUE),
		'job_status' => $this->input->post('job_status',TRUE),
		'temporari' => $this->input->post('temporari',TRUE),
		'nama_petugas' => $this->input->post('nama_petugas',TRUE),
		'nip_petugas' => $this->input->post('nip_petugas',TRUE),
	    );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        sf_validate('U');
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('user/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'puskesmas' => set_value('puskesmas', $row->puskesmas),
		'program' => set_value('program', $row->program),
		'user' => set_value('user', $row->user),
		'password' => set_value('password', $row->password),
		'status' => set_value('status', $row->status),
		'last_online' => set_value('last_online', $row->last_online),
		'online' => set_value('online', $row->online),
		'job_status' => set_value('job_status', $row->job_status),
		'temporari' => set_value('temporari', $row->temporari),
		'nama_petugas' => set_value('nama_petugas', $row->nama_petugas),
		'nip_petugas' => set_value('nip_petugas', $row->nip_petugas),
	    'content' => 'backend/user/user_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        sf_validate('U');
        if(!is_allow('U_'.ucwords($this->router->fetch_class()))){
            $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data '.ucwords($this->router->fetch_class()));
            redirect(site_url(strtolower($this->router->fetch_class())));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'puskesmas' => $this->input->post('puskesmas',TRUE),
		'program' => $this->input->post('program',TRUE),
		'user' => $this->input->post('user',TRUE),
		'password' => $this->input->post('password',TRUE),
		'status' => $this->input->post('status',TRUE),
		'last_online' => $this->input->post('last_online',TRUE),
		'online' => $this->input->post('online',TRUE),
		'job_status' => $this->input->post('job_status',TRUE),
		'temporari' => $this->input->post('temporari',TRUE),
		'nama_petugas' => $this->input->post('nama_petugas',TRUE),
		'nip_petugas' => $this->input->post('nip_petugas',TRUE),
	    );

            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
        sf_validate('D');
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('puskesmas', 'puskesmas', 'trim|required');
	$this->form_validation->set_rules('program', 'program', 'trim|required');
	$this->form_validation->set_rules('user', 'user', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('last_online', 'last online', 'trim|required');
	$this->form_validation->set_rules('online', 'online', 'trim|required');
	$this->form_validation->set_rules('job_status', 'job status', 'trim|required');
	$this->form_validation->set_rules('temporari', 'temporari', 'trim|required');
	$this->form_validation->set_rules('nama_petugas', 'nama petugas', 'trim|required');
	$this->form_validation->set_rules('nip_petugas', 'nip petugas', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "user.xls";
        $judul = "user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Puskesmas");
	xlsWriteLabel($tablehead, $kolomhead++, "Program");
	xlsWriteLabel($tablehead, $kolomhead++, "User");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Online");
	xlsWriteLabel($tablehead, $kolomhead++, "Online");
	xlsWriteLabel($tablehead, $kolomhead++, "Job Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Temporari");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Petugas");
	xlsWriteLabel($tablehead, $kolomhead++, "Nip Petugas");

	foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->puskesmas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->program);
	    xlsWriteLabel($tablebody, $kolombody++, $data->user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_online);
	    xlsWriteLabel($tablebody, $kolombody++, $data->online);
	    xlsWriteLabel($tablebody, $kolombody++, $data->job_status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->temporari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_petugas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nip_petugas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-22 03:15:19 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */