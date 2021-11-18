<?php
require FCPATH . 'application/third_party/vendor/autoload.php';
// echo BASEPATH.'third_party/vendor/autoload.php';die();
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($_FILES['filekpc']['tmp_name']);
    $d = $spreadsheet->getSheet(0)->toArray();
    $data = $spreadsheet->getActiveSheet()->toArray();
    $jmlDataTerinsert = 0;

    $i = 1;
    unset($data[0]); //remove header

    foreach ($data as $k => $v) {
      $query = $this->db->get_where('data_kpcpen', array('nik' => str_replace("'", "", $v[4]), 'vaksinasi' => $v[10]))->num_rows();

      if ($query == 0) {
        $this->db->insert('data_kpcpen', [
          'nama' => $v[5],
          'nik' => str_replace("'", "", $v[4]),
          'jenis_kelamin' => $v[6],
          'tiket_vaksin' => $v[11],
          'faskes' => $v[6],
          'kelompok_usia' => $v[7],
          'kategori' => $v[8],
          'sub_kategori' => $v[9],
          'vaksinasi' => $v[10],
          'jenis_vaksin' => $v[12],
          'kab' => $v[2],
          'prov' => $v[1],
          'tanggal' => $v[0],
          'created_at' => date("Y-m-d H:i:s"),
          'created_by' => $this->session->userdata('id_user'),
          'isactive' => 1,
        ]);
        $jmlDataTerinsert++;
      }
    }
    $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $jmlDataTerinsert . ' data KPCPEN</strong> berhasil diimport ke sql!');
    redirect($_SERVER['HTTP_REFERER']); //redirect back
  }

  public function importKependudukan()
  {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($_FILES['filekependudukan']['tmp_name']);
    $d = $spreadsheet->getSheet(0)->toArray();
    $data = $spreadsheet->getActiveSheet()->toArray();
    $i = 1;
    unset($data[0]); //remove header

    foreach ($data as $k => $v) {
      $this->db->insert('sync_capil', [
        'nik' => str_replace("'", "", $v[0]),
        'nama_lengkap' => $v[1],
        'jenis_kelamin' => $v[2],
        'tempat_lahir' => $v[3],
        'tgl_lahir' => $v[4],
        'alamat' => $v[5],
        'rw' => $v[6],
        'rt' => $v[7],
        'kecamatan' => $v[8],
        'desa' => $v[9],
        'created_at' => date("Y-m-d H:i:s"),
        'created_by' => $this->session->userdata('id_user'),
        'isactive' => 1,
      ]);
    }
    $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . count($d)-1 . ' data kependudukan</strong> berhasil diimport ke sql!');
    redirect($_SERVER['HTTP_REFERER']); //redirect back
  }

  public function importDataBermasalah()
  {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($_FILES['fileDataBermasalah']['tmp_name']);
    $d = $spreadsheet->getSheet(0)->toArray();
    $data = $spreadsheet->getActiveSheet()->toArray();
    $i = 0;
    unset($data[0]); //remove header

    foreach ($data as $k => $v) {
      $this->db->insert('data_bermasalah', [
        'nama' => $v[0],
        'nik' => str_replace("'", "", $v[1]),
        'alamat' => $v[2],
        'permasalahan' => $v[3],
        'faskes' => $v[4],
        'keterangan' => $v[5],
        'sinkronisasi_dukcapil' => $v[6],
        'perubahan_nik' => $v[7],
        'no_hp' => $v[8],
        'created_at' => date("Y-m-d H:i:s"),
        'created_by' => $this->session->userdata('id_user'),
      ]);
      $i++;
    }
    $this->session->set_flashdata('message', '<i class=" fa fa-check-circle"></i> <strong>' . $i. ' data kependudukan</strong> berhasil diimport ke sql!');
    redirect($_SERVER['HTTP_REFERER']); //redirect back
  }
}
