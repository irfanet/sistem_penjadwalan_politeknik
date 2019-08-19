<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingSW extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('setting_model');
        

        //validasi jika user belum login
        if($this->session->userdata('Jabatan') != 'Kajur' && $this->session->userdata('nip') != TRUE ){
            redirect('auth');
        }
    }
    public function index(){
        $data['title'] = 'Setting Semester dan Tahun Ajaran';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        $data['set'] = $this->setting_model->getSetting();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebarSW');
        $this->load->view('setting/index',$data);
        $this->load->view('templates/footer'); 
    }
    public function in_tambah(){
        $data['title'] = 'Setting Semester dan Tahun Ajaran';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
     
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun_ajaran', 'required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebarSW');
			$this->load->view('setting/index',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->setting_model->tambahData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Setting Berhasil ditambahkan');
            redirect('setting');
        }       
    }
    public function update(){
        $data['title'] = 'Setting Semester dan Tahun Ajaran';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
     
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun_ajaran', 'required|trim');
        // $data['smster'] = ['Ganji','Genap'];
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebarSW');
			$this->load->view('setting/index',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->setting_model->updateData();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Setting Berhasil diperbaharui');
            redirect('setting');
        }       
    }


}
