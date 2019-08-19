<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengampu extends CI_Controller
{

  private $filename;
  private $semester;
  private $tahun_ajaran;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengampu_model');
    $this->load->model('Setting_model');
    $this->load->model('kelas_model');
    $this->load->model('pegawai_model');
    $this->load->model('matkul_model');


    //validasi jika user belum login
    if ($this->session->userdata('nip') != TRUE) {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title'] = 'Daftar Pengampu';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();
    $this->getSet();
    // Nge get data dari database pegawai
    $data['pengampu'] = $this->Pengampu_model->tampilAll($this->semester, $this->tahun_ajaran);


    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('pengampu/index', $data);
    $this->load->view('templates/footer');
  }
  public function in_tambah()
  {
    $data['title'] = 'Import Pengampu';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();
    $this->getSet();
    // Nge get data dari database pegawai
    $data['pengampu'] = $this->Pengampu_model->tampilAll($this->semester, $this->tahun_ajaran);
    $data['set'] = $this->Setting_model->getSetting();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('pengampu/import', $data);
    $this->load->view('templates/footer');
  }
  public function add()
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $data['title'] = 'Tambah Pengampu';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    // ('nama input','alias','rules')
    $this->form_validation->set_rules('makul', 'Mata Kuliah', 'required');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');
    $this->form_validation->set_rules('pengampu', 'Pengampu', 'required');
    $data['makul'] = $this->matkul_model->tampilAllMatkul();
    $data['kelas'] = $this->kelas_model->tampilAllKode();    
    $data['pengampu'] = $this->pegawai_model->tampilAllPegawai();

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('pengampu/add_pengampu');
      $this->load->view('templates/footer');
    } else {
      $this->Pengampu_model->tambahData();

      // ('nama session', 'isinya apa')
      $this->session->set_flashdata('flash', 'Pengampu Berhasil Ditambahkan');
      redirect('pengampu');
    }
  }
  public function edit($id)
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $data['title'] = 'Edit Pengampu';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    // ('nama input','alias','rules')
    $this->form_validation->set_rules('makul', 'Mata Kuliah', 'required');
    $this->form_validation->set_rules('kelas', 'Kelas', 'required');
    $this->form_validation->set_rules('pengampu', 'Pengampu', 'required');
    $data['makul'] = $this->matkul_model->tampilAllMatkul();
    $data['kelas'] = $this->kelas_model->tampilAllKode();    
    $data['pengampu'] = $this->pegawai_model->tampilAllPegawai();
    $data['id_pengampu'] =  $this->Pengampu_model->getPengampuById($id);

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('pengampu/edit_pengampu');
      $this->load->view('templates/footer');
    } else {
      $this->Pengampu_model->editData();

      // ('nama session', 'isinya apa')
      $this->session->set_flashdata('flash', 'Pengampu Berhasil Diperbaharui');
      redirect('pengampu');
    }
  }
  public function hapusData($id){
    //Jika bukan kajur, maka tidak bisa ngapus
  if($this->session->userdata('jabatan') != 'Kajur'){
          redirect('pengampu');
  }

      $this->Pengampu_model->hapusData($id);
      $this->session->set_flashdata('flash','Berhasil dihapus');
      redirect('pengampu');
  }
  public function reset()
  {
    $this->getSet();
    $sql = "DELETE FROM pengampu where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'";
    $this->db->query($sql);
  }
  public function import()
  {
    error_reporting(E_ALL ^ E_NOTICE);

    include APPPATH . 'libraries/PHPExcel/PHPExcel.php';
    $this->getSet();

    $upload = $this->Pengampu_model->upload_file($this->filename);
    if ($upload['result'] == 'failed') {
      $data['upload_error'] = $upload['error'];
    }
    $this->reset();

    $csvreader = PHPExcel_IOFactory::createReader('CSV');
    $csvreader->setDelimiter(";");
    $loadcsv = $csvreader->load('assets/upload/csv/' . $this->filename . '.csv');
    $sheet = $loadcsv->getActiveSheet()->getRowIterator();

    $data = array();

    $numrow = 0;
    foreach ($sheet as $row) {
      if ($numrow > 0) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $get = array();
        foreach ($cellIterator as $cell) {
          array_push($get, $cell->getValue());
        }

        $makul = $get[1];
        $kelas = $get[2];
        $pengampu = $get[3];
        $kunci = $get[4];

        array_push($data, array(
          'makul' => $makul,
          'kelas' => $kelas,
          'pengampu' => $pengampu,
          'kunci' => $kunci,
          'semester' => $this->semester,
          'tahun_ajaran' => $this->tahun_ajaran,
        ));
      }

      $numrow++;
    }

    $this->Pengampu_model->insert_multiple($data);
    $this->session->set_flashdata('flash', 'Pengampu Berhasil ditambahkan');
    redirect("data_jurusan/pengampu");
  }
  public function export()
  {
    $this->getSet();

    include APPPATH . 'libraries/PHPExcel/PHPExcel.php';
    $csv = new PHPExcel();

    // $csv->getProperties()->setCreator('Sipet')
    //              ->setLastModifiedBy('Sipet')
    //              ->setTitle($this->filename)
    //              ->setSubject("Ruang Kelas")
    //              ->setDescription("Data Ruang Kelas")
    //              ->setKeywords("Ruang Kelas");

    $csv->setActiveSheetIndex(0)->setCellValue('A1', "ID");
    $csv->setActiveSheetIndex(0)->setCellValue('B1', "MAKUL");
    $csv->setActiveSheetIndex(0)->setCellValue('C1', "KELAS");
    $csv->setActiveSheetIndex(0)->setCellValue('D1', "PENGAMPU");
    $csv->setActiveSheetIndex(0)->setCellValue('E1', "KUNCI");
    $csv->setActiveSheetIndex(0)->setCellValue('F1', "SEMESTER");
    $csv->setActiveSheetIndex(0)->setCellValue('G1', "TAHUN AJARAN");

    $hasil = $this->Pengampu_model->tampilAll($this->semester, $this->tahun_ajaran);


    $no = 1;
    $numrow = 2;
    foreach ($hasil as $data) {
      $csv->setActiveSheetIndex()->setCellValue('A' . $numrow, $no);
      $csv->setActiveSheetIndex()->setCellValue('B' . $numrow, $data['makul']);
      $csv->setActiveSheetIndex()->setCellValue('C' . $numrow, $data['kelas']);
      $csv->setActiveSheetIndex()->setCellValue('D' . $numrow, $data['pengampu']);
      $csv->setActiveSheetIndex()->setCellValue('E' . $numrow, $data['kunci']);
      $csv->setActiveSheetIndex()->setCellValue('F' . $numrow, $data['semester']);
      $csv->setActiveSheetIndex()->setCellValue('G' . $numrow, $data['tahun_ajaran']);
      $no++;
      $numrow++;
    }

    $csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    $csv->getActiveSheet(0)->setTitle("Laporan Data Transaksi");
    $csv->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $this->filename . '.csv"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write = new PHPExcel_Writer_CSV($csv);
    $write->setDelimiter(";")->save('php://output');
  }
  public function getSet()
  {
    $this->load->model('setting_model');
    $set = $this->setting_model->getSetting();
    foreach ($set as $hasil) {
      $semester = $hasil->semester;
      $tahun_ajaran = $hasil->tahun_ajaran;
    }
    $tahun_ajaranNew = str_replace("/", "_", $tahun_ajaran);
    $this->filename = "pengampu_(" . $semester . "_" . $tahun_ajaranNew . ")";
    $this->tahun_ajaran = $tahun_ajaran;
    $this->semester = $semester;
    // $this->tahun_ajaran = $tahun_ajaran;
    // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);

  }
}
