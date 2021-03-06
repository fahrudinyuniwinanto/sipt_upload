<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_bermasalah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // sf_construct();
        $this->load->model('Data_bermasalah_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_bermasalah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_bermasalah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_bermasalah/index.html';
            $config['first_url'] = base_url() . 'data_bermasalah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_bermasalah_model->total_rows($q);
        $data_bermasalah = $this->Data_bermasalah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_bermasalah_data' => $data_bermasalah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/data_bermasalah/data_bermasalah_list',
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
            $config['base_url'] = base_url() . 'data_bermasalah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_bermasalah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_bermasalah/index.html';
            $config['first_url'] = base_url() . 'data_bermasalah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_bermasalah_model->total_rows($q);
        $data_bermasalah = $this->Data_bermasalah_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'data_bermasalah_data' => $data_bermasalah,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/data_bermasalah/data_bermasalah_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

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
                'content' => 'backend/data_bermasalah/data_bermasalah_read',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_bermasalah'));
        }
    }

    // public function create()
    // {
    //     sf_validate('C');
    //     $data = array(
    //         'button' => 'Create',
    //         'action' => site_url('data_bermasalah/create_action'),
    //         'id' => set_value('id'),
    //         'nik' => set_value('nik'),
    //         'nama' => set_value('nama'),
    //         'alamat' => set_value('alamat'),
    //         'permasalahan' => set_value('permasalahan'),
    //         'faskes' => set_value('faskes'),
    //         'keterangan' => set_value('keterangan'),
    //         'created_by' => set_value('created_by'),
    //         'created_at' => set_value('created_at'),
    //         'updated_by' => set_value('updated_by'),
    //         'updated_at' => set_value('updated_at'),
    //         'content' => 'backend/data_bermasalah/data_bermasalah_form',
    //     );
    //     $this->load->view(layout(), $data);
    // }

    // public function create_action()
    // {
    //     sf_validate('c');
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->create();
    //     } else {
    //         $data = array(
    //             'nik' => $this->input->post('nik', TRUE),
    //             'nama' => $this->input->post('nama', TRUE),
    //             'alamat' => $this->input->post('alamat', TRUE),
    //             'permasalahan' => $this->input->post('permasalahan', TRUE),
    //             'faskes' => $this->input->post('faskes', TRUE),
    //             'keterangan' => $this->input->post('keterangan', TRUE),
    //             'created_by' => $this->session->userdata('username'),
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_by' => $this->input->post('updated_by', TRUE),
    //             'updated_at' => $this->input->post('updated_at', TRUE),
    //         );

    //         $this->Data_bermasalah_model->insert($data);
    //         $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
    //         redirect(site_url('data_bermasalah'));
    //     }
    // }

    // public function update($id)
    // {
    //     sf_validate('U');
    //     $row = $this->Data_bermasalah_model->get_by_id($id);

    //     if ($row) {
    //         $data = array(
    //             'button' => 'Update',
    //             'action' => site_url('data_bermasalah/update_action'),
    //             'id' => set_value('id', $row->id),
    //             'nik' => set_value('nik', $row->nik),
    //             'nama' => set_value('nama', $row->nama),
    //             'alamat' => set_value('alamat', $row->alamat),
    //             'permasalahan' => set_value('permasalahan', $row->permasalahan),
    //             'faskes' => set_value('faskes', $row->faskes),
    //             'keterangan' => set_value('keterangan', $row->keterangan),
    //             'created_by' => set_value('created_by', $row->created_by),
    //             'created_at' => set_value('created_at', $row->created_at),
    //             'updated_by' => set_value('updated_by', $row->updated_by),
    //             'updated_at' => set_value('updated_at', $row->updated_at),
    //             'content' => 'backend/data_bermasalah/data_bermasalah_form',
    //         );
    //         $this->load->view(layout(), $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
    //         redirect(site_url('data_bermasalah'));
    //     }
    // }

    // public function update_action()
    // {
    //     sf_validate('U');
    //     if (!is_allow('U_' . ucwords($this->router->fetch_class()))) {
    //         $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data ' . ucwords($this->router->fetch_class()));
    //         redirect(site_url(strtolower($this->router->fetch_class())));
    //     }
    //     $this->_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->update($this->input->post('id', TRUE));
    //     } else {
    //         $data = array(
    //             'nik' => $this->input->post('nik', TRUE),
    //             'nama' => $this->input->post('nama', TRUE),
    //             'alamat' => $this->input->post('alamat', TRUE),
    //             'permasalahan' => $this->input->post('permasalahan', TRUE),
    //             'faskes' => $this->input->post('faskes', TRUE),
    //             'keterangan' => $this->input->post('keterangan', TRUE),
    //             'created_by' => $this->input->post('created_by', TRUE),
    //             'created_at' => $this->input->post('created_at', TRUE),
    //             'updated_by' => $this->session->userdata('username'),
    //             'updated_at' => date('Y-m-d H:i:s'),
    //         );

    //         $this->Data_bermasalah_model->update($this->input->post('id', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Edit data telah berhasil!');
    //         redirect(site_url('data_bermasalah'));
    //     }
    // }

    // public function delete($id)
    // {
    //     sf_validate('D');
    //     $row = $this->Data_bermasalah_model->get_by_id($id);

    //     if ($row) {
    //         /*$data = array(
    //             'isactive'=>0,
    //         );
    //         $this->Berita_model->update($id,$data);*/
    //         $this->Data_bermasalah_model->delete($id);
    //         $this->session->set_flashdata('message', 'Hapus data berhasil!');
    //         redirect(site_url('data_bermasalah'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
    //         redirect(site_url('data_bermasalah'));
    //     }
    // }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'nik', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('permasalahan', 'permasalahan', 'trim|required');
        $this->form_validation->set_rules('faskes', 'faskes', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('created_by', 'created by', 'trim');
        $this->form_validation->set_rules('created_at', 'created at', 'trim');
        $this->form_validation->set_rules('updated_by', 'updated by', 'trim');
        $this->form_validation->set_rules('updated_at', 'updated at', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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

        foreach ($this->Data_bermasalah_model->get_all() as $data) {
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

/* End of file Data_bermasalah.php */
/* Location: ./application/controllers/Data_bermasalah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-02 04:04:47 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */