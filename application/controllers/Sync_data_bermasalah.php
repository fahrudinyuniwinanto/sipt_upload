<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sync_data_bermasalah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Users_model');
        // $this->load->model('Data_kpcpen_model');
        $this->load->model('Sync_data_bermasalah_model');
        $this->load->model('Data_bermasalah_model');
        // $this->load->model('Sy_menu_model');
        // $this->load->model('Kecamatan_model');
        // is_logged();
    }


    public function index()
    {
        // $q = array(
        //     'qstart' => intval($this->input->get('qstart')),
        //     'qend' => intval($this->input->get('qend')),
        //     'qnik' => urldecode($this->input->get('qnik', TRUE)),
        //     'qnama' => urldecode($this->input->get('qnama', TRUE)),
        //     'qkec' => urldecode($this->input->get('qkec', TRUE)),
        //     'qdesa' => urldecode($this->input->get('qdesa', TRUE)),
        //     'qisvaksin' => urldecode($this->input->get('qisvaksin', TRUE)),
        // );

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $config['base_url'] = base_url() . 'sync_data_bermasalah/index.html';
        $config['first_url'] = base_url() . 'sync_data_bermasalah/index.html';

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sync_data_bermasalah_model->total_rows($q);
        $sync_data_bermasalah = $this->Sync_data_bermasalah_model->get_limit_data($config['per_page'], $start, $q);
        // die($this->db->last_query());
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sync_data_bermasalah' => $sync_data_bermasalah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sync_data_bermasalah/sync_data_bermasalah_list',
        );
        $this->load->view(layout(), $data);
    }



    // sf_validate('R');
    public function read($id)
    {
        // sf_validate('R');
        $row = $this->Data_bermasalah_model->get_by_id($id);
        if ($row) {
            $data = array(
                // 'id' => $row->id,
                'nik' => $row->nik,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'permasalahan' => $row->permasalahan,
                'faskes' => $row->faskes,
                'keterangan' => $row->keterangan,
                'sinkronisasi_dukcapil' => $row->sinkronisasi_dukcapil,
                'perubahan_nik' => $row->perubahan_nik,
                'no_hp' => $row->no_hp,
                'created_by' => $row->created_by,
                'created_at' => $row->created_at,
                'updated_by' => $row->updated_by,
                'updated_at' => $row->updated_at,
                'content' => 'backend/sync_data_bermasalah/sync_data_bermasalah_read',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_bermasalah'));
        }
    }

    public function excel()
    {
        // sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "data_bermasalah.xls";
        $judul = "data_bermasalah";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nik");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Permasalahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Faskes");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Sinkronisasi Dukcapil");
        xlsWriteLabel($tablehead, $kolomhead++, "Perubahan NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "No.HP");

        foreach ($this->Sync_data_bermasalah_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nik);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, $data->permasalahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->faskes);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
            xlsWriteLabel($tablebody, $kolombody++, $data->sinkronisasi_dukcapil);
            xlsWriteLabel($tablebody, $kolombody++, $data->perubahan_nik);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}
