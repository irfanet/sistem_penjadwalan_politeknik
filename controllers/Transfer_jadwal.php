<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transfer_jadwal extends CI_Controller
{
  private $filename = "import_data";
  public function __construct()
  {
    parent::__construct();

    $this->load->model('transfer_jadwal_model');
    $this->load->model('setting_model');
    $this->load->helper(array('url', 'download'));

    //validasi jika user belum login
    if ($this->session->userdata('nip') != TRUE) {
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title'] = 'Transfer Jadwal';

    $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();
    $data['jadwal'] = $this->transfer_jadwal_model->view();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('transfer_jadwal/index', $data);
    $this->load->view('templates/footer');
  }

  public function form()
  {

    if (isset($_POST['upload'])) {
      $this->getSet();
      $upload = $this->transfer_jadwal_model->upload_file($this->filename);

      if ($upload['result'] == "success") {
        echo 'berhasil';
        redirect('transfer_jadwal/import');
      } else {
        $data['upload_error'] = $upload['error'];
      }
    }
    $data['title'] = 'Upload Excel';
    $data['set'] = $this->setting_model->getSetting();

    $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();
    $data['jadwal'] = $this->transfer_jadwal_model->view();


    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('transfer_jadwal/form', $data);
    $this->load->view('templates/footer');
  }

  public function deleteData()
  {
    $set = $this->setting_model->getSetting();
    foreach($set as $hasil){
      $semester = $hasil->semester;
      $tahun_ajaran = $hasil->tahun_ajaran;
    }
    $sql = "DELETE FROM jadwal where semester='$semester' AND tahun_ajaran='$tahun_ajaran'";
    $this->db->query($sql);
  }


  public function masukanData($haritanggal, $jam, $makul, $pengawas, $kelas, $ruang, $kelompok)
  {
    $set = $this->setting_model->getSetting();
    foreach($set as $hasil){
      $semester = $hasil->semester;
      $tahun_ajaran = $hasil->tahun_ajaran;
    }
    // $sql = "DELETE * FROM a_jadwal";
    $sql = "INSERT INTO jadwal  VALUES (null,'$haritanggal','$jam', '" . strip_tags($makul) . "','$pengawas','$kelas','$ruang','$kelompok','$semester','$tahun_ajaran',null)";
    $this->db->query($sql);
  }
  public function import()
  {
    error_reporting(E_ALL ^ E_NOTICE);


    include APPPATH . 'libraries/excel_reader2.php';
    $this->deleteData();
    $this->getSet();
    // $data = new Spreadsheet_Excel_Reader('excel/'.$this->filename.'.xls');

    $data['title'] = 'Upload Excel';
    $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();
    
    $this->load->view('templates/header', $data);
    $this->load->view('templates/topbar', $data);
    
    $data = new Spreadsheet_Excel_Reader("assets/upload/excel/".$this->filename.'.xls');
    echo "<br><br><br>".$data->dump(true, true) . "<br>";
    $cariData = $data->dumpy(true, true);
    echo '<a href=' . base_url() . 'transfer_jadwal><< Back</a>';
    //$tandaLT=0;$tandaXLT=0;
    for ($row = 1; $row <= 21; $row++) {
      for ($col = 1; $col <= 62; $col++) {
        if ($row > 3) {
          $nilai = $cariData[$row][$col];
          if (substr($cariData[3][$col], 0, 2) != "MK") // jika kolom bukan kolom matakuliah					
            if ($cariData[$row][$col] != "kosong") {
              if ((substr($cariData[1][$col], 0, 2)) == "LT") // Listrik Reguler
              {
                $jmlKelasLT = 3;

                for ($i = 0; $i < 3; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaLT + $jmlKelasLT) + $i] != "kosong") {
                    //echo $tandaLT."-".$nilai.$cariData[$row][$col-($tandaLT+$jmlKelasLT)+$i]." | ";
                    //data
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaLT + $jmlKelasLT) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaLT + $jmlKelasLT) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    
                    // $rum = $col - ($tandaLT + $jmlKelasLT) + $i;
                    // echo $row.' - '.$col.' | '.$tandaLT.' - '.$i .' = '.$rum.' | ';

                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaLT += 1;
              } else if ((substr($cariData[1][$col], 0, 3)) == ".LT") // Listrik PLN
              {
                $jmlKelasXLT = 3;
                for ($i = 0; $i < 3; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaXLT + $jmlKelasXLT) + $i] != "kosong") {
                    //echo $tandaXLT."-".$nilai.$cariData[$row][$col-($tandaXLT+$jmlKelasXLT)+$i]." | ";
                    //data
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaXLT + $jmlKelasXLT) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 1, 2) . "-" . substr($cariData[2][$col - ($tandaXLT + $jmlKelasXLT) + $i], 0, 1) . substr($cariData[1][$col], 4, 6);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaXLT += 1;
              } else if ((substr($cariData[1][$col], 0, 2)) == "EK") // Elekktronika
              {
                $jmlKelasEK = 3;
                for ($i = 0; $i < 3; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaEK + $jmlKelasEK) + $i] != "kosong") {
                    //	echo $tandaEK."-".$nilai.$cariData[$row][$col-($tandaEK+$jmlKelasEK)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaEK + $jmlKelasEK) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaEK + $jmlKelasEK) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaEK += 1;
              } else if ((substr($cariData[1][$col], 0, 2)) == "TK") // Telkom D3
              {

                $jmlKelasTK = 3;
                for ($i = 0; $i < 3; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaTK + $jmlKelasTK) + $i] != "kosong") {
                    //echo $tandaTK."-".$nilai.$cariData[$row][$col-($tandaTK+$jmlKelasTK)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaTK + $jmlKelasTK) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaTK + $jmlKelasEK) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaTK += 1;
              } else if ((substr($cariData[1][$col], 0, 2)) == "TE") // Telkom D3
              {

                $jmlKelasTE = 4;
                for ($i = 0; $i < $jmlKelasTE; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaTE + $jmlKelasTE) + $i] != "kosong") {
                    //	echo $tandaTE."-".$nilai.$cariData[$row][$col-($tandaTE+$jmlKelasTE)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaTE + $jmlKelasTE) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaTE + $jmlKelasTE) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaTE += 1;
              } else if ((substr($cariData[1][$col], 0, 2)) == "IK" && $cariData[1][$col]!="IK-C") // Telkom D3
              {

                $jmlKelasIK = 3;
                for ($i = 0; $i < $jmlKelasIK; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaIK + $jmlKelasIK) + $i] != "kosong") {
                    //echo $tandaIK."-".$nilai.$cariData[$row][$col-($tandaIK+$jmlKelasIK)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaIK + $jmlKelasIK) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    // if ($cariData[1][$col - ($tandaIK + $jmlKelasIK) + $i] != "IK-1C") {
                      $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaIK + $jmlKelasIK) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                      //khusus kelas C hanya 1 kelas, dibagi 2 dan hanya butuh 2 pengawas
                      //if($i<2){

                        // $rum = $col - ($tandaIK + $jmlKelasIK) + $i;
                        // echo $row.' - '.$col.' | '.$tandaLT.' - '.$i .' = '.$rum.' | ';

                      $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                      echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                      //}

                    // } else {
                    //   $kelas = $cariData[1][$col - ($tandaIK + $jmlKelasIK) + $i];
                       
                    //     $rum = $col - ($tandaIK + $jmlKelasIK) + $i;
                    //     echo $row.' - '.$col.' | '.$tandaLT.' - '.$i .' = '.$rum;

                    //   $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    //   echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                    // }
                  }
                }
                $tandaIK += 1;
              } else if ((substr($cariData[1][$col], 0, 3)) == "MSU" || $cariData[1][$col]=="IK-C") // Telkom D3
              {

                $jmlKelasMSU = 3;
                
                for ($i = 0; $i < $jmlKelasMSU; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaMSU + $jmlKelasMSU) + $i] != "kosong") {
                    //echo $tandaMSU."-".$nilai.$cariData[$row][$col-($tandaMSU+$jmlKelasMSU)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    $jam = $cariData[$row][2];
                    $makul = $cariData[$row][$col - ($tandaMSU + $jmlKelasMSU) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 2) . "-" . substr($cariData[2][$col - ($tandaMSU + $jmlKelasMSU) + $i], 0, 2) . substr($cariData[1][$col], 3, 3);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa

                    // $rum = $col - ($tandaMSU + $jmlKelasMSU) + $i;
                    // echo 'MSU / IK-C => '.$row.' - '.$col.' | '.$tandaMSU.' - '.$i .' = '.$rum.' | ';

                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaMSU += 1;
              } 
              else if ((substr($cariData[1][$col], 0, 3)) == "MST") // Telkom D3
              {

                $jmlKelasMST = 2;
                for ($i = 0; $i < $jmlKelasMST; $i++) {
                  //mencari matakuliah yang diujikan
                  if ($cariData[$row][$col - ($tandaMST + $jmlKelasMST) + $i] != "kosong") {
                    //echo $tandaMST."-".$nilai.$cariData[$row][$col-($tandaMST+$jmlKelasMST)+$i]." | ";
                    $hariTanggal = $cariData[$row][1];
                    //$jam=$cariData[$row][2];
                    //jam MST sore tidak bisa memakai jam reguler
                    $jam = "16.30 - 18.00";
                    $makul = $cariData[$row][$col - ($tandaMST + $jmlKelasMST) + $i];
                    $pengawas = $cariData[$row][$col]; //atau $nilai
                    $kelas = substr($cariData[1][$col], 0, 3) . "-" . substr($cariData[2][$col - ($tandaMST + $jmlKelasMST) + $i], 0, 2) . substr($cariData[1][$col], 4, 1);
                    $ruang = $cariData[3][$col];
                    $kelompok = $cariData[2][$col];  //1 kelas dibagi 2 kelompok per 12 mahasiswa
                    $this->masukanData($hariTanggal, $jam, $makul, $pengawas, $kelas, $ruang, "$kelompok");
                    echo $hariTanggal . " | " . $jam . " | " . $makul . " | <b>" . $pengawas . "</b> | <b>" . $kelas . "</b> | " . $ruang . " | " . $kelompok . "<br>";
                  }
                }
                $tandaMST += 1;
              }
            } //akhir cek apakah pengawas kosong

        }
        //if($cariData[][])
        //

      }
      echo "<br>------------------------<br>";
      $tandaLT = 0;
      $tandaXLT = 0;
      $tandaEK = 0;
      $tandaTK = 0;
      $tandaTE = 0;
      $tandaIK = 0;
      $tandaMSU = 0;
      $tandaMST = 0;
    }
  }
  public function getSet()
  {
      $this->load->model('setting_model');
      $set = $this->setting_model->getSetting();
      foreach($set as $hasil){
        $semester = $hasil->semester;
        $tahun_ajaran = $hasil->tahun_ajaran;
      }
      $tahun_ajaranNew = str_replace("/", "_", $tahun_ajaran);
      $this->filename = "jadwal_(".$semester."_".$tahun_ajaranNew.")";
      $this->tahun_ajaran = $tahun_ajaran;
      $this->semester = $semester;
      // $this->tahun_ajaran = $tahun_ajaran;
      // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
  
  }
}
        
    /* End of file  transfer_jadwal.php */
