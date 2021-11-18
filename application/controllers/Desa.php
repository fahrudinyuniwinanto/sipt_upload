<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Desa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //sf_construct();
        $this->load->model('Desa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        //sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'desa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'desa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'desa/index.html';
            $config['first_url'] = base_url() . 'desa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Desa_model->total_rows($q);
        $desa = $this->Desa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'desa_data' => $desa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/desa/desa_list',
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
            $config['base_url'] = base_url() . 'desa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'desa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'desa/index.html';
            $config['first_url'] = base_url() . 'desa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Desa_model->total_rows($q);
        $desa = $this->Desa_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'desa_data' => $desa,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/desa/desa_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        sf_validate('R');
        $row = $this->Desa_model->get_by_id($id);
        if ($row) {
        $data = array(
		'id_desa' => $row->id_desa,
		'id_kecamatan' => $row->id_kecamatan,
		'nama_desa' => $row->nama_desa,
		'col1' => $row->col1,
		'col2' => $row->col2,
		'col3' => $row->col3,
		'col4' => $row->col4,
		'col5' => $row->col5,
		'created_at' => $row->created_at,
		'created_by' => $row->created_by,
		'updated_at' => $row->updated_at,
		'updated_by' => $row->updated_by,
		'isactive' => $row->isactive,
	    'content' => 'backend/desa/desa_read',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('desa'));
        }
    }

    public function create() 
    {
        sf_validate('C');
        $data = array(
        'button' => 'Create',
        'action' => site_url('desa/create_action'),
	    'id_desa' => set_value('id_desa'),
	    'id_kecamatan' => set_value('id_kecamatan'),
	    'nama_desa' => set_value('nama_desa'),
	    'col1' => set_value('col1'),
	    'col2' => set_value('col2'),
	    'col3' => set_value('col3'),
	    'col4' => set_value('col4'),
	    'col5' => set_value('col5'),
	    'created_at' => set_value('created_at'),
	    'created_by' => set_value('created_by'),
	    'updated_at' => set_value('updated_at'),
	    'updated_by' => set_value('updated_by'),
	    'isactive' => set_value('isactive'),
	    'content' => 'backend/desa/desa_form',
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
		'id_desa' => $this->input->post('id_desa',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
		'nama_desa' => $this->input->post('nama_desa',TRUE),
		'col1' => $this->input->post('col1',TRUE),
		'col2' => $this->input->post('col2',TRUE),
		'col3' => $this->input->post('col3',TRUE),
		'col4' => $this->input->post('col4',TRUE),
		'col5' => $this->input->post('col5',TRUE),
		'created_at' => date('Y-m-d H:i:s'),
		'created_by' => $this->session->userdata('username'),
		'updated_at' => $this->input->post('updated_at',TRUE),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'isactive' => 1,
	    );

            $this->Desa_model->insert($data);
            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('desa'));
        }
    }
    
    public function update($id) 
    {
        sf_validate('U');
        $row = $this->Desa_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('desa/update_action'),
		'id_desa' => set_value('id_desa', $row->id_desa),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
		'nama_desa' => set_value('nama_desa', $row->nama_desa),
		'col1' => set_value('col1', $row->col1),
		'col2' => set_value('col2', $row->col2),
		'col3' => set_value('col3', $row->col3),
		'col4' => set_value('col4', $row->col4),
		'col5' => set_value('col5', $row->col5),
		'created_at' => set_value('created_at', $row->created_at),
		'created_by' => set_value('created_by', $row->created_by),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'updated_by' => set_value('updated_by', $row->updated_by),
		'isactive' => set_value('isactive', $row->isactive),
	    'content' => 'backend/desa/desa_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('desa'));
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
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_desa' => $this->input->post('id_desa',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
		'nama_desa' => $this->input->post('nama_desa',TRUE),
		'col1' => $this->input->post('col1',TRUE),
		'col2' => $this->input->post('col2',TRUE),
		'col3' => $this->input->post('col3',TRUE),
		'col4' => $this->input->post('col4',TRUE),
		'col5' => $this->input->post('col5',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'updated_at' => date('Y-m-d H:i:s'),
		'updated_by' => $this->session->userdata('username'),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Desa_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('desa'));
        }
    }
    
    public function delete($id) 
    {
        sf_validate('D');
        $row = $this->Desa_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->Desa_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('desa'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('desa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_desa', 'id desa', 'trim|required');
	$this->form_validation->set_rules('id_kecamatan', 'id kecamatan', 'trim|required');
	$this->form_validation->set_rules('nama_desa', 'nama desa', 'trim|required');
	$this->form_validation->set_rules('col1', 'col1', 'trim|required');
	$this->form_validation->set_rules('col2', 'col2', 'trim|required');
	$this->form_validation->set_rules('col3', 'col3', 'trim|required');
	$this->form_validation->set_rules('col4', 'col4', 'trim|required');
	$this->form_validation->set_rules('col5', 'col5', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim');
	$this->form_validation->set_rules('updated_by', 'updated by', 'trim');
	$this->form_validation->set_rules('isactive', 'isactive', 'trim');
	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "desa.xls";
        $judul = "desa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Desa");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kecamatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Desa");
	xlsWriteLabel($tablehead, $kolomhead++, "Col1");
	xlsWriteLabel($tablehead, $kolomhead++, "Col2");
	xlsWriteLabel($tablehead, $kolomhead++, "Col3");
	xlsWriteLabel($tablehead, $kolomhead++, "Col4");
	xlsWriteLabel($tablehead, $kolomhead++, "Col5");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated By");
	xlsWriteLabel($tablehead, $kolomhead++, "Isactive");

	foreach ($this->Desa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_desa);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kecamatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_desa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col4);
	    xlsWriteLabel($tablebody, $kolombody++, $data->col5);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_by);
	    xlsWriteNumber($tablebody, $kolombody++, $data->isactive);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Desa.php */
/* Location: ./application/controllers/Desa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-30 08:32:26 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */