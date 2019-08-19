<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Pegawai_model');

         //validasi jika user belum login
         if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }

    }

	public function index()
	{
        $data['title'] = 'Daftar Pegawai';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();

        // Nge get data dari database pegawai
        $data['pegawai'] = $this->Pegawai_model->tampilAllPegawai();
        $data['panitia'] = $this->Pegawai_model->tampilPegawai();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('pegawai/index',$data);
		$this->load->view('templates/footer');
	}

	public function in_tambah(){
        //Jika bukan kajur, maka tidak bisa nambah
		if($this->session->userdata('jabatan') != 'Kajur'){
            redirect('pegawai');
		}

        $data['title'] = 'Tambah Pegawai';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
        
        
        $this->load->model('Prodi_model');
        $data['prodi'] = $this->Prodi_model->tampilAllProdi();

        // FORM VALIDATION
        // ('nama input','alias','rules')
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[pegawai.nip]',[
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('nama_singkat', 'Nama Singkat', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',[
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if($this->input->post('jabatan')=="Dosen" || $this->input->post('jabatan')=="Kaprodi"){
            $this->form_validation->set_rules('prodi', 'Program Studi', 'required|trim');
        }
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[pegawai.email]',[
            'is_unique' => 'This email has already registered!'
        ]);

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
            // $this->load->view('pegawai/add_pegawai',$data);
            $this->load->view('pegawai/import',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->Pegawai_model->tambahData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Pegawai Berhasil Ditambahkan');
            redirect('pegawai');
        }
    }

    public function add(){
        //Jika bukan kajur, maka tidak bisa nambah
		if($this->session->userdata('jabatan') != 'Kajur'){
            redirect('pegawai');
		}

        $data['title'] = 'Tambah Pegawai';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
        
        
        $this->load->model('Prodi_model');
        $data['prodi'] = $this->Prodi_model->tampilAllProdi();

        // FORM VALIDATION
        // ('nama input','alias','rules')
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[pegawai.nip]',[
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('nama_singkat', 'Nama Singkat', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',[
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if($this->input->post('jabatan')=="Dosen" || $this->input->post('jabatan')=="Kaprodi"){
            $this->form_validation->set_rules('prodi', 'Program Studi', 'required|trim');
        }
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[pegawai.email]',[
            'is_unique' => 'This email has already registered!'
        ]);

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
            $this->load->view('pegawai/add_pegawai',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->Pegawai_model->tambahData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Pegawai Berhasil Ditambahkan');
            redirect('pegawai');
        }
    }

    
    public function hapusData($id){
        //Jika bukan kajur, maka tidak bisa ngapus
		if($this->session->userdata('jabatan') != 'Kajur'){
            redirect('pegawai');
		}

        $this->Pegawai_model->hapusData($id);
        $this->session->set_flashdata('flash','Berhasil dihapus');
        redirect('pegawai');
    }

    public function edit($id){
        //Jika bukan kajur, maka tidak bisa edit
		if($this->session->userdata('jabatan') != 'Kajur'){
            redirect('pegawai');
		}

        $data['title'] = 'Edit Pegawai';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();
       
        $data['status'] = ['1','0'];
        $data['jabatan'] = ['Kaprodi','Dosen','Panitia','Petugas'];
        $data['pegawai'] = $this->Pegawai_model->getPegawaiById($id);

        $this->load->model('Prodi_model');
        $data['prodi'] = $this->Prodi_model->tampilAllProdi();

        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('pegawai/edit_pegawai',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->Pegawai_model->editPegawai($id);

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Pegawai Berhasil Diubah');
            redirect('pegawai');
        }
    }
    public function reset(){
        $sql = "DELETE FROM pegawai";
        $this->db->query($sql);
    }
    public function import(){
        error_reporting(E_ALL ^ E_NOTICE);

        include APPPATH.'libraries/PHPExcel/PHPExcel.php';
        $this->getSet();

        $upload = $this->Pegawai_model->upload_file($this->filename);
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
           
            // $makul = $get[1]; 
            // $prodi = $get[2]; 

            array_push($data, array(
                'nip'=>$get[1], 
                'nama_singkat'=>$get[2],
                'nama_lengkap'=>$get[3], 
                'jabatan'=>$get[4],
                'golongan'=>$get[5],
                'id_prodi'=>$get[6],
                'email'=>$get[7], 
                'password'=>$get[8],
                'is_active'=>$get[9],
 
            ));
            }
                    
          $numrow++; 
        }
      
        $this->Pegawai_model->insert_multiple($data);
        $this->session->set_flashdata('flash','Pegawai Berhasil ditambahkan');
        redirect("data_jurusan/pegawai");
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
        $csv->setActiveSheetIndex(0)->setCellValue('B1', "NIP"); 
        $csv->setActiveSheetIndex(0)->setCellValue('C1', "NAMA SINGKAT"); 
        $csv->setActiveSheetIndex(0)->setCellValue('D1', "NAMA LENGKAP"); 
        $csv->setActiveSheetIndex(0)->setCellValue('E1', "JABATAN"); 
        $csv->setActiveSheetIndex(0)->setCellValue('F1', "GOLONGAN"); 
        $csv->setActiveSheetIndex(0)->setCellValue('G1', "PRODI");
        $csv->setActiveSheetIndex(0)->setCellValue('H1', "EMAIL");
        $csv->setActiveSheetIndex(0)->setCellValue('I1', "PASSWORD");
        $csv->setActiveSheetIndex(0)->setCellValue('J1', "IS AKTIF"); 
    
        $hasil = $this->Pegawai_model->tampilAll();
    
        $no = 1; 
        $numrow = 2; 
        foreach($hasil as $data){ 
          $csv->setActiveSheetIndex()->setCellValue('A'.$numrow, $no);
          $csv->setActiveSheetIndex()->setCellValue('B'.$numrow, $data['nip']);
          $csv->setActiveSheetIndex()->setCellValue('C'.$numrow, $data['nama_singkat']);
          $csv->setActiveSheetIndex()->setCellValue('D'.$numrow, $data['nama_lengkap']);
          $csv->setActiveSheetIndex()->setCellValue('E'.$numrow, $data['jabatan']);
          $csv->setActiveSheetIndex()->setCellValue('F'.$numrow, $data['golongan']); 
          $csv->setActiveSheetIndex()->setCellValue('G'.$numrow, $data['id_prodi']);          
          $csv->setActiveSheetIndex()->setCellValue('H'.$numrow, $data['email']);          
          $csv->setActiveSheetIndex()->setCellValue('I'.$numrow, $data['password']);          
          $csv->setActiveSheetIndex()->setCellValue('J'.$numrow, $data['is_active']);          
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
          $this->filename = "pegawai_(".$semester."_".$tahun_ajaranNew.")";
          $this->tahun_ajaran = $tahun_ajaran;
          $this->semester = $semester;
          // $this->tahun_ajaran = $tahun_ajaran;
          // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
      
      }
}
