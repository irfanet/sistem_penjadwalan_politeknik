<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggandaan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Soal_ujian_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }
        if($this->session->userdata('jabatan') != "Petugas"){
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

        $data['soal'] = $this->Soal_ujian_model->tampilSoal($semester,$tahun_ajaran);
        $data['penggandaan'] = $this->Soal_ujian_model->tampilSoalPenggandaan($semester,$tahun_ajaran);

        // $data['belumUpload'] = $this->Soal_ujian_model->getNotUploadedYet()->result_array();
        // $data['jmlBelumUpload'] = $this->Soal_ujian_model->getNotUploadedYet()->num_rows();

        // $data['jmlSudahUpload'] = $this->Soal_ujian_model->getUploaded()->num_rows();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('penggandaan/index',$data);
        $this->load->view('templates/footer');
    }
    public function update($id){
        error_reporting(E_ALL ^ E_NOTICE);
        // $ID_att = $this->input->post('ID_att');
        // $result = array();
        // foreach($ID_att AS $key => $val){
        //     $result[] = array(
        //     "id" => $ID_att[$key],
        //     "penggandaan"  => $_POST['penggandaan'][$val]
        //     );
        // }
        // $test = $this->db->update_batch('soal_ujian', $result, 'id');
        // if($test){
        //     $this->session->set_flashdata('flash','Perubahan Berhasil disimpan');
        //     redirect('penggandaan');    }
        //     else{
        //         print_r($result) ;   
        //     echo "gagal di input";
        // }

        $data=array('penggandaan'=>1);
        $this->db->where('id',$id);
        $this->db->update('soal_ujian',$data);
        $this->session->set_flashdata('flash','Perubahan Berhasil disimpan');
            redirect('penggandaan');

    }
    public function undo($id){
        $data=array('penggandaan'=>0);
        $this->db->where('id',$id);
        $this->db->update('soal_ujian',$data);
        $this->session->set_flashdata('flash','Perubahan Berhasil disimpan');
            redirect('penggandaan');

    
    }

}