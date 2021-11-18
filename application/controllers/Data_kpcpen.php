<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_kpcpen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // sf_construct();
        $this->load->model('Data_kpcpen_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_kpcpen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_kpcpen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_kpcpen/index.html';
            $config['first_url'] = base_url() . 'data_kpcpen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_kpcpen_model->total_rows($q);
        $data_kpcpen = $this->Data_kpcpen_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_kpcpen_data' => $data_kpcpen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/data_kpcpen/data_kpcpen_list',
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
            $config['base_url'] = base_url() . 'data_kpcpen/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_kpcpen/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_kpcpen/index.html';
            $config['first_url'] = base_url() . 'data_kpcpen/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        // $config['total_rows'] = $this->Data_kpcpen_model->total_rows($q);
        $data_kpcpen = $this->Data_kpcpen_model->get_limit_data($config['per_page'], $start, $q);
        // echo $this->db->last_query;
        // die();

        $data = array(
            'data_kpcpen_data' => $data_kpcpen,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/data_kpcpen/data_kpcpen_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id)
    {
        // sf_validate('R');
        $row = $this->Data_kpcpen_model->get_by_id($id);
        $data_vaksin = $this->db->get_where('data_kpcpen', array('nik' => $row->nik))->result();
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'nik' => $row->nik,
                'data_vaksin' => $data_vaksin,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tiket_vaksin' => $row->tiket_vaksin,
                'faskes' => $row->faskes,
                'kelompok_usia' => $row->kelompok_usia,
                'kategori' => $row->kategori,
                'sub_kategori' => $row->sub_kategori,
                'vaksinasi' => $row->vaksinasi,
                'jenis_vaksin' => $row->jenis_vaksin,
                'kab' => $row->kab,
                'prov' => $row->prov,
                'tanggal' => $row->tanggal,
                'created_by' => $row->created_by,
                'update_by' => $row->update_by,
                'created_at' => $row->created_at,
                'update_at' => $row->update_at,
                'isactive' => $row->isactive,
                'content' => 'backend/data_kpcpen/data_kpcpen_read',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kpcpen'));
        }
    }

    public function create()
    {
        sf_validate('C');
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_kpcpen/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'nik' => set_value('nik'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'tiket_vaksin' => set_value('tiket_vaksin'),
            'faskes' => set_value('faskes'),
            'kelompok_usia' => set_value('kelompok_usia'),
            'kategori' => set_value('kategori'),
            'sub_kategori' => set_value('sub_kategori'),
            'vaksinasi' => set_value('vaksinasi'),
            'jenis_vaksin' => set_value('jenis_vaksin'),
            'kab' => set_value('kab'),
            'prov' => set_value('prov'),
            'tanggal' => set_value('tanggal'),
            'created_by' => set_value('created_by'),
            'update_by' => set_value('update_by'),
            'created_at' => set_value('created_at'),
            'update_at' => set_value('update_at'),
            'isactive' => set_value('isactive'),
            'content' => 'backend/data_kpcpen/data_kpcpen_form',
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
                'nama' => $this->input->post('nama', TRUE),
                'nik' => $this->input->post('nik', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tiket_vaksin' => $this->input->post('tiket_vaksin', TRUE),
                'faskes' => $this->input->post('faskes', TRUE),
                'kelompok_usia' => $this->input->post('kelompok_usia', TRUE),
                'kategori' => $this->input->post('kategori', TRUE),
                'sub_kategori' => $this->input->post('sub_kategori', TRUE),
                'vaksinasi' => $this->input->post('vaksinasi', TRUE),
                'jenis_vaksin' => $this->input->post('jenis_vaksin', TRUE),
                'kab' => $this->input->post('kab', TRUE),
                'prov' => $this->input->post('prov', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
                'created_by' => $this->session->userdata('username'),
                'update_by' => $this->input->post('update_by', TRUE),
                'created_at' => date('Y-m-d H:i:s'),
                'update_at' => $this->input->post('update_at', TRUE),
                'isactive' => 1,
            );

            $this->Data_kpcpen_model->insert($data);
            $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('data_kpcpen'));
        }
    }

    public function update($id)
    {
        sf_validate('U');
        $row = $this->Data_kpcpen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_kpcpen/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'nik' => set_value('nik', $row->nik),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'tiket_vaksin' => set_value('tiket_vaksin', $row->tiket_vaksin),
                'faskes' => set_value('faskes', $row->faskes),
                'kelompok_usia' => set_value('kelompok_usia', $row->kelompok_usia),
                'kategori' => set_value('kategori', $row->kategori),
                'sub_kategori' => set_value('sub_kategori', $row->sub_kategori),
                'vaksinasi' => set_value('vaksinasi', $row->vaksinasi),
                'jenis_vaksin' => set_value('jenis_vaksin', $row->jenis_vaksin),
                'kab' => set_value('kab', $row->kab),
                'prov' => set_value('prov', $row->prov),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'created_by' => set_value('created_by', $row->created_by),
                'update_by' => set_value('update_by', $row->update_by),
                'created_at' => set_value('created_at', $row->created_at),
                'update_at' => set_value('update_at', $row->update_at),
                'isactive' => set_value('isactive', $row->isactive),
                'content' => 'backend/data_kpcpen/data_kpcpen_form',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('data_kpcpen'));
        }
    }

    public function update_action()
    {
        sf_validate('U');
        if (!is_allow('U_' . ucwords($this->router->fetch_class()))) {
            $this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data ' . ucwords($this->router->fetch_class()));
            redirect(site_url(strtolower($this->router->fetch_class())));
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'nik' => $this->input->post('nik', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tiket_vaksin' => $this->input->post('tiket_vaksin', TRUE),
                'faskes' => $this->input->post('faskes', TRUE),
                'kelompok_usia' => $this->input->post('kelompok_usia', TRUE),
                'kategori' => $this->input->post('kategori', TRUE),
                'sub_kategori' => $this->input->post('sub_kategori', TRUE),
                'vaksinasi' => $this->input->post('vaksinasi', TRUE),
                'jenis_vaksin' => $this->input->post('jenis_vaksin', TRUE),
                'kab' => $this->input->post('kab', TRUE),
                'prov' => $this->input->post('prov', TRUE),
                'tanggal' => $this->input->post('tanggal', TRUE),
                'created_by' => $this->input->post('created_by', TRUE),
                'update_by' => $this->input->post('update_by', TRUE),
                'created_at' => $this->input->post('created_at', TRUE),
                'update_at' => $this->input->post('update_at', TRUE),
                'isactive' => $this->input->post('isactive', TRUE),
            );

            $this->Data_kpcpen_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('data_kpcpen'));
        }
    }

    public function delete($id)
    {
        sf_validate('D');
        $row = $this->Data_kpcpen_model->get_by_id($id);

        if ($row) {
            /*$data = array(
                'isactive'=>0,
            );
            $this->Berita_model->update($id,$data);*/
            $this->Data_kpcpen_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('data_kpcpen'));
        } else {
            $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('data_kpcpen'));
        }
    }

    public function excel()
    {
        // sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "data_kpcpen.xls";
        $judul = "data_kpcpen";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Data Diri");
        xlsWriteLabel($tablehead, $kolomhead++, "Data Vaksin");

        foreach ($this->Data_kpcpen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->vaksin2);


            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('nik', 'nik', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('tiket_vaksin', 'tiket vaksin', 'trim|required');
        $this->form_validation->set_rules('faskes', 'faskes', 'trim|required');
        $this->form_validation->set_rules('kelompok_usia', 'kelompok usia', 'trim|required');
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        $this->form_validation->set_rules('sub_kategori', 'sub kategori', 'trim|required');
        $this->form_validation->set_rules('vaksinasi', 'vaksinasi', 'trim|required');
        $this->form_validation->set_rules('jenis_vaksin', 'jenis vaksin', 'trim|required');
        $this->form_validation->set_rules('kab', 'kab', 'trim|required');
        $this->form_validation->set_rules('prov', 'prov', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('created_by', 'created by', 'trim');
        $this->form_validation->set_rules('update_by', 'update by', 'trim|required');
        $this->form_validation->set_rules('created_at', 'created at', 'trim');
        $this->form_validation->set_rules('update_at', 'update at', 'trim|required');
        $this->form_validation->set_rules('isactive', 'isactive', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Data_kpcpen.php */
/* Location: ./application/controllers/Data_kpcpen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-28 02:45:26 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */