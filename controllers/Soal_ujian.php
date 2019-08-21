<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_ujian extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Soal_ujian_model');
        $this->load->helper(array('url','download'));	

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }
    }

    public function index(){
        $data['title'] = 'Daftar Soal Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }

        if($this->session->userdata('jabatan')=='Kajur'){
            
            $data['soal'] = $this->Soal_ujian_model->tampilSoal($semester,$tahun_ajaran);

            $this->load->model('Pegawai_model');
            $data['pegawai'] = $this->Pegawai_model->tampilAllPegawai();
           

            $data['cekk'] = $this->db->query("select id_pegawai from soal_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->result_array();
            $cekk =  $this->db->query("select id_pegawai from soal_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->result_array();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('soal_ujian/index2',$data);
            $this->load->view('templates/footer');
        }
        else{
            $data['soal'] = $this->Soal_ujian_model->tampilSoal2($semester,$tahun_ajaran,$this->session->userdata('id'));
            $data['notif'] = $this->Soal_ujian_model->get_notif();
            $notif = $this->Soal_ujian_model->get_notif();
            foreach($notif as $n){
                $makul = $n->makul;
            }
            $data['kelas'] = $this->Soal_ujian_model->get_notif_kelas();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('soal_ujian/index22',$data);
            $this->load->view('templates/footer');
        }

    }
    public function indexBackup(){
        $data['title'] = 'Daftar Soal Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');

        $semester = $this->input->post('semester',TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran',TRUE);

        $cek= $this->db->query("select * from soal_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->num_rows();

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('soal_ujian/index',$data);
            $this->load->view('templates/footer');
        }
        else{
            if($cek>0){
                if($this->session->userdata('jabatan')=='Kajur'){
                    $data['soal'] = $this->Soal_ujian_model->tampilSoal($semester,$tahun_ajaran);

                    $this->load->model('Pegawai_model');
                    $data['pegawai'] = $this->Pegawai_model->tampilAllPegawai();

                    $data['cekk'] = $this->db->query("select id_pegawai from soal_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->result_array();
                    $cekk =  $this->db->query("select id_pegawai from soal_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->result_array();

                    $this->load->view('templates/header',$data);
                    $this->load->view('templates/topbar',$data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('soal_ujian/index2',$data);
                    $this->load->view('templates/footer');
                }
                else{
                    $data['soal'] = $this->Soal_ujian_model->tampilSoal2($semester,$tahun_ajaran,$this->session->userdata('id'));
               
                    $this->load->view('templates/header',$data);
                    $this->load->view('templates/topbar',$data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('soal_ujian/index22',$data);
                    $this->load->view('templates/footer');
                }
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Data tidak ditemukan!</div>');

                    redirect('soal_ujian');
            } 
        }
    }

    public function lakukan_download($nama){				
		force_download('./assets/upload/'.$nama,NULL);
	}

    public function in_tambah(){
        $data['title'] = 'Add Soal Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();


        // $this->form_validation->set_rules('kelas[]', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required|trim');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|trim');
        $this->load->model('setting_model'); 
        $data['set'] = $this->setting_model->getSetting();
        $data['makul'] = $this->Soal_ujian_model->getMatkul();

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('soal_ujian/add_soal',$data);
			$this->load->view('templates/footer');
        }
        else{
            //  Cek jika ada pdf yang ingin di upload
            $upload_pdf = $_FILES['pdf']['name'];
			
			if($upload_pdf){
                $config['allowed_types'] = 'pdf';
                $config['allowed_types'] = 'docx';
                $config['upload_path'] = './assets/upload/';
                $config['max_size']     = '1024';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('pdf')){
                    $new_pdf = $this->upload->data('file_name');
                    $this->Soal_ujian_model->addData($new_pdf);
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal ditambahkan, file tidak sesuai ketentuan </div>');
                    redirect('soal_ujian/in_tambah');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal ditambahkan, file harus di upload! </div>');
                    redirect('soal_ujian/in_tambah');
			}
			
			 $this->session->set_flashdata('flash','Soal Ujian Berhasil Ditambahkan');
			 redirect('soal_ujian');
        }
    }

    public function edit($id){
        $data['title'] = 'Edit Soal Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();

        $data['pdf'] = $this->Soal_ujian_model->getById($id);
        $data['semester'] = array('Ganjil','Genap');

        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required|trim');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('soal_ujian/edit_soal');
			$this->load->view('templates/footer');
        }
        else{
            //  Cek jika ada pdf yang ingin di upload
            $upload_pdf = $_FILES['pdf']['name'];
			
			if($upload_pdf){
                $config['allowed_types'] = 'pdf';
                $config['upload_path'] = './assets/upload/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('pdf')){

                     // Ngecek pdf lama
                     $old_pdf = $data['pdf']['soal'];
                     if($old_pdf != ' '){
                         unlink(FCPATH .  'assets/upload/' . $old_pdf);
                     }
 
                     $new_pdf = $this->upload->data('file_name');
                     $this->Soal_ujian_model->ubahData($new_pdf);
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal diedit, file tidak sesuai ketentuan </div>');
                    redirect('soal_ujian/edit'.$id);
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal ditambahkan, file harus di upload! </div>');
                    redirect('soal_ujian/edit'.$id);
			}
			
			 $this->session->set_flashdata('flash','Soal Ujian Berhasil Diedit');
			 redirect('soal_ujian');
        }
    }

    public function hapus($id){
        $this->Soal_ujian_model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('soal_ujian');
    }
    public function get_kelas(){
        $id=$this->input->post('makul');
        $data=$this->Soal_ujian_model->get_kelas($id);
        echo json_encode($data);
    }

}