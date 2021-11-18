<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sync_capil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // sf_construct();
        $this->load->model('Sync_capil_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // sf_validate('M');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'sync_capil/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sync_capil/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sync_capil/index.html';
            $config['first_url'] = base_url() . 'sync_capil/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sync_capil_model->total_rows($q);
        $sync_capil = $this->Sync_capil_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sync_capil_data' => $sync_capil,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sync_capil/sync_capil_list',
        );
        $this->load->view(layout(), $data);
    }

    // function upload_file()
    // {
    //     //ini data ngasal, ceritanya mau dapetin array yang ada di excel
    //     $query = $this->db->get('data_kpcpen_copy', 10)->result();
    //     $nik_excel = []; //buat nampung nik2 dari excel
    //     //buat ngisi data nik excel ke array
    //     foreach ($query as $result) {
    //         array_push($nik_excel, str_replace("'","",$result->nik));
    //     }
    //     //buat ngeseleksi data mana aja yang mau diinputin ke database
    //     $this->db->select("*");
    //     $this->db->from('data_kpcpen');
    //     $this->db->where_not_in('nik', $nik_excel);
    //     $this->db->limit(30);
    //     $data_for_insert = $this->db->get()->result();
    //     // echo $this->db->last_query();die();

    //     //buat insert ke database
    //     $this->db->insert_batch('data_kpcpen_copy', $data_for_insert);
    //     // die();
    // }

    // public function lookup()
    // {
    //     sf_validate('M');
    //     $q = urldecode($this->input->get('q', TRUE));
    //     $start = intval($this->input->get('start'));
    //     $idhtml = $this->input->get('idhtml');

    //     if ($q <> '') {
    //         $config['base_url'] = base_url() . 'sync_capil/index.html?q=' . urlencode($q);
    //         $config['first_url'] = base_url() . 'sync_capil/index.html?q=' . urlencode($q);
    //     } else {
    //         $config['base_url'] = base_url() . 'sync_capil/index.html';
    //         $config['first_url'] = base_url() . 'sync_capil/index.html';
    //     }

    //     $config['per_page'] = 10;
    //     $config['page_query_string'] = TRUE;
    //     $config['total_rows'] = $this->Sync_capil_model->total_rows($q);
    //     $sync_capil = $this->Sync_capil_model->get_limit_data($config['per_page'], $start, $q);


    //     $data = array(
    //         'sync_capil_data' => $sync_capil,
    //         'idhtml' => $idhtml,
    //         'q' => $q,
    //         'total_rows' => $config['total_rows'],
    //         'start' => $start,
    //         'content' => 'backend/sync_capil/sync_capil_lookup',
    //     );
    //     ob_start();
    //     $this->load->view($data['content'], $data);
    //     return ob_get_contents();
    //     ob_end_clean();
    // }

    public function read($id)
    {
        // sf_validate('R');
        $row = $this->Sync_capil_model->get_by_id($id);
        if ($row) {
            $data = array(
                'nik' => $row->nik,
                'nama_lengkap' => $row->nama_lengkap,
                'tgl_lahir' => $row->tgl_lahir,
                'alamat' => $row->alamat,
                'desa' => $row->desa,
                'kecamatan' => $row->kecamatan,
                'tempat_lahir' => $row->tempat_lahir,
                'rt' => $row->rt,
                'rw' => $row->rw,
                'created_by' => $row->created_by,
                'update_by' => $row->update_by,
                'created_at' => $row->created_at,
                'update_at' => $row->update_at,
                'isactive' => $row->isactive,
                'content' => 'backend/sync_capil/sync_capil_read',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sync_capil'));
        }
    }

    // public function create()
    // {
    //     sf_validate('C');
    //     $data = array(
    //         'button' => 'Create',
    //         'action' => site_url('sync_capil/create_action'),
    //         'nik' => set_value('nik'),
    //         'nama_lengkap' => set_value('nama_lengkap'),
    //         'tgl_lahir' => set_value('tgl_lahir'),
    //         'alamat' => set_value('alamat'),
    //         'desa' => set_value('desa'),
    //         'kecamatan' => set_value('kecamatan'),
    //         'ket1' => set_value('ket1'),
    //         'ket2' => set_value('ket2'),
    //         'ket3' => set_value('ket3'),
    //         'created_by' => set_value('created_by'),
    //         'update_by' => set_value('update_by'),
    //         'created_at' => set_value('created_at'),
    //         'update_at' => set_value('update_at'),
    //         'isactive' => set_value('isactive'),
    //         'content' => 'backend/sync_capil/sync_capil_form',
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
    //             'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
    //             'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
    //             'alamat' => $this->input->post('alamat', TRUE),
    //             'desa' => $this->input->post('desa', TRUE),
    //             'kecamatan' => $this->input->post('kecamatan', TRUE),
    //             'ket1' => $this->input->post('ket1', TRUE),
    //             'ket2' => $this->input->post('ket2', TRUE),
    //             'ket3' => $this->input->post('ket3', TRUE),
    //             'created_by' => $this->session->userdata('username'),
    //             'update_by' => $this->input->post('update_by', TRUE),
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'update_at' => $this->input->post('update_at', TRUE),
    //             'isactive' => 1,
    //         );

    //         $this->Sync_capil_model->insert($data);
    //         $this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
    //         redirect(site_url('sync_capil'));
    //     }
    // }

    // public function update($id)
    // {
    //     sf_validate('U');
    //     $row = $this->Sync_capil_model->get_by_id($id);

    //     if ($row) {
    //         $data = array(
    //             'button' => 'Update',
    //             'action' => site_url('sync_capil/update_action'),
    //             'nik' => set_value('nik', $row->nik),
    //             'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
    //             'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
    //             'alamat' => set_value('alamat', $row->alamat),
    //             'desa' => set_value('desa', $row->desa),
    //             'kecamatan' => set_value('kecamatan', $row->kecamatan),
    //             'ket1' => set_value('ket1', $row->ket1),
    //             'ket2' => set_value('ket2', $row->ket2),
    //             'ket3' => set_value('ket3', $row->ket3),
    //             'created_by' => set_value('created_by', $row->created_by),
    //             'update_by' => set_value('update_by', $row->update_by),
    //             'created_at' => set_value('created_at', $row->created_at),
    //             'update_at' => set_value('update_at', $row->update_at),
    //             'isactive' => set_value('isactive', $row->isactive),
    //             'content' => 'backend/sync_capil/sync_capil_form',
    //         );
    //         $this->load->view(layout(), $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
    //         redirect(site_url('sync_capil'));
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
    //         $this->update($this->input->post('nik', TRUE));
    //     } else {
    //         $data = array(
    //             'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
    //             'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
    //             'alamat' => $this->input->post('alamat', TRUE),
    //             'desa' => $this->input->post('desa', TRUE),
    //             'kecamatan' => $this->input->post('kecamatan', TRUE),
    //             'ket1' => $this->input->post('ket1', TRUE),
    //             'ket2' => $this->input->post('ket2', TRUE),
    //             'ket3' => $this->input->post('ket3', TRUE),
    //             'created_by' => $this->input->post('created_by', TRUE),
    //             'update_by' => $this->input->post('update_by', TRUE),
    //             'created_at' => $this->input->post('created_at', TRUE),
    //             'update_at' => $this->input->post('update_at', TRUE),
    //             'isactive' => $this->input->post('isactive', TRUE),
    //         );

    //         $this->Sync_capil_model->update($this->input->post('nik', TRUE), $data);
    //         $this->session->set_flashdata('message', 'Edit data telah berhasil!');
    //         redirect(site_url('sync_capil'));
    //     }
    // }

    // public function delete($id)
    // {
    //     sf_validate('D');
    //     $row = $this->Sync_capil_model->get_by_id($id);

    //     if ($row) {
    //         /*$data = array(
    //             'isactive'=>0,
    //         );
    //         $this->Berita_model->update($id,$data);*/
    //         $this->Sync_capil_model->delete($id);
    //         $this->session->set_flashdata('message', 'Hapus data berhasil!');
    //         redirect(site_url('sync_capil'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
    //         redirect(site_url('sync_capil'));
    //     }
    // }

    // public function _rules()
    // {
    //     $this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
    //     $this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
    //     $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    //     $this->form_validation->set_rules('desa', 'desa', 'trim|required');
    //     $this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
    //     $this->form_validation->set_rules('ket1', 'ket1', 'trim|required');
    //     $this->form_validation->set_rules('ket2', 'ket2', 'trim|required');
    //     $this->form_validation->set_rules('ket3', 'ket3', 'trim|required');
    //     $this->form_validation->set_rules('created_by', 'created by', 'trim');
    //     $this->form_validation->set_rules('update_by', 'update by', 'trim|required');
    //     $this->form_validation->set_rules('created_at', 'created at', 'trim');
    //     $this->form_validation->set_rules('update_at', 'update at', 'trim|required');
    //     $this->form_validation->set_rules('isactive', 'isactive', 'trim');
    //     $this->form_validation->set_rules('nik', 'nik', 'trim');
    //     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    // }
}

/* End of file Sync_capil.php */
/* Location: ./application/controllers/Sync_capil.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-27 05:06:12 */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */