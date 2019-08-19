<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends CI_Controller {

    private $filename;
    private $semester;
    private $tahun_ajaran;
    public function __construct(){
        parent::__construct();
        $this->load->model('Matkul_model');
        $this->load->model('Setting_model');

         //validasi jika user belum login
         if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }
    }

	public function index()
	{
        $data['title'] = 'Daftar Mata Kuliah';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
        
        if($this->session->userdata('jabatan')=='Kaprodi' || $this->session->userdata('jabatan')=='Dosen'){
            $data['matkul'] = $this->Matkul_model->tampilMatkul($this->session->userdata('id_prodi'));
        }else{
            $data['matkul'] = $this->Matkul_model->tampilAllMatkul();
        }

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('matkul/index',$data);
		$this->load->view('templates/footer');
	}

	public function in_tambah(){
          //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $data['title'] = 'Tambah Mata Kuliah';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
        
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->tampilKelas();
        $data['set'] = $this->Setting_model->getSetting();

        // ('nama input','alias','rules')
        $this->form_validation->set_rules('nama', 'Nama Mata Kuliah', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('matkul/import',$data);
			// $this->load->view('matkul/add_matkul');
			$this->load->view('templates/footer');
        }
        else{
            $this->Matkul_model->tambahData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Mata Kuliah Berhasil Ditambahkan');
            redirect('matkul');
        }
    }
    public function add(){
        //Jika bukan kajur, maka di redirect
      if($this->session->userdata('jabatan') == 'Dosen'){
          redirect('prodi');
      }

      $data['title'] = 'Tambah Mata Kuliah';

      $data['user'] = $this->db->get_where('pegawai', ['nip' =>
      $this->session->userdata('nip')])->row_array();
      
      $this->load->model('Kelas_model');
      $data['kelas'] = $this->Kelas_model->tampilKelas();
      $data['set'] = $this->Setting_model->getSetting();

      // ('nama input','alias','rules')
      $this->form_validation->set_rules('nama', 'Nama Mata Kuliah', 'required');

      if($this->form_validation->run() == FALSE){
          $this->load->view('templates/header',$data);
          $this->load->view('templates/topbar',$data);
          $this->load->view('templates/sidebar');
        //   $this->load->view('matkul/import',$data);
          $this->load->view('matkul/add_matkul');
          $this->load->view('templates/footer');
      }
      else{
          $this->Matkul_model->tambahData();

          // ('nama session', 'isinya apa')
          $this->session->set_flashdata('flash','Mata Kuliah Berhasil Ditambahkan');
          redirect('matkul');
      }
  }
    
    public function hapus($id){
          //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $this->Matkul_model->hapusData($id);
        $this->session->set_flashdata('flash','Berhasil dihapus');
        redirect('matkul');
    }

    public function edit($id){
          //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $data['title'] = 'Edit Mata Kuliah';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
        
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->tampilKelas();

        $data['matkul1'] = ['1','0'];
        $data['matkul'] = $this->Matkul_model->getMatkulById($id);

        // ('nama input','alias','rules')
        $this->form_validation->set_rules('nama', 'Nama Mata Kuliah', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('matkul/edit_matkul',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->Matkul_model->editData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Mata Kuliah Berhasil Diubah');
            redirect('matkul');
        }
    }
    public function update(){
   
        // error_reporting(E_ALL ^ E_NOTICE);
        $ID_att = $this->input->post('ID_makul');
        $result = array();
        foreach($ID_att AS $key => $val){
            $result[] = array(
            "id" => $ID_att[$key],
            "status"  => $_POST['status'][$val]
            );
        }
        $test = $this->db->update_batch('matkul', $result, 'id');
        if($test){
            $this->session->set_flashdata('flash','Matkul Berhasil Ditambahkan');
            redirect('data_jurusan/matkul');    }
            else{
                print_r($result) ;   
            echo "gagal di input";
        }

    }
    public function reset(){
        $this->getSet();
        $sql = "DELETE FROM matkul where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'";
        $this->db->query($sql);
    }
    public function import(){
        error_reporting(E_ALL ^ E_NOTICE);

        include APPPATH.'libraries/PHPExcel/PHPExcel.php';
        $this->getSet();

        $upload = $this->Matkul_model->upload_file($this->filename);
        if($upload['result'] == 'failed'){ 
          $data['upload_error'] = $upload['error']; 
        }
        $this->reset();

        $csvreader = PHPExcel_IOFactory::createReader('CSV');
        $csvreader->setDelimiter(";");
        $loadcsv = $csvreader->load('assets/upload/csv/'.$this->filename.'.csv');
        $sheet = $loadcsv->getActiveSheet()->getRowIterator();
        
        $data = array();
        
        $numrow = 0;
        foreach($sheet as $row){
           if ($numrow>0){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); 
            
            $get = array(); 
            foreach ($cellIterator as $cell) {
              array_push($get, $cell->getValue()); 
            }
           
            $makul = $get[1]; 
            $prodi = $get[2]; 
            // $jenis_kelamin = $get[2]; 
            // $alamat = $get[3]; 

            array_push($data, array(
                'makul'=>$makul, 
                'prodi'=>$prodi,
                'semester'=>$this->semester, 
                'tahun_ajaran'=>$this->tahun_ajaran, 
            ));
            }
                    
          $numrow++; 
        }
      
        $this->Matkul_model->insert_multiple($data);
        $this->session->set_flashdata('flash','Mata Kuliah Berhasil ditambahkan');
        redirect("data_jurusan/matkul");
      }
      public function export(){
        $this->getSet();

        include APPPATH.'libraries/PHPExcel/PHPExcel.php';    
        $csv = new PHPExcel();
    
        // $csv->getProperties()->setCreator('Sipet')
        //              ->setLastModifiedBy('Sipet')
        //              ->setTitle($this->filename)
        //              ->setSubject("Ruang Kelas")
        //              ->setDescription("Data Ruang Kelas")
        //              ->setKeywords("Ruang Kelas");
    
        $csv->setActiveSheetIndex(0)->setCellValue('A1', "ID"); 
        $csv->setActiveSheetIndex(0)->setCellValue('B1', "MAKUL"); 
        $csv->setActiveSheetIndex(0)->setCellValue('C1', "PRODI"); 
        $csv->setActiveSheetIndex(0)->setCellValue('D1', "SEMESTER"); 
        $csv->setActiveSheetIndex(0)->setCellValue('E1', "TAHUN AJARAN"); 
        $csv->setActiveSheetIndex(0)->setCellValue('F1', "STATUS"); 
    
        if($this->session->userdata('jabatan')!='Dosen'){
            $hasil = $this->Matkul_model->tampilAllMatkul();
        }else{
            $hasil = $this->Matkul_model->tampilMatkul($this->session->userdata('id_prodi'));
        }
    
        $no = 1; 
        $numrow = 2; 
        foreach($hasil as $data){ 
          $csv->setActiveSheetIndex()->setCellValue('A'.$numrow, $no);
          $csv->setActiveSheetIndex()->setCellValue('B'.$numrow, $data['makul']);
          $csv->setActiveSheetIndex()->setCellValue('C'.$numrow, $data['prodi']);
          $csv->setActiveSheetIndex()->setCellValue('D'.$numrow, $data['semester']);
          $csv->setActiveSheetIndex()->setCellValue('E'.$numrow, $data['tahun_ajaran']);
          $csv->setActiveSheetIndex()->setCellValue('F'.$numrow, $data['status']);          
          $no++; 
          $numrow++; 
        }
    
        $csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    
        $csv->getActiveSheet(0)->setTitle("Laporan Data Transaksi");
        $csv->setActiveSheetIndex(0);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$this->filename.'.csv"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
    
        $write = new PHPExcel_Writer_CSV($csv);
        $write->setDelimiter(";")->save('php://output');
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
          $this->filename = "matkul_(".$semester."_".$tahun_ajaranNew.")";
          $this->tahun_ajaran = $tahun_ajaran;
          $this->semester = $semester;
          // $this->tahun_ajaran = $tahun_ajaran;
          // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
      
      }
}
