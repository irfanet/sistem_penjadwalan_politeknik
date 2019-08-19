<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_kelas extends CI_Controller
{

  private $filename;
  private $semester;
  private $tahun_ajaran;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ruang_kelas_model');

    //validasi jika user belum login
    if ($this->session->userdata('nip') != TRUE) {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title'] = 'Daftar Ruang Kelas';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    $data['ruang_kelas'] = $this->Ruang_kelas_model->tampilAll();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('ruang_kelas/index', $data);
    $this->load->view('templates/footer');
  }

  public function in_tambah()
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $data['title'] = 'Tambah Ruang Kelas';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    // ('nama input','alias','rules')
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('kelompok', 'Kelompok', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('ruang_kelas/import');
      // $this->load->view('ruang_kelas/add_ruang_kelas');
      $this->load->view('templates/footer');
    } else {
      $this->Ruang_kelas_model->tambahData();

      // ('nama session', 'isinya apa')
      $this->session->set_flashdata('flash', 'Ruang Kelas Berhasil Ditambahkan');
      redirect('ruang_kelas');
    }
  }
  public function add()
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $data['title'] = 'Tambah Ruang Kelas';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    // ('nama input','alias','rules')
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('kelompok', 'Kelompok', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar');
      // $this->load->view('ruang_kelas/import');
      $this->load->view('ruang_kelas/add_ruang_kelas');
      $this->load->view('templates/footer');
    } else {
      $this->Ruang_kelas_model->tambahData();

      // ('nama session', 'isinya apa')
      $this->session->set_flashdata('flash', 'Ruang Kelas Berhasil Ditambahkan');
      redirect('ruang_kelas');
    }
  }


  public function hapus($id)
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $this->Ruang_kelas_model->hapusData($id);
    $this->session->set_flashdata('flash', 'Berhasil dihapus');
    redirect('ruang_kelas');
  }

  public function edit($id)
  {
    //Jika bukan kajur, maka di redirect
    if ($this->session->userdata('jabatan') != 'Kajur') {
      redirect('prodi');
    }

    $data['title'] = 'Edit Ruang Kelas';

    $data['user'] = $this->db->get_where('pegawai', ['nip' =>
    $this->session->userdata('nip')])->row_array();

    // ('nama input','alias','rules')
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('kelompok', 'Kelompok', 'required|trim');


    $data['ruang_kelas'] = $this->Ruang_kelas_model->getdataById($id);

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('ruang_kelas/edit_ruang_kelas', $data);
      $this->load->view('templates/footer');
    } else {
      $this->Ruang_kelas_model->editData();

      // ('nama session', 'isinya apa')
      $this->session->set_flashdata('flash', 'Ruang Kelas Berhasil Diedit');
      redirect('ruang_kelas');
    }
  }
  public function reset()
  {
    $this->getSet();
    $sql = "DELETE FROM ruang_kelas";
    $this->db->query($sql);
  }
  public function import()
  {
    error_reporting(E_ALL ^ E_NOTICE);

    include APPPATH . 'libraries/PHPExcel/PHPExcel.php';
    $this->getSet();
    $upload = $this->Ruang_kelas_model->upload_file($this->filename);
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

        $nama = $get[1];
        $kelompok = $get[2];

        array_push($data, array(
          'nama' => $nama,
          'kelompok' => $kelompok,
        ));
      }

      $numrow++;
    }

    $this->Ruang_kelas_model->insert_multiple($data);
    $this->session->set_flashdata('flash', 'Ruang Kelas Berhasil ditambahkan');
    redirect("data_jurusan/ruang_kelas");
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
    $csv->setActiveSheetIndex(0)->setCellValue('B1', "NAMA");
    $csv->setActiveSheetIndex(0)->setCellValue('C1', "KELOMPOK");
    // $csv->setActiveSheetIndex(0)->setCellValue('D1', "JENIS KELAMIN"); 
    // $csv->setActiveSheetIndex(0)->setCellValue('E1', "ALAMAT"); 

    $hasil = $this->Ruang_kelas_model->tampilAll();

    $no = 1;
    $numrow = 2;
    foreach ($hasil as $data) {
      $csv->setActiveSheetIndex()->setCellValue('A' . $numrow, $no);
      $csv->setActiveSheetIndex()->setCellValue('B' . $numrow, $data['nama']);
      $csv->setActiveSheetIndex()->setCellValue('C' . $numrow, $data['kelompok']);
      // $csv->setActiveSheetIndex()->setCellValue('D'.$numrow, $data->jenis_kelamin);
      // $csv->setActiveSheetIndex()->setCellValue('E'.$numrow, $data->alamat);

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
    $this->filename = "ruang_kelas_(" . $semester . "_" . $tahun_ajaranNew . ")";
    // $this->tahun_ajaran = $tahun_ajaran;
    // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);

  }
}
