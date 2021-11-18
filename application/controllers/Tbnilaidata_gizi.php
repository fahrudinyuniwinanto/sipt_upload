<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbnilaidata_gizi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // sf_construct();
        $this->load->model('Tbnilaidata_gizi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbnilaidata_gizi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbnilaidata_gizi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbnilaidata_gizi/index.html';
            $config['first_url'] = base_url() . 'tbnilaidata_gizi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbnilaidata_gizi_model->total_rows($q);
        $tbnilaidata_gizi = $this->Tbnilaidata_gizi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbnilaidata_gizi_data' => $tbnilaidata_gizi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/tbnilaidata_gizi/tbnilaidata_gizi_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbnilaidata_gizi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbnilaidata_gizi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbnilaidata_gizi/index.html';
            $config['first_url'] = base_url() . 'tbnilaidata_gizi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbnilaidata_gizi_model->total_rows($q);
        $tbnilaidata_gizi = $this->Tbnilaidata_gizi_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'tbnilaidata_gizi_data' => $tbnilaidata_gizi,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/tbnilaidata_gizi/tbnilaidata_gizi_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        // sf_validate('R');
        $row = $this->Tbnilaidata_gizi_model->get_by_id($id);
        if ($row) {
        $data = array(
		'ID' => $row->ID,
		'NILAI' => $row->NILAI,
		'SUMBERDATA' => $row->SUMBERDATA,
		'KODE' => $row->KODE,
		'TAHUN' => $row->TAHUN,
		'BULAN' => $row->BULAN,
		'PUSKESMAS' => $row->PUSKESMAS,
		'DESA' => $row->DESA,
		'TGL_ENTRY' => $row->TGL_ENTRY,
	    'content' => 'backend/tbnilaidata_gizi/tbnilaidata_gizi_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbnilaidata_gizi'));
        }
    }

    public function create() 
    {
        // sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('tbnilaidata_gizi/create_action'),
	    'ID' => set_value('ID'),
	    'NILAI' => set_value('NILAI'),
	    'SUMBERDATA' => set_value('SUMBERDATA'),
	    'KODE' => set_value('KODE'),
	    'TAHUN' => set_value('TAHUN'),
	    'BULAN' => set_value('BULAN'),
	    'PUSKESMAS' => set_value('PUSKESMAS'),
	    'DESA' => set_value('DESA'),
	    'TGL_ENTRY' => set_value('TGL_ENTRY'),
	    'content' => 'backend/tbnilaidata_gizi/tbnilaidata_gizi_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        // sf_validate('c');        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ID' => $this->input->post('ID',TRUE),
		'NILAI' => $this->input->post('NILAI',TRUE),
		'SUMBERDATA' => $this->input->post('SUMBERDATA',TRUE),
		'KODE' => $this->input->post('KODE',TRUE),
		'TAHUN' => $this->input->post('TAHUN',TRUE),
		'BULAN' => $this->input->post('BULAN',TRUE),
		'PUSKESMAS' => $this->input->post('PUSKESMAS',TRUE),
		'DESA' => $this->input->post('DESA',TRUE),
		'TGL_ENTRY' => $this->input->post('TGL_ENTRY',TRUE),
	    );

            $this->Tbnilaidata_gizi_model->insert($data);
            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('tbnilaidata_gizi'));
        }
    }
    
    public function update($id) 
    {
        // sf_validate('U');
        $row = $this->Tbnilaidata_gizi_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('tbnilaidata_gizi/update_action'),
		'ID' => set_value('ID', $row->ID),
		'NILAI' => set_value('NILAI', $row->NILAI),
		'SUMBERDATA' => set_value('SUMBERDATA', $row->SUMBERDATA),
		'KODE' => set_value('KODE', $row->KODE),
		'TAHUN' => set_value('TAHUN', $row->TAHUN),
		'BULAN' => set_value('BULAN', $row->BULAN),
		'PUSKESMAS' => set_value('PUSKESMAS', $row->PUSKESMAS),
		'DESA' => set_value('DESA', $row->DESA),
		'TGL_ENTRY' => set_value('TGL_ENTRY', $row->TGL_ENTRY),
	    'content' => 'backend/tbnilaidata_gizi/tbnilaidata_gizi_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('tbnilaidata_gizi'));
        }
    }
    
    public function update_action() 
    {
        // sf_validate('U');
        if(!is_allow('U_'.ucwords($this->router->fetch_class()))){
            $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data '.ucwords($this->router->fetch_class()));
            redirect(site_url(strtolower($this->router->fetch_class())));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'ID' => $this->input->post('ID',TRUE),
		'NILAI' => $this->input->post('NILAI',TRUE),
		'SUMBERDATA' => $this->input->post('SUMBERDATA',TRUE),
		'KODE' => $this->input->post('KODE',TRUE),
		'TAHUN' => $this->input->post('TAHUN',TRUE),
		'BULAN' => $this->input->post('BULAN',TRUE),
		'PUSKESMAS' => $this->input->post('PUSKESMAS',TRUE),
		'DESA' => $this->input->post('DESA',TRUE),
		'TGL_ENTRY' => $this->input->post('TGL_ENTRY',TRUE),
	    );

            $this->Tbnilaidata_gizi_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('tbnilaidata_gizi'));
        }
    }
    
    public function delete($id) 
    {
        // sf_validate('D');
        $row = $this->Tbnilaidata_gizi_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->Tbnilaidata_gizi_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('tbnilaidata_gizi'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('tbnilaidata_gizi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ID', 'id', 'trim|required|numeric');
	$this->form_validation->set_rules('NILAI', 'nilai', 'trim|required');
	$this->form_validation->set_rules('SUMBERDATA', 'sumberdata', 'trim|required');
	$this->form_validation->set_rules('KODE', 'kode', 'trim|required');
	$this->form_validation->set_rules('TAHUN', 'tahun', 'trim|required');
	$this->form_validation->set_rules('BULAN', 'bulan', 'trim|required');
	$this->form_validation->set_rules('PUSKESMAS', 'puskesmas', 'trim|required');
	$this->form_validation->set_rules('DESA', 'desa', 'trim|required');
	$this->form_validation->set_rules('TGL_ENTRY', 'tgl entry', 'trim|required');
	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        // sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "tbnilaidata_gizi.xls";
        $judul = "tbnilaidata_gizi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "ID");
	xlsWriteLabel($tablehead, $kolomhead++, "NILAI");
	xlsWriteLabel($tablehead, $kolomhead++, "SUMBERDATA");
	xlsWriteLabel($tablehead, $kolomhead++, "KODE");
	xlsWriteLabel($tablehead, $kolomhead++, "TAHUN");
	xlsWriteLabel($tablehead, $kolomhead++, "BULAN");
	xlsWriteLabel($tablehead, $kolomhead++, "PUSKESMAS");
	xlsWriteLabel($tablehead, $kolomhead++, "DESA");
	xlsWriteLabel($tablehead, $kolomhead++, "TGL ENTRY");

	foreach ($this->Tbnilaidata_gizi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ID);
	    xlsWriteNumber($tablebody, $kolombody++, $data->NILAI);
	    xlsWriteLabel($tablebody, $kolombody++, $data->SUMBERDATA);
	    xlsWriteNumber($tablebody, $kolombody++, $data->KODE);
	    xlsWriteNumber($tablebody, $kolombody++, $data->TAHUN);
	    xlsWriteNumber($tablebody, $kolombody++, $data->BULAN);
	    xlsWriteLabel($tablebody, $kolombody++, $data->PUSKESMAS);
	    xlsWriteLabel($tablebody, $kolombody++, $data->DESA);
	    xlsWriteLabel($tablebody, $kolombody++, $data->TGL_ENTRY);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tbnilaidata_gizi.php */
/* Location: ./application/controllers/Tbnilaidata_gizi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-18 01:29:53 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */