<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelas_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }

    }

	public function index()
	{
        $data['title'] = 'Daftar Kelas';
        $data['kelas'] = $this->Kelas_model->tampilAllKelas();

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/index');
		$this->load->view('templates/footer');
	}

	public function in_tambah(){
         //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $data['title'] = 'Tambah Kelas';
        
        $this->load->model('Prodi_model');
        $data['prodi'] = $this->Prodi_model->tampilAllProdi();

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();

        // ('nama input','alias','rules')
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('kelas/import');
			// $this->load->view('kelas/add_kelas');
			$this->load->view('templates/footer');
        }
        else{
            $this->Kelas_model->tambahData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Kelas Berhasil Ditambahkan');
            redirect('kelas');
        }
    }
    public function add(){
        //Jika bukan kajur, maka di redirect
       if($this->session->userdata('jabatan') == 'Dosen'){
           redirect('prodi');
       }

       $data['title'] = 'Tambah Kelas';
       
       $this->load->model('Prodi_model');
       $data['prodi'] = $this->Prodi_model->tampilAllProdi();

       $data['user'] = $this->db->get_where('pegawai', ['nip' =>
       $this->session->userdata('nip')])->row_array();

       // ('nama input','alias','rules')
       $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

       if($this->form_validation->run() == FALSE){
           $this->load->view('templates/header',$data);
           $this->load->view('templates/topbar',$data);
           $this->load->view('templates/sidebar');
        //    $this->load->view('kelas/import');
           $this->load->view('kelas/add_kelas');
           $this->load->view('templates/footer');
       }
       else{
           $this->Kelas_model->tambahData();

           // ('nama session', 'isinya apa')
           $this->session->set_flashdata('flash','Kelas Berhasil Ditambahkan');
           redirect('kelas');
       }
   }
    
    public function hapusData($id){
          //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $this->Kelas_model->hapusData($id);
        $this->session->set_flashdata('flash','Berhasil dihapus');
        redirect('kelas');
    }

    public function edit($id){
          //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('prodi');
		}

        $data['title'] = 'Edit Kelas';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
       
        $this->load->model('Prodi_model');
        $data['prodi'] = $this->Prodi_model->tampilAllProdi();

        $data['kelas'] = $this->Kelas_model->getKelasById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('kelas/edit_kelas',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->Kelas_model->editKelas($id);

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Kelas Berhasil Diubah');
            redirect('kelas');
        }
    }
    public function reset(){
        $this->getSet();
        $sql = "DELETE FROM kelas";
        $this->db->query($sql);
    }
    public function import(){
        error_reporting(E_ALL ^ E_NOTICE);

        include APPPATH.'libraries/PHPExcel/PHPExcel.php';
        $this->getSet();

        $upload = $this->Kelas_model->upload_file($this->filename);
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
           
            $nama = $get[1]; 
            $prodi = $get[2]; 
            $nama = str_replace(' ','',$nama);

            array_push($data, array(
                'nama_kelas'=>$nama, 
                'id_prodi'=>$prodi,
            ));
            }
                    
          $numrow++; 
        }
      
        $this->Kelas_model->insert_multiple($data);
        $this->session->set_flashdata('flash','Kelas Berhasil ditambahkan');
        redirect("data_jurusan/kelas");
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
        $csv->setActiveSheetIndex(0)->setCellValue('B1', "KELAS"); 
        $csv->setActiveSheetIndex(0)->setCellValue('C1', "KODE PRODI"); 
    
        $hasil= $this->Kelas_model->tampilAllKode();
      
    
        $no = 1; 
        $numrow = 2; 
        foreach($hasil as $data){ 
          $csv->setActiveSheetIndex()->setCellValue('A'.$numrow, $no);
          $csv->setActiveSheetIndex()->setCellValue('B'.$numrow, $data['nama_kelas']);
          $csv->setActiveSheetIndex()->setCellValue('C'.$numrow, $data['id_prodi']);
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
          $this->filename = "kelas_(".$semester."_".$tahun_ajaranNew.")";
          $this->tahun_ajaran = $tahun_ajaran;
          $this->semester = $semester;
          // $this->tahun_ajaran = $tahun_ajaran;
          // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
      
      }
}
