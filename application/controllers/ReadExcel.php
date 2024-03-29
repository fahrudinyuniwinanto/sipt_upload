<?php
require FCPATH . 'application/third_party/vendor/autoload.php';
// echo BASEPATH.'third_party/vendor/autoload.php';die();
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReadExcel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library(array('PHPExcel','session'));
    }

    public function index()
    {
        //$this->load->view(layout(),'backend/phpexcel.php');
    }

    public function importKpc()
    {
        $reader           = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet      = $reader->load($_FILES['filekpc']['tmp_name']);
        $d                = $spreadsheet->getSheet(0)->toArray();
        $data             = $spreadsheet->getActiveSheet()->toArray();
        $jmlDataTerinsert = 0;

        $i = 1;
        unset($data[0]); //remove header

        foreach ($data as $k => $v) {
            $query = $this->db->get_where('data_kpcpen', array('nik' => str_replace("'", "", $v[4]), 'vaksinasi' => $v[10]))->num_rows();

            if ($query == 0) {
                $this->db->insert('data_kpcpen', [
                    'nama'          => $v[5],
                    'nik'           => str_replace("'", "", $v[4]),
                    'jenis_kelamin' => $v[6],
                    'tiket_vaksin'  => $v[11],
                    'faskes'        => $v[6],
                    'kelompok_usia' => $v[7],
                    'kategori'      => $v[8],
                    'sub_kategori'  => $v[9],
                    'vaksinasi'     => $v[10],
                    'jenis_vaksin'  => $v[12],
                    'kab'           => $v[2],
                    'prov'          => $v[1],
                    'tanggal'       => $v[0],
                    'created_at'    => date("Y-m-d H:i:s"),
                    'created_by'    => $this->session->userdata('id_user'),
                    'isactive'      => 1,
                ]);
                $jmlDataTerinsert++;
            }
        }
        $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $jmlDataTerinsert . ' data KPCPEN</strong> berhasil diimport ke sql!');
        redirect($_SERVER['HTTP_REFERER']); //redirect back
    }

    public function importNilai()
    {
        $thn = $_POST['tahun'];
        $bln = $_POST['bulan'];
        if (strlen($bln) == 1) {
            $bln = "0" . $bln;
        }
        if ($thn == "" || $bln == "") {
            $this->session->set_flashdata('message', "<i class=' fa fa-warning'></i> Mohon pilih tahun dan bulan terlebih dahulu");
            redirect($_SERVER['HTTP_REFERER']); //redirect back
        } else if ($thn . $bln == date('Ym')) {
            //boleh upload
        } else if ($thn == date('Y') && $bln == date('m', strtotime('-1 month')) && in_array(date('d'), [01, 02, 03, 04, 05, 06])) {
            // boleh uplaad
        } else {
            // $this->session->set_flashdata('message', "<i class=' fa fa-warning'></i> Maaf file excel yang diupload harus data bulan <strong>" . date('F Y') . "</strong>, atau tanggal <strong>1 s/d 6 " . date('F Y', strtotime('-1 month')) . "</strong>");
            // redirect($_SERVER['HTTP_REFERER']); //redirect back
        }
        $prog = substr($this->session->userdata('id_program'), 0, 1);
        // $tbl = $prog=="I"?"tbnilaidata_ibu":($prog=="A"?"tbnilaidata_anak":($prog=="G"?"tbnilaidata_gizi":""));
        $tbl = getTableProgram($prog);
        if ($this->input->post('tahun') == "" || $this->input->post('bulan') == "" || $this->input->post('desa') == "") {
            $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> Tahun, bulan dan desa wajib diisi!');
            redirect($_SERVER['HTTP_REFERER']); //redirect back
        }
        $reader           = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet      = $reader->load($_FILES['filenilai']['tmp_name']);
        $d                = $spreadsheet->getSheet(0)->toArray();
        $data             = $spreadsheet->getActiveSheet()->toArray();
        $jmlDataTerinsert = 0;

        // $i = 1;
        // for ($i=0; $i <3 ; $i++) {
        //   unset($data[$i]); //remove header
        // }

        unset($data[0]);
        foreach ($data as $k => $v) {
            if ($v[4] == "" || $v[4] == null) {
                // die("asdfkljasdf".$k);
                continue;
            }
            $hasit = $this->db->get_where($tbl, [
                'TAHUN'      => $this->input->post('tahun'),
                'BULAN'      => $this->input->post('bulan'),
                'PUSKESMAS'  => $this->session->userdata('id_puskesmas'), //ambil dari session pelogin
                'DESA'       => $this->input->post('desa'),
                'KODE'       => $v[4],
                'SUMBERDATA' => $this->session->userdata('id_program'),
            ])->row();

            if (isset($hasit)) {
                // print_r($hasit);die("asdfasdfasdadsf");
                $this->db->where('ID', $hasit->ID);
                $this->db->update($tbl, [
                    'NILAI'     => $v[3],
                    'TGL_ENTRY' => date('Y-m-d H:i:s'),
                ]);
                continue; //skip loopingan
            }

            $this->db->insert($tbl, [
                'NILAI'      => $v[3],
                'SUMBERDATA' => $this->session->userdata('id_program'),
                'TAHUN'      => $this->input->post('tahun'),
                'BULAN'      => $this->input->post('bulan'),
                'PUSKESMAS'  => $this->session->userdata('id_puskesmas'), //ambil dari sesion pelogin
                'DESA'       => $this->input->post('desa'),
                'KODE'       => $v[4],
                'TGL_ENTRY'  => date('Y-m-d H:i:s'),
            ]);
            $jmlDataTerinsert++;
        }
        $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $jmlDataTerinsert . ' data </strong> berhasil diimport ke tabel ' . $tbl . '!');
        redirect($_SERVER['HTTP_REFERER']); //redirect back
    }

    public function importKependudukan()
    {
        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($_FILES['filekependudukan']['tmp_name']);
        $d           = $spreadsheet->getSheet(0)->toArray();
        $data        = $spreadsheet->getActiveSheet()->toArray();
        $i           = 1;
        unset($data[0]); //remove header

        foreach ($data as $k => $v) {
            $this->db->insert('sync_capil', [
                'nik'           => str_replace("'", "", $v[0]),
                'nama_lengkap'  => $v[1],
                'jenis_kelamin' => $v[2],
                'tempat_lahir'  => $v[3],
                'tgl_lahir'     => $v[4],
                'alamat'        => $v[5],
                'rw'            => $v[6],
                'rt'            => $v[7],
                'kecamatan'     => $v[8],
                'desa'          => $v[9],
                'created_at'    => date("Y-m-d H:i:s"),
                'created_by'    => $this->session->userdata('id_user'),
                'isactive'      => 1,
            ]);
        }
        $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . intval(count($d) - 1) . ' data kependudukan</strong> berhasil diimport ke sql!');
        redirect($_SERVER['HTTP_REFERER']); //redirect back
    }

    public function importDataBermasalah()
    {
        $reader      = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($_FILES['fileDataBermasalah']['tmp_name']);
        $d           = $spreadsheet->getSheet(0)->toArray();
        $data        = $spreadsheet->getActiveSheet()->toArray();
        $i           = 0;
        unset($data[0]); //remove header

        foreach ($data as $k => $v) {
            $this->db->insert('data_bermasalah', [
                'nama'                  => $v[0],
                'nik'                   => str_replace("'", "", $v[1]),
                'alamat'                => $v[2],
                'permasalahan'          => $v[3],
                'faskes'                => $v[4],
                'keterangan'            => $v[5],
                'sinkronisasi_dukcapil' => $v[6],
                'perubahan_nik'         => $v[7],
                'no_hp'                 => $v[8],
                'created_at'            => date("Y-m-d H:i:s"),
                'created_by'            => $this->session->userdata('id_user'),
            ]);
            $i++;
        }
        $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $i . ' data kependudukan</strong> berhasil diimport ke sql!');
        redirect($_SERVER['HTTP_REFERER']); //redirect back
    }
}
