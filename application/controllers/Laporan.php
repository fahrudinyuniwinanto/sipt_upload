<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Data_kpcpen_model');
        $this->load->model('Sync_capil_model');
        $this->load->model('Sy_menu_model');
        $this->load->model('Kecamatan_model');
        // is_logged();
    }

    
    public function index()
    {
        //jika error agregat di MYSQL versi baru jalankan ini: SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
        $q = array(
            'qnama'=>urldecode($this->input->get('qnama', TRUE)),
            'qfakses'=>urldecode($this->input->get('qfakses', TRUE)),
            'qkec'=>urldecode($this->input->get('qkec', TRUE)),
            'qdesa'=>urldecode($this->input->get('qdesa', TRUE)),
            'qisvaksin'=>urldecode($this->input->get('qisvaksin', TRUE)),
        );
        $start = intval($this->input->get('start'));
        
        if (isset($q)) {
            $config['base_url'] = base_url() . 'laporan/index.html?qnama=' . urlencode(@$q['qnama']) . '&qkec=' . urlencode(@$q['qkec']) . '&qdesa=' . urlencode(@$q['qdesa']) . '&&qisvaksin=' . urlencode(@$q['qisvaksin']). '&&qfaskes=' . urlencode(@$q['qfaskes']);
            $config['first_url'] = base_url() . 'laporan/index.html?qnama=' . urlencode(@$q['qnama']) . '&qkec=' . urlencode(@$q['qkec']) . '&qdesa=' . urlencode(@$q['qdesa']) . '&qisvaksin=' . urlencode(@$q['qisvaksin']). '&&qfaskes=' . urlencode(@$q['qfaskes']);
        } else {
        $config['base_url'] = base_url() . 'laporan/index.html';
        $config['first_url'] = base_url() . 'laporan/index.html';
        }
        
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sync_capil_model->total_rows_laporan($q);
        $sync_capil = $this->Sync_capil_model->get_limit_data_laporan($config['per_page'], $start, $q);
        // die($this->db->last_query());
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $kec=$this->db->distinct()->select('kecamatan')->get('sync_capil')->result();
        $faskes=$this->db->distinct()->select('faskes')->get('data_kpcpen')->result();
        $datakec[""]=">> Semua Kecamatan";
        $datafaskes[""]=">> Semua Faskes";
        foreach ($kec as $k => $v) {
            $datakec[$v->kecamatan]=$v->kecamatan;
        }
        foreach ($faskes as $k => $v2) {
            $datafaskes[$v2->faskes]=$v2->faskes;
        }
        $data = array(
            'sync_capil_data' => $sync_capil,
            'datakec'=>$datakec,
            'datafaskes'=>$datafaskes,
            'q' => $q,
            'start' => $start,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'content' => 'backend/laporan/dashboard_laporan',
        );
        $this->load->view(layout(), $data);
    }

    
    public function read($nik)
    {
        // sf_validate('R');
        $row = $this->db->get_where("sync_capil",['nik'=>$nik])->row();
        // print_r($row);die("asdf");
        $data_vaksin = $this->db->order_by('tanggal','asc')->get_where('data_kpcpen', array('nik' => $nik))->result();
        if ($row) {
            $data = array(
                'nama_lengkap' => $row->nama_lengkap,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tgl_lahir' => $row->tgl_lahir,
                'alamat' => $row->alamat,
                'data_vaksin' => $data_vaksin,
                'content' => 'backend/laporan/laporan_read',
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('laporan'));
        }
    }


    public function setKec($qkec){
        $datads = $this->db->query("select distinct desa from sync_capil where kecamatan='".$qkec."'")->result();
        $x = "<option value=''>>> Pilih</option>";
        foreach ($datads as $k => $v) {
        $x.="<option value='".$v->desa."'>".$v->desa."</option>";
        }
        echo $x;

    }

    public function isVaksin(){
        $isvaksin = $this->db->query("select bb.*,aa.* from sync_capil aa 
        left join data_kpcpen bb on aa.nik=bb.nik order by bb.id asc ")->row();

        
        $this->load->view('backend/laporan/dashboard_laporan', $isvaksin);
        

    }

    

    public function excel()
    {
        // sf_validate('E');
        $this->load->helper('exportexcel');
        $namaFile = "vaksinasi_".date('ymdhis').".xls";
        $judul = "Vaksinasi ".date("Y-m-d H:i:s");
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
        xlsWriteLabel($tablehead, $kolomhead++, "NO");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "NAMA");
        xlsWriteLabel($tablehead, $kolomhead++, "JK");
        xlsWriteLabel($tablehead, $kolomhead++, "KECAMATAN");
        xlsWriteLabel($tablehead, $kolomhead++, "DESA");
        xlsWriteLabel($tablehead, $kolomhead++, "JENIS");
        xlsWriteLabel($tablehead, $kolomhead++, "VAKSINASI");
        xlsWriteLabel($tablehead, $kolomhead++, "FASKES");

        $q = array(
            'qnik'=>urldecode($this->input->get('qnik', TRUE)),
            'qnama'=>urldecode($this->input->get('qnama', TRUE)),
            'qkec'=>urldecode($this->input->get('qkec', TRUE)),
            'qdesa'=>urldecode($this->input->get('qdesa', TRUE)),
            'qisvaksin'=>urldecode($this->input->get('qisvaksin', TRUE)),
        );

        foreach ($this->Sync_capil_model->get_limit_data_laporan(100000, 0, $q) as $v) {
            $kcp=@$this->db->select("*,group_concat(vaksinasi) as vaksinasi")->order_by("tanggal","ASC")->get_where('data_kpcpen',['nik'=>$v->nik])->row();
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $v->nik);
            xlsWriteLabel($tablebody, $kolombody++, $v->nama_lengkap);
            xlsWriteLabel($tablebody, $kolombody++, $v->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $v->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $v->desa);
            xlsWriteLabel($tablebody, $kolombody++, @$kcp->jenis_vaksin);
            xlsWriteLabel($tablebody, $kolombody++, @$kcp->vaksinasi);
            xlsWriteLabel($tablebody, $kolombody++, @$kcp->faskes);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
